<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['contact', 'type', 'contactable_id', 'contactable_type'];

    public function contactable()
    {
        return $this->morphTo();
    }
}