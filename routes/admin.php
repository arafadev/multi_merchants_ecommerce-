<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [AdminLoginController::class, 'getLogin'])->name('admin.login.form');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('change/password', [AdminProfileController::class, 'changePassword'])->name('admin.change.password');
    Route::post('update/password', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.update.password');

    Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});
