<?php

namespace App\Http\Controllers\Site\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $notification = array(
                'message' => 'User Login Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('user.profile')->with($notification);
        } else {
            return 'email or password is incorrect';
        }
    }

    public function getRegister()
    {
        return view('site.user.auth.register');
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
