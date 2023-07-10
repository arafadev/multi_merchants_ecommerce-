<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\Auth\VendorLoginController;



Route::group(['prefix' => 'vendor', 'middleware' => 'guest:vendor'], function () {
    Route::get('login', [VendorLoginController::class, 'getLogin'])->name('vendor.login.form');
    Route::post('login', [VendorLoginController::class, 'login'])->name('vendor.login');
});

Route::group(['prefix' => 'vendor', 'middleware' => 'auth:vendor'], function () {
    Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');

    Route::get('profile', [VendorProfileController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('profile/update', [VendorProfileController::class, 'vendorProfileUpdate'])->name('vendor.profile.update');
    Route::get('change/password', [VendorProfileController::class, 'changePassword'])->name('vendor.change.password');
    Route::post('update/password', [VendorProfileController::class, 'vendorUpdatePassword'])->name('vendor.update.password');

    Route::get('logout', [VendorLoginController::class, 'logout'])->name('vendor.logout');
});
