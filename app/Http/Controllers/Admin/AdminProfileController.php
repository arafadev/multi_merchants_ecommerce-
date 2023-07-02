<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Profile\AdminProfileRequest;

class AdminProfileController extends Controller
{
    use UploadPhotoTrait;

    public function adminProfile()
    {
        return view('admin.profile.index', ['admin' => Admin::find(Auth::user()->id)]);
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
}
