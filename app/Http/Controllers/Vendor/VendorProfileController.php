<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Vendor\Profile\VendorProfileRequest;
use App\Http\Requests\Vendor\Profile\ChangePasswordRequest;

class VendorProfileController extends Controller
{
    use UploadPhotoTrait;

    public function vendorProfile()
    {
        return view('vendor.profile.index', ['vendor' => Vendor::find(Auth::user()->id)]);
    }
    public function vendorProfileUpdate(VendorProfileRequest $request)
    {
        if ($request->file('photo')) {
            $filename = $this->uploadPhoto($request->file('photo'), 'upload/vendor_images');
            @unlink(public_path('upload/vendor_images/' . auth()->user()->photo));
        } else {
            $filename = auth()->user()->photo;
        }
        $data = $request->validated();
        $data['photo'] = $filename;
        Vendor::findOrFail(Auth::id())->update($data);
        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        return view('vendor.profile.change_password');
    }

    public function vendorUpdatePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => "Old Password Doesn't Match!!",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        Vendor::findOrFail(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Vendor Password Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
