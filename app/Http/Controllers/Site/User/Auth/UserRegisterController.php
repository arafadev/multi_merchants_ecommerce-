<?php

namespace App\Http\Controllers\Site\User\Auth;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserRegisterNotification;
use App\Http\Requests\Site\User\Auth\UserRegisterRequest;

class UserRegisterController extends Controller
{
    public function getRegister()
    {
        return view('site.user.auth.register');
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data + ['password' => Hash::make($data['password'])]);

        Auth::guard('web')->login($user);

        $notification = array(
            'message' => 'User Register Successfully',
            'alert-type' => 'success'
        );

        Notification::send(Admin::get(), new UserRegisterNotification($request));
        return redirect()->route('user.profile')->with($notification);
    }
}
