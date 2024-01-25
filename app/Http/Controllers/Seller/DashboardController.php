<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $shop = Auth::user();
        // dd(Session::get('carrier_data'));
        return view('seller.dashboard', compact('shop'));
    }
}
