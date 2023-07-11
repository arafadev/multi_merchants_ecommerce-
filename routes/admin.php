<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BrandController;

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

    //  ======================================================= Brand Routes =============================================

    Route::get('brands', [BrandController::class, 'brands'])->name('brands');
    Route::get('brand/add', [BrandController::class, 'addBrand'])->name('brand.add');
    Route::post('brand/store', [BrandController::class, 'storeBrand'])->name('brand.store');
    Route::get('brand/edit/{id}', [BrandController::class, 'editBrand'])->name('brand.edit');
    Route::post('brand/update/{id}', [BrandController::class, 'updateBrand'])->name('brand.update');
    Route::get('brand/delete/{id}', [BrandController::class, 'deleteBrand'])->name('brand.delete');
    Route::post('brand/store', [BrandController::class, 'storeBrand'])->name('brand.store');
});
