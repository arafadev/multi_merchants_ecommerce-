<?php

namespace App\Http\Controllers\Site\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\Auth\UserLoginRequest;

class UserLoginController extends Controller
{
    public function getLogin()
    {
        return view('site.user.auth.login');
    }

    public function login(UserLoginRequest $request)
    {
        if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('user.profile');
        } else {
            return 'email or password is incorrect';
        }
    }
}
