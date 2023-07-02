<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Site\User\UserProfileController;
use App\Http\Controllers\Vendor\Auth\VendorLoginController;
use App\Http\Controllers\Site\User\Auth\UserLoginController;

Route::get('/', function () {
    return view('welcome');
});


// ########################################### User #################################################

Route::group(['prefix' => '/', 'middleware' => 'guest:web'], function () {
    Route::get('login', [UserLoginController::class, 'getLogin'])->name('user.login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('user.login');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
});
// ############################################# End User ###########################################

// ############################################## Admin ###############################################
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [AdminLoginController::class, 'getLogin'])->name('admin.login.form');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
// ############################################## End Admin ###############################################


// ############################################## Vendor ############################################
Route::group(['prefix' => 'vendor', 'middleware' => 'guest:vendor'], function () {
    Route::get('login', [VendorLoginController::class, 'getLogin'])->name('vendor.login.form');
    Route::post('login', [VendorLoginController::class, 'login'])->name('vendor.login');
});

Route::group(['prefix' => 'vendor', 'middleware' => 'auth:vendor'], function () {
    Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
});
// ######################################## End Vendor ##############################################
