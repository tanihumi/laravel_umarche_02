<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        //dd($imageFile);
        if(is_array($imageFile)) {
            $file = $imageFile['image'];
        } else {
            $file = $imageFile;
        }

        $ﬁleName = uniqid(rand().'_');
        $extension = $file->extension();
        $ﬁleNameToStore = $ﬁleName. '.' . $extension;
        $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
        Storage::put('public/' . $folderName . '/' . $ﬁleNameToStore, $resizedImage);

        return $ﬁleNameToStore;
    }
}
