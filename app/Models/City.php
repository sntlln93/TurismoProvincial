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

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}