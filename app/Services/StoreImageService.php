<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StoreImageService
{
    public function store($photo, $relative_path)
    {
        $decoded_image = str_replace('data:image/jpeg;base64,', '', $photo['base64']);
        $decoded_image = str_replace(' ', '+', $decoded_image);

        $image_name = Str::random(15).'.'.'webp';
        
        $path = $relative_path.'/'.$image_name;

        Image::make($decoded_image)->crop(
            intval(ceil($photo['w'])),
            intval(ceil($photo['h'])),
            intval(ceil($photo['x'])),
            intval(ceil($photo['y'])))
        ->save(public_path('storage/'.$path));

        return $path;
    }
}