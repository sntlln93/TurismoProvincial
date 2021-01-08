<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'start',
        'end',
        'responsable',
        'amount',
        'description',
        'location_id',
        'slug',
    ];

    protected $dates = ['start', 'end'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}