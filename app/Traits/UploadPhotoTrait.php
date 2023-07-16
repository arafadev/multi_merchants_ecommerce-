<?php

namespace App\Traits;

use Image;

trait UploadPhotoTrait
{
    public function uploadPhoto($file, $directory, $image = false, $height = '', $width  = '')
    {

        $filename = rand(1, 5000) . '.' . $file->getClientOriginalExtension();
        if ($image) {
            Image::make($file)->resize($height, $width)->save($directory . '/' . $filename);
            $file->move(public_path($directory), $filename);
            return $directory . '/' . $filename;
        }
        $file->move(public_path($directory), $filename);
        return $directory . '/' . $filename;
    }

    public function uploadMultiImages($request, $imgs, $folder, $height, $weight)
    {
        $images = $request->file($imgs);
        $image_paths = [];

        if (is_array($images)) {
            foreach ($images as $image) {
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize($height, $weight)->save('upload/' . $folder . '/' . $name_gen);
                $image_paths[] = 'upload/' . $folder . '/'  . $name_gen;
            }
        } else {
            $image = $images;
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize($height, $weight)->save('upload/' . $folder  . '/' . $name_gen);
            $image_paths = 'upload/' . $folder . '/' . $name_gen;
        }

        return $image_paths;
    }
}
