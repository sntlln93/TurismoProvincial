<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'start', 'end', 'description', 'slug'];
    protected $dates = ['start', 'end'];

    public function scopeFindByCities($query, $cities_id)
    {
        return $query->select('locations.*')
            ->join('addresses', 'locations.id', 'addresses.addressable_id')
            ->where('addressable_type', 'App\\Location')
            ->whereIn('addresses.city_id', $cities_id);
    }

    public function getCityAttribute()
    {
        return $this->address->city;
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}