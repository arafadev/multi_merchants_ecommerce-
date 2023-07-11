<?php

namespace App\Traits;

use Image;

trait UploadPhotoTrait
{
    public function uploadPhoto($file, $directory, $image = false)
    {

        $filename = rand(1, 5000) . '.' . $file->getClientOriginalExtension();
        if ($image) {
            Image::make($file)->resize(300, 300)->save($directory . '/' . $filename);
            $file->move(public_path($directory), $filename);
            return $filename;
        }
        $file->move(public_path($directory), $filename);
        return $filename;
    }
}
