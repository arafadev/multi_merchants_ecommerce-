<?php

namespace App\Http\Controllers\Vendor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Auth\VendorLoginRequest;

class VendorLoginController extends Controller
{
    public function getLogin()
    {
        return view('vendor.auth.login');
    }

    public function login(VendorLoginRequest $request)
    {
        if (auth()->guard('vendor')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('vendor.dashboard');
        } else {
            return 'email or password is incorrect';
        }
    }
}
