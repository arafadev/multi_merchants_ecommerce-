<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UploadPhotoTrait;

class SiteSettingController extends Controller
{
    use UploadPhotoTrait;
    public function siteSetting()
    {

        $setting = SiteSetting::find(1);
        return view('admin.settings.setting_update', ['setting' => $setting]);
    } // End Method


    public function siteSettingUpdate(Request $request)
    {

        $filename = $this->uploadPhoto($request->file('logo'), 'upload/logo', 180,56);
        @unlink(public_path(SiteSetting::findOrFail(1)->logo));

        SiteSetting::findOrFail($request->id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright,
            'logo' => $filename ?? null,
        ]);
        $notification = array(
            'message' => 'Site Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
