<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\Auth\VendorLoginController;



Route::group(['prefix' => 'vendor', 'middleware' => 'guest:vendor'], function () {
    Route::get('login', [VendorLoginController::class, 'getLogin'])->name('vendor.login.form');
    Route::post('login', [VendorLoginController::class, 'login'])->name('vendor.login');
});

Route::group(['prefix' => 'vendor', 'middleware' => 'auth:vendor'], function () {
    Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
});
