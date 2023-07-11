<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreBrandRequest;
use App\Http\Requests\Admin\Brand\UpdateBrandRequest;
use App\Traits\UploadPhotoTrait;

class BrandController extends Controller
{
    use UploadPhotoTrait;
    public function brands()
    {
        return view('admin.brand.index', ['brands' => Brand::latest()->get()]);
    }

    public function addBrand()
    {
        return view('admin.brand.create');
    }

    public function storeBrand(StoreBrandRequest $request)
    {

        $validatedData  = $request->validated();
        $filename = '';
        if ($request->file('image')) {
            $filename = $this->uploadPhoto($request->file('image'), 'upload/brand_images', true);
        }

        Brand::create([
            'name'  => $validatedData['name'],
            'image' => $filename,
            'slug' => strtolower(str_replace(' ', '-', $validatedData['name'])),
        ]);
        $response = [
            'success' => true,
            'message' => 'Brand Stored Successfully'
        ];
        return response()->json($response);
    }

    public function editBrand($id)
    {
        return view('admin.brand.edit', ['brand' => Brand::findOrFail($id)]);
    }


    public function updateBrand(UpdateBrandRequest $request, $id)
    {
        $validatedData  = $request->validated();
        if ($request->file('image')) {
            $filename = $this->uploadPhoto($request->file('image'), 'upload/brand_images', true);
            @unlink(public_path('upload/brand_images/' . auth()->user()->image));
        } else {
            $filename = auth()->user()->image;
        }

        Brand::findOrFail($id)->update([
            'name'  => $validatedData['name'],
            'image' => $filename,
            'slug' => strtolower(str_replace(' ', '-', $validatedData['name'])),
        ]);
        $response = [
            'success' => true,
            'message' => 'Brand Updated Successfully'
        ];
        return response()->json($response);
    }

    public function deleteBrand($id)
    {
        $brand  = Brand::findOrFail($id);
        @unlink(public_path('upload/brand_images/' . $brand->image));
        $brand->delete();
        return response()->json(['success' => true, 'message' => 'Brand deleted successfully.']);
    }
}
