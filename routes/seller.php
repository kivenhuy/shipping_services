<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\OrderShippingController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\ShipperController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth']], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/shipper/dashboard', 'index')->name('shipper.dashboard');
        Route::get('/shipper/profile', 'profile')->name('shipper.profile.index');
        Route::get('/shipper/shop/verify', 'verify')->name('shipper.shop.verify');
        Route::get("/shipper/logout", [LoginController::class, 'logout'])->name('shipper.logout'); 
        Route::post("/shipper/notification",'notification')->name('shipper.notification'); 
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/shipper/products', 'index')->name('shipper.products');
        Route::get('/shipper/products/edit/{id}', 'edit')->name('shipper.products.edit');
        Route::get('/shipper/products/create', 'create')->name('shipper.products.create');
        Route::get('/shipper/products/data_ajax', 'data_ajax')->name('shipper.products.data_ajax');
        Route::post('/shipper/products/store', 'store')->name('shipper.products.store');
        Route::post('/shipper/products/published', 'published')->name('shipper.products.published');
        Route::post('/shipper/products/update/{product}', 'update')->name('shipper.products.update');
        // Route::get('/shipper/products', 'index')->name('shipper.products');
    });

    Route::controller(ShipperController::class)->group(function () {
        Route::get('/shipper', 'index')->name('shipper.shop.index');
        Route::post('/shipper/update_detail', 'update_details')->name('shipper.detail.update');
        Route::post('/shipper/update', 'update')->name('shipper.update');
    });


    Route::controller(OrderShippingController::class)->group(function () {
        Route::get('/orders', 'index')->name('shipper.orders.index');
        Route::get('/orders/detail/{id}', 'show')->name('shipper.orders.show');
        Route::post('/update_status_shipping', 'update_status_shipping')->name('shipper.update_status_shipping');
       
    });
});