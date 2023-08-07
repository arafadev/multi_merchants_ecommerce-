<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\VendorOrderController;
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
    //  ======================================================= Products Routes ===================================================
    Route::get('products', [ProductController::class, 'products'])->name('vendor.products');
    Route::get('product/add', [ProductController::class, 'addProduct'])->name('vendor.product.add');
    Route::get('subcategory/ajax/{category_id}', [ProductController::class, 'getSubcategory']);
    Route::post('product/store', [ProductController::class, 'storeProduct'])->name('vendor.product.store');
    Route::get('subcategory/ajax/{category_id}', [ProductController::class, 'getSubcategory']);
    Route::get('product/edit/{id}', [ProductController::class, 'editProduct'])->name('vendor.product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'updateProduct'])->name('vendor.product.update');
    Route::post('/product/thumbnail/update', [ProductController::class, 'updateProductThumbnail'])->name('vendor.update.product.thumbnail');
    Route::post('/update/product/multiImag',  [ProductController::class, 'UpdateProductMultiImage'])->name('vendor.update.product.multiimage');
    Route::get('/product/multiImage/delete/{id}',  [ProductController::class, 'deleteProductMultiImage'])->name('vendor.delete.product.multiimage');
    Route::get('/product/delete/{id}',  [ProductController::class, 'deleteProduct'])->name('vendor.delete.product');
    //  ======================================================= End Product Routes =============================================


    // Vendor Order All Route
    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('orders', 'orders')->name('vendor.orders');
        Route::get('return/order', 'returnOrders')->name('vendor.return.order');
        Route::get('complete/return/order', 'completeReturnOrder')->name('vendor.complete.return.order');
        Route::get('order/details/{order_id}', 'orderDetails')->name('vendor.order.details');
    });
});
