<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        $ﬁleName = uniqid(rand().'_');
        $extension = $imageFile->extension();
        $ﬁleNameToStore = $ﬁleName. '.' . $extension;
        $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();
        Storage::put('public/' . $folderName . '/' . $ﬁleNameToStore, $resizedImage);

        return $ﬁleNameToStore;
    }
}
