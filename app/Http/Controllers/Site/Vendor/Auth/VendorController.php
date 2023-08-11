<?php

namespace App\Http\Controllers\Site\Vendor\Auth;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VendorRegister;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Site\Vendor\Auth\BecomeVendorRegisterRequest;

class VendorController extends Controller
{
    public function becomeVendor()
    {
        return view('site.vendor.become_vendor');
    }

    public function becomeVendorRegister(BecomeVendorRegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);
        Vendor::create($validatedData + [
            'vendor_join' => date('Y-m-j'),
            'status'    => 'inactive',
        ]);
        $notification = array(
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.login')->with($notification);
    }
}
