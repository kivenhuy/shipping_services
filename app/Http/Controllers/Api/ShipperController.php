<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductStock;
use App\Models\RequestForProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    public function index()
    {
       $shipper = User::with('shipper_detail')->get();
        return response()->json([
            'result' => true,
            'data'=>[
                'shipper'=>$shipper,
            ]
        ]);
    }

    public function approval_shipper(Request $request)
    {
        $user = User::find($request->id);
        $now = Carbon::now();
        $data_user = $user->update(['approved'=>(int)$request->status]);
        if($data_user)
        {
            return response()->json([
                'result' => true,
                'status'=>true
            ]);
        }
        else
        {
            return response()->json([
                'result' => false,
                'status'=>false
            ]);
        }
    }

    public function shipper_detail($id)
    {
        $user = User::with('shipper_detail')->find($id)->append(['license_image','vehicle_image']);
        return response()->json([
            'result' => true,
            'data'=>[
                'shipper'=>$user,
            ]
        ]);
       
    }
   
}
