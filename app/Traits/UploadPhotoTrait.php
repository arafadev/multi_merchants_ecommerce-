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
            return $filename;
        }
        $file->move(public_path($directory), $filename);
        return $filename;
    }
}
