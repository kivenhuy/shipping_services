<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
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
}
