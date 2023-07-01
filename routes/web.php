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


// ############################################## Admin ###############################################
Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', [AdminLoginController::class, 'getLogin'])->name('admin.login.form');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
// ############################################# End Vendor #########################################

// ############################################## Vendor ############################################
Route::group(['prefix' => 'vendor', 'middleware' => 'guest:vendor'], function () {
    Route::get('login', [VendorLoginController::class, 'getLogin'])->name('vendor.login.form');
    Route::post('login', [VendorLoginController::class, 'login'])->name('vendor.login');
});

Route::group(['prefix' => 'vendor', 'middleware' => 'auth:vendor'], function () {
    Route::get('dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
});
// ######################################## End Vendor ##############################################

// ########################################### User #################################################

Route::group(['prefix' => '/', 'middleware' => 'guest:web'], function () {
    Route::get('login', [UserLoginController::class, 'getLogin'])->name('user.login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('user.login');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
});
// ############################################# End User ###########################################

























// // User Routes
// Route::prefix('user')->group(function () {
//     Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
//     Route::post('/login', [UserLoginController::class, 'login'])->name('login');
// });

// // Admin Routes
// Route::prefix('admin')->group(function () {
//     Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [UserLoginController::class, 'login'])->name('login');
// });

// Route::middleware(['auth'])->prefix('user')->group(function () {
//     Route::get('/profile', [UserProfileController::class, 'userProfile'])
//         ->name('user.profile');
// });

// // // Admin Routes
// // Route::prefix('admin')->group(function () {
// //     Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
// //     Route::post('/login', [AdminLoginController::class, 'login']);
// // });

// // // Vendor Routes
// // Route::prefix('vendor')->group(function () {
// //     Route::get('/login', [VendorLoginController::class, 'showLoginForm'])->name('vendor.login');
// //     Route::post('/login', [VendorLoginController::class, 'login']);
// // });
