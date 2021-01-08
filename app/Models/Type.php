<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'type_id', 'slug'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function metatype()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function subtypes()
    {
        return $this->hasMany(Type::class, 'type_id');
    }

    public function scopeFindByType($query, $type)
    {
        return $query->where('name', $type);
    }
}