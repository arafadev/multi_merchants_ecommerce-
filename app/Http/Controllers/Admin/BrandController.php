<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreBrandRequest;
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
}
