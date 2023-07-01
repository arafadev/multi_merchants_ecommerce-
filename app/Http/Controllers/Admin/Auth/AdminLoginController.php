<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AdminLoginRequest;

class AdminLoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('admin.dashboard');
        } else {
            return 'email or password is incorrect';
        }
    }
}
