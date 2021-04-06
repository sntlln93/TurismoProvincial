<?php

use App\Models\Image;
use App\Models\Location;

function findAll($imageable_id, $imageable_type)
{

    if (count($imageable_id) == 0) { //in case a district doesn't have any location
        $images = collect([asset('img/no-image.png')])->map(function ($image) {
            return $image;
        });

        return $images;
    }


        $locations = Location::whereIn('id', $imageable_id)->pluck('id');

        $images = collect(Image::whereIn('imageable_id', $locations)
        ->where('imageable_type', $imageable_type)
        ->get())->map(function ($image) {
            return asset('storage/'.$image->path);
        });

    if ($images->count() == 0) {
        $images = collect([asset('img/no-image.png')])->map(function ($image) {
            return $image;
        });
    }
   
    return $images;
}

function findOne($imageable_id, $imageable_type){

    $primary_image = Image::where('imageable_id', $imageable_id)->where('imageable_type', $imageable_type)->where('is_primary', true)->get();
        if ($primary_image->count() > 0) {
            return collect($primary_image)->map(function ($image) {
                return asset('storage/'.$image->path);
            });
        }
        
        $images = collect(Image::where('imageable_id', $imageable_id)
        ->where('imageable_type', $imageable_type)
        ->get())->map(function ($image) {
            return asset('storage/'.$image->path);
        });

        if ($images->count() == 0) {
            $images = collect([asset('img/no-image.png')])->map(function ($image) {
                return $image;
            });
        }

        return $images;


}