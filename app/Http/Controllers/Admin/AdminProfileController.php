<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Profile\AdminProfileRequest;
use App\Http\Requests\Admin\Profile\ChangePasswordRequest;

class AdminProfileController extends Controller
{
    use UploadPhotoTrait;

    public function adminProfile()
    {
        return view('admin.profiles.index', ['admin' => Admin::find(Auth::user()->id)]);
    }

    public function adminProfileUpdate(AdminProfileRequest $request)
    {
        if ($request->file('photo')) {
            $filename = $this->uploadPhoto($request->file('photo'), 'upload/admin_images');
            @unlink(public_path('upload/admin_images/' . auth()->user()->photo));
        } else {
            $filename = auth()->user()->photo;
        }
        $data = $request->validated();
        $data['photo'] = $filename;
        Admin::findOrFail(Auth::id())->update($data);
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        return view('admin.profile.change_password');
    }

    public function adminUpdatePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => "Old Password Doesn't Match!!",
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        Admin::findOrFail(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Admin Password Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
