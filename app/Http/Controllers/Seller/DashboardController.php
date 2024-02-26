<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\OrderNotification;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Auth::user()->unreadNotifications);
        $shop = Auth::user();
        $user = Auth::user();
        $total_order = 0;
        $total_deliverd = 0;
        $total_fail_deliverd = 0;
        $total_shipping_cost = 0;
        // try
        // {
            $upsteamUrl = env('ECOM_URL');
            $signupApiUrl = $upsteamUrl . '/get_dashboard/'.$user->id;
            // dd($signupApiUrl);
            $response = Http::get($signupApiUrl);
            // dd(json_decode($response)->body());
            $data_response = (json_decode($response)->data);
            // dd($data_response);
            if($data_response)
            {
                $total_order = $data_response->total_order;
                $total_deliverd = $data_response->total_deliverd;
                $total_fail_deliverd = $data_response->total_fail_deliverd;
                $total_shipping_cost = $data_response->total_shipping_cost;
            }
            // $shipper = $data_response->shipper;
        // }
        // catch(\Exception $exception) {
            
        // }
        Session::put('total_order', $total_order);
        Session::put('total_deliverd', $total_deliverd);
        Session::put('total_fail_deliverd', $total_fail_deliverd);
        Session::put('total_shipping_cost', $total_shipping_cost);
        // dd(Session::get('carrier_data'));
        return view('seller.dashboard', compact('shop'));
    }


    public function notification(Request $request)
    {
        // dd($request->all());
        $shipper = User::where([['carrier_id',$request->carrier_id],['approved',1]]);
        if($request->customer_type == "enterprise")
        {
            $shipper = $shipper->whereHas('shipper_detail', function($q){
                $q->where('vehicle', '!=', 'motorbike');
            })->get();
        }
        else
        {
            
            $shipper = $shipper->whereHas('shipper_detail', function($q){
                $q->where('vehicle', 'motorbike');
            })->get();
        }
        // dd(count($shipper));
        $shipping_notic =
        [
            'order_detail_id'=>$request->order_detail_id,
            'customer_name'=>$request->customer_name,
        ];
        Notification::send($shipper, new OrderNotification($shipping_notic));
    }
}
