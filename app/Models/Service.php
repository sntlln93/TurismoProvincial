<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Type;

class Service extends Model
{
    protected $fillable = [
        'name',
        'type',
        'responsable',
        'start',
        'end',
        'type_id',
        'slug'
    ];

    protected $appends = ['phones'];

    protected $dates = ['start', 'end'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function scopeFindByType($query, $type)
    {
        $type_id = Type::where('name', $type)->first()->id;

        return $query->where('type_id', $type_id);
    }

    public function getPhonesAttribute()
    {
        return $this->contacts->where('type', 'Teléfono');
    }

    public function getWebsiteAttribute()
    {
        if ($this->contacts->count() < 1) {
            return null;
        }
        
        return $this->contacts->where('type', 'Sitio web')->first()->contact;
    }

    public function getTypeChainAttribute()
    {
        $types[0] = $this->type;
        if ($types[0]->metaType->count() > 0) {
            $types[1] = $types[0]->type;
        }

        return $types;
    }
}