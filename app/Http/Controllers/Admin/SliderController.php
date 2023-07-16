<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\UploadPhotoTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slider\StoreSliderRequest;
use App\Http\Requests\Admin\Slider\UpdateSliderRequest;

class SliderController extends Controller
{
    use UploadPhotoTrait;
    public function sliders()
    {
        return view('admin.sliders.index', ['sliders' => Slider::latest()->get()]);
    }


    public function addSlider()
    {
        return view('admin.sliders.create');
    }

    public function storeSlider(StoreSliderRequest $request)
    {
        $validatedData = $request->validated();
        $filename = $this->uploadPhoto($request->file('slider_image'), 'upload/slider_images', 2376, 807);
        $validatedData['slider_image'] = $filename;
        Slider::create($validatedData);
        $response = [
            'success' => true,
            'message' => 'Slider Stored Successfully'
        ];

        return response()->json($response);
    }


    public function editSlider($id)
    {
        return view('admin.sliders.edit', ['slider' => Slider::findOrFail($id)]);
    }


    public function updateSlider(UpdateSliderRequest $request, $id)
    {
        $image = Slider::findOrFail($id)->slider_image;
        $validatedData  = $request->validated();
        if ($request->file('slider_image')) {
            $filename = $this->uploadPhoto($request->file('slider_image'), 'upload/slider_images', true, 2376, 807);
            unlink(public_path($image));
        } else {
            $filename = $image;
        }
        $validatedData['slider_image'] = $filename;
        Slider::findOrFail($id)->update($validatedData);
        $response = [
            'success' => true,
            'message' => 'Slider Updated Successfully'
        ];

        return response()->json($response);
    }

    public function deleteSlider($id)
    {
        $slider  = Slider::findOrFail($id);
        @unlink(public_path($slider->slider_image));
        $slider->delete();
        return response()->json(['success' => true, 'message' => 'Slider deleted successfully.']);
    }
}
