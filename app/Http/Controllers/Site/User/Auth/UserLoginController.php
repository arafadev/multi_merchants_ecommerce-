<?php

namespace App\Http\Controllers\Site\User\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . auth()->user()->id, true, $expireTime);
            User::findOrFail(auth()->user()->id)->update(['last_seen' => Carbon::now()]);

            $notification = array(
                'message' => 'User Login Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('user.profile')->with($notification);
        } else {
            $notification = array(
                'message' => 'Email or password failed',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getRegister()
    {
        return view('site.user.auth.register');
    }
    public function logout(Request $request)
    {
        Cache::forget('user-is-online' . auth()->user()->id);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
