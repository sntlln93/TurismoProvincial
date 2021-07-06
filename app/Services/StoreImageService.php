<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StoreImageService
{
    public function store($encoded_image, $relative_path)
    {
        $decoded_image = str_replace('data:image/jpeg;base64,', '', $encoded_image);
        $decoded_image = str_replace(' ', '+', $decoded_image);
        $image_name = Str::random(10).'.'.'jpeg';
        $path = $relative_path.'/'.$image_name;

        Storage::disk('public')->put($path, base64_decode($decoded_image));

        return $path;
    }
}