<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\User\UserProfileController;
use App\Http\Controllers\Site\Vendor\Auth\VendorController;
use App\Http\Controllers\Site\User\Auth\UserLoginController;
use App\Http\Controllers\Site\User\Auth\UserRegisterController;



// Frontend Product Details All Routes



Route::group(['prefix' => '/', 'middleware' => 'guest:web'], function () {
    Route::get('/', [IndexController::class, 'home']);
    Route::get('vendor/details/{id}', [IndexController::class, 'vendorDetails'])->name('vendor.details');
    Route::get('login', [UserLoginController::class, 'getLogin'])->name('user.login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('user.login');
    Route::get('register', [UserRegisterController::class, 'getRegister'])->name('user.register.form');
    Route::post('register', [UserRegisterController::class, 'register'])->name('user.register');

    //  Become Vendor Routes
    Route::get('become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
    Route::post('become/vendor', [VendorController::class, 'becomeVendorRegister'])->name('become_vendor.register');
    Route::post('all/vendor', [VendorController::class, 'allVendor'])->name('vendor.all');

    // Categories with products
    Route::get('/product/category/{id}/{slug}', [IndexController::class, 'catWithProducts']);
    Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails']);
    Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

    // // Product View Modal With Ajax

    Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjax']);
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('profile/update', [UserProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update', [UserProfileController::class, 'passwordUpdate'])->name('password.update');
    Route::get('logout', [UserLoginController::class, 'logout'])->name('user.logout');
});
