<?php

namespace App\Http\Controllers\FarmManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('farm_management.dashboard');
    }
}
