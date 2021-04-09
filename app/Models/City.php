<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'description', 'district_id', 'slug'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function getLocationsAttribute()
    {
        $addresses = $this->addresses->where('addressable_type', 'App\\Models\\Location')->pluck('addressable_id');

        return Location::whereIn('id', $addresses)->get();
    }

    public function getImagesAttribute()
    {
        $images = Image::select('images.*')
            ->join('locations', 'images.imageable_id', 'locations.id')
            ->join('addresses', 'locations.id', 'addresses.addressable_id')
            ->join('cities', 'addresses.city_id', 'cities.id')
            ->where('images.imageable_type', 'App\\Models\\Location')
            ->where('addresses.addressable_type', 'App\\Models\\Location')
            ->get();

        return $images;
    }
}