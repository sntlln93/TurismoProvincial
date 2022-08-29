<?php

namespace App\Services;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class StoreImageService
{
    /**
     * Crops and saves an image to the main storage
     *
     * @param string $photo
     * @param string $relative_path
     * @return string
     */
    public function store(string $photo, string $relative_path): string
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
        ->save(storage_path($path));

        return $path;
    }
}