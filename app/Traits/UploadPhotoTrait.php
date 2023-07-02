<?php

namespace App\Traits;

trait UploadPhotoTrait
{
    public function uploadPhoto($file, $directory)
    {
        $filename = rand(1, 5000) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);
        return $filename;
    }
}
