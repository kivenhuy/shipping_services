<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CheckoutSupermarketController;
use App\Http\Controllers\Api\PersonalInformationShopController;
use App\Http\Controllers\Api\PersonalInformationSupermarketController;
use App\Http\Controllers\Api\PurchaseHistoryController;
use App\Http\Controllers\Api\RequestForProductController;
use App\Http\Controllers\Api\RequestSendController;
use App\Http\Controllers\Api\ShipperController;
use App\Http\Controllers\Api\ShippingOrderController;
use App\Http\Controllers\Api\SuggestProductController;
use App\Http\Controllers\Api\UploadsProductController;
use App\Http\Controllers\UploadsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(['prefix' => 'v2'], function () {
    Route::controller(ShipperController::class)->group(function () {  
        Route::get('/get_all_shipper', 'index')->name('get_all_shipper.index');
        Route::get('/detail_shipper/{id}', 'shipper_detail')->name('get_all_shipper.detail_shipper');
        Route::post('/approval_shipper', 'approval_shipper')->name('get_all_shipper.approval_shipper');
    });

    
});


