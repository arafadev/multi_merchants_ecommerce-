<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\User\UserProfileController;
use App\Http\Controllers\Site\User\Auth\UserLoginController;
use App\Http\Controllers\Site\User\Auth\UserRegisterController;
use App\Http\Controllers\Site\Vendor\Auth\VendorController;

Route::get('/', function () {
    return view('site.index');
});



Route::group(['prefix' => '/', 'middleware' => 'guest:web'], function () {
    Route::get('login', [UserLoginController::class, 'getLogin'])->name('user.login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('user.login');
    Route::get('register', [UserRegisterController::class, 'getRegister'])->name('user.register.form');
    Route::post('register', [UserRegisterController::class, 'register'])->name('user.register');

    //  Become Vendor Routes
    Route::get('become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
    Route::post('become/vendor', [VendorController::class, 'becomeVendorRegister'])->name('become_vendor.register');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('profile/update', [UserProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update', [UserProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::get('logout', [UserLoginController::class, 'logout'])->name('user.logout');
});
