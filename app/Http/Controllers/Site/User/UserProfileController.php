<?php

namespace App\Http\Controllers\Site\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Site\User\Profile\ProfileUpdateRequest;
use App\Traits\UploadPhotoTrait;

class UserProfileController extends Controller
{
    use UploadPhotoTrait;
    public function index()
    {

        return view('site.user.profile.index', ['user' => auth()->user()]);
    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {


        if ($request->file('photo')) {
            $filename = $this->uploadPhoto($request->file('photo'), 'upload/user_images');
            @unlink(public_path('upload/user_images/' . auth()->user()->photo));
        } else {
            $filename = auth()->user()->photo;
        }
        $data = $request->validated();
        $data['photo'] = $filename;
        User::findOrFail(Auth::id())->update($data);
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
