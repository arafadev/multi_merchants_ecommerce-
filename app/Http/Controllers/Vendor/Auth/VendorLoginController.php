<?php

namespace App\Http\Controllers\Vendor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $notification = array(
                'message' => 'Vendor Login Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('vendor.dashboard')->with($notification);
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid email or password.']);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('vendor/login');
    }
}
