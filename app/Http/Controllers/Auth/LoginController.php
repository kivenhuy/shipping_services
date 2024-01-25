<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Country;
use App\Models\EnterpriseDetails;
use App\Models\ShipperDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    protected function guard()
    {
        return Auth::guard();
    }   

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $pageConfigs = ['myLayout' => 'blank'];

        return view('user_layout.user_login');
    }

    public function showRegisterForm()
    {
        // $country = Country::all();
        $country = [];
        $carrier = [];
        try
        {
            $upsteamUrl = env('ECOM_URL');
            $signupApiUrl = $upsteamUrl . '/country';
            $response = Http::get($signupApiUrl);
            $data_response = (json_decode($response)->data);
            $country = $data_response->country;
            $carrier = $data_response->carrier;
        }
        catch(\Exception $exception) {
            
        }
        return view('user_layout.user_register',compact('country','carrier'));
    }

    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:5',
        ]);
        
        if ($validator->fails()) {
            //flash($validator->messages()->first())->error();
            return back()->withErrors($validator)->withInput();
        }
        
        $credential = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (auth()->attempt($credential)) {
            $user = Auth::user();
            $carrier_data = [];
            try
            {
                $upsteamUrl = env('ECOM_URL');
                $signupApiUrl = $upsteamUrl . '/get_data_carrier/'.$user->carrier_id;
                $response = Http::get($signupApiUrl);
                // dd(json_decode($response)->body());
                $data_response = (json_decode($response)->data);
                $carrier_data = $data_response;
                // $shipper = $data_response->shipper;
            }
            catch(\Exception $exception) {
                
            }
            Session::put('carrier_data', $carrier_data);
            return redirect()->route('shipper.dashboard');
            
        }

        //flash('The credentials did not match')->error();

        return redirect()->back()
            ->withErrors(['message' => 'The credentials did not match'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('user.login');
    }

    public function storeRegisterForm(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash(translate('Email or Phone already exists.'));
                return back();
            }
        }
        elseif (User::where('phone',$request->phone)->first() != null) {
            flash(translate('Phone already exists.'));
            return back();
        }

        $this->validator($request->all())->validate();
        $data_created = 
        [
            "_token" => $request->_token,
            "name" => $request->name,
            "country" =>$request->country_3,
            "city" =>$request->city_3,
            "email" => $request->email,
            "phone" => $request->phone,
            "district" =>$request->district_3,
            "ward" =>$request->ward_3,
            "address" => $request->address_3,
            "user_type" => 'shipper',
            "national_id" => $request->national_id,
            "carrier_id" => $request->carrier,
            "id_proof" => "",
            "password" => $request->password,
            "password_confirmation" => $request->password_confirmation,
            "national_id" => $request->national_id,
            // "full_address" =>  $full_address
        ];
        // dd($data_created);
        $user = $this->create($data_created);
        if($user)
        {
            $shipper = new ShipperDetail();
            $shipper->user_id = $user->id;
            $shipper->vehicle = $request->vehicle;
            $shipper->license_plates = $request->license_plates;
            $shipper->vehicle_image = "";
            $shipper->driver_license = "";
            $shipper->save();
        }
        $credential = [
            'email' => $user->email,
            'password' => $request->password
        ];
        if (auth()->attempt($credential )) {
            $user_login = Auth::user();
            $carrier_data = [];
            try
            {
                $upsteamUrl = env('ECOM_URL');
                $signupApiUrl = $upsteamUrl . '/get_data_carrier/'.$user_login->carrier_id;
                $response = Http::get($signupApiUrl);
                // dd(json_decode($response)->body());
                $data_response = (json_decode($response)->data);
                $carrier_data = $data_response;
                // $shipper = $data_response->shipper;
            }
            catch(\Exception $exception) {
                
            }
            Session::put('carrier_data', $carrier_data);
            return redirect()->route('shipper.dashboard');
        }

        $user->email_verified_at = date('Y-m-d H:m:s');
        $user->save();
        flash(translate('Registration successful.'))->success();
    }


    protected function create(array $data)
    {
        // dd($data['name']);
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $data['email'];
        }
        else
        {
            $email = "";
        }
        $data_created = 
        [
            'name' => $data['name'],
            'email' => $email,
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'district' => $data['district'],
            'city' => $data['city'],
            'country' => $data['country'],
            'address' => $data['address'],
            'user_type' =>  $data['user_type'],
            'national_id' =>  $data['national_id'],
            'carrier_id' =>  $data['carrier_id'],
            'id_proof' =>  $data['id_proof'],
            'ward' => $data['ward']
        ];
        $user = User::create($data_created);
        return $user;
    }
}
