<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street',
        'number',
        'indications',
        'lat',
        'lng',
        'map_link',
        'addressable_id',
        'addressable_type',
        'city_id',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getFullAddressAttribute()
    {
        $number = $this->number ? 'N° '.$this->number : 'S/N';
        return $this->street.' '.$this->number;
    }
}