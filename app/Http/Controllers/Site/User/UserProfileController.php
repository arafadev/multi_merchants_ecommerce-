<?php

namespace App\Http\Controllers\Site\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Site\User\Profile\ProfileUpdateRequest;
use App\Http\Requests\Site\User\Profile\ChangePasswordRequest;

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
        $response = [
            'success' => true,
            'message' => 'User Profile Updated Successfully'
        ];

        return response()->json($response);
    }

    public function passwordUpdate(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            $response = [
                'alert-type' => 'error',
                'message' => 'Password is incorrect!'
            ];
        } else {
            User::findOrFail(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            $response = [
                'alert-type' => 'success',
                'message' => 'User Password Updated Successfully'
            ];
        }

        return response()->json($response);
    }
}
