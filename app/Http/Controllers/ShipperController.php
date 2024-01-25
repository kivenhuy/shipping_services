<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerRegistrationRequest;
use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShipperController extends Controller
{
    

    public function index()
    {
        $user = Auth::user();
        return view('seller.shop.detail', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        // dd($request->all());
        $data_shipper = [
            'name'=>$request->name,
            'avatar_original'=>$request->logo,
            'phone'=>$request->phone,
            'id_proof'=>$request->id_proof,
        ];
        $final_data = $user->update($data_shipper);
        if ($final_data) {
            flash(translate('Your Information has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function update_details(Request $request)
    {
        $shipper_detail = Auth::user()->shipper_detail;
        // dd($request->all());
        $shipper_detail->vehicle = $request->vehicle;
        $shipper_detail->license_plates = $request->license_plates;
        $shipper_detail->vehicle_image = $request->vehicle_image;
        $shipper_detail->driver_license = $request->driver_license;
        $shipper_detail->save();
        if ($shipper_detail) {
            flash(translate('Your Information has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }
}
