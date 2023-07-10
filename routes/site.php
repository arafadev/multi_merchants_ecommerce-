<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\User\UserProfileController;
use App\Http\Controllers\Site\User\Auth\UserLoginController;

Route::get('/', function () {
    return view('site.index');
});



Route::group(['prefix' => '/', 'middleware' => 'guest:web'], function () {
    Route::get('login', [UserLoginController::class, 'getLogin'])->name('user.login.form');
    Route::post('login', [UserLoginController::class, 'login'])->name('user.login');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:web'], function () {
    Route::get('profile', [UserProfileController::class, 'index'])->name('user.profile');
});
