<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Uploads;
use App\Models\User;
use Auth;
use DB;
use Http;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redis;

class OrderShippingController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_details = [];
        try
        {
            $upsteamUrl = env('ECOM_URL');
            $user_data =Auth::user();
            if($user_data->shipper_detail->vehicle == "motorbike")
            {
                if($user_data->carrier_id == 1)
                {
                    
                    $signupApiUrl = $upsteamUrl . '/normal_shipping';
                }
                else
                {
                    $signupApiUrl = $upsteamUrl . '/fast_shipping';
                    
                }
            }
            else
            {
                if($user_data->carrier_id == 1)
                {
                    
                    $signupApiUrl = $upsteamUrl . '/normal_shipping_enterprise';
                }
                else
                {
                    $signupApiUrl = $upsteamUrl . '/fast_shipping_enterprise';
                    
                }
            }
                
            $response = Http::get($signupApiUrl);
            $data_response = (json_decode($response)->data);
            $order_details = $data_response->order_details;
        }
        catch(\Exception $exception) {
            
        }
        $orders = $this->paginate($order_details);
    
        return view('seller.orders.index', compact('orders'));
    }


    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page,['path' => route('shipper.orders.index')], $options);
    }

    public function show(Request $request, $id)
    {
        $order_details = [];
        try
        {
            $upsteamUrl = env('ECOM_URL');
            $signupApiUrl = $upsteamUrl . '/order_detail/'.$id;
            $response = Http::get($signupApiUrl);
            $data_response = (json_decode($response)->data);
            $order_details = $data_response->order_details;
        }
        catch(\Exception $exception) {
            
        }
        return view('seller.orders.show', compact('order_details'));
    }

    public function update_status_shipping(Request $request)
    {
        $img_proff = "";
        if($request->has('proof_image'))
        {
            $img_proff = uploaded_asset($request->proof_image);
        }
        $data_response = false;
        $user_data = Auth::user();
        try
        {
            $upsteamUrl = env('ECOM_URL');
            $signupApiUrl = $upsteamUrl . '/process_shipping_order';
            $response = Http::post($signupApiUrl,
            [
                'order_detail_id' =>$request->id_order_detail,        
                'shipper_id' =>$user_data->id,        
                'shipper_name' =>$user_data->name,        
                'photo' =>$img_proff,        
                'status' =>$request->shipping_status,        
            ]);
            $data_response = (json_decode($response)->status);
        }
        catch(\Exception $exception) {
            
        }
        if($data_response)
        {
            flash(translate('Update status shipping order successfully'))->success();
            
        }
        else
        {
            flash(translate('Something went wrong'))->warning();
        }
        
        return back();
    }

}
