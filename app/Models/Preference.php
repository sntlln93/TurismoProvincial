<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'primary_color',
        'secondary_color',
        'font_family',
        'logo',
        'district_id'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function getLogoAttribute($value)
    {
        if (! $value) {
            return asset('img/no-image.png');
        }

        return asset('storage/'.$value);
    }
}