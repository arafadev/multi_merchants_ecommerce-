<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\StoreBannerRequest;
use App\Http\Requests\Admin\Banner\UpdateBannerRequest;

class BannerController extends Controller
{
    use UploadPhotoTrait;
    public function banners()
    {
        return view('admin.banners.index', ['banners' => Banner::latest()->get()]);
    }


    public function addBanner()
    {
        return view('admin.banners.create');
    }

    public function storeBanner(StoreBannerRequest $request)
    {
        $validatedData = $request->validated();
        $filename = $this->uploadPhoto($request->file('banner_image'), 'upload/banner_images', 768, 450);
        $validatedData['banner_image'] = $filename;
        Banner::create($validatedData);
        $response = [
            'success' => true,
            'message' => 'Banner Stored Successfully'
        ];
        return response()->json($response);
    }

    public function editBanner($id)
    {
        return view('admin.banners.edit', ['banner' => Banner::findOrFail($id)]);
    }


    public function updateBanner(UpdateBannerRequest $request, $id)
    {
        $image = Banner::findOrFail($id)->banner_image;
        $validatedData  = $request->validated();
        if ($request->file('banner_image')) {
            $filename = $this->uploadPhoto($request->file('banner_image'), 'upload/banner_images', true, 768, 450);
            unlink(public_path($image));
        } else {
            $filename = $image;
        }
        $validatedData['banner_image'] = $filename;
        Banner::findOrFail($id)->update($validatedData);
        $response = [
            'success' => true,
            'message' => 'Banner Updated Successfully'
        ];

        return response()->json($response);
    }

    public function deleteBanner($id)
    {
        $banner  = Banner::findOrFail($id);
        unlink(public_path($banner->banner_image));
        $banner->delete();
        return response()->json(['success' => true, 'message' => 'Banner deleted successfully.']);
    }
}
