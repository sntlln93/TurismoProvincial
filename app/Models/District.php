<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\City;
use App\Models\Location;
use App\Models\Service;
use App\Models\Image;

class District extends Model
{
    protected $fillable = ['name', 'mayor'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function addresses()
    {
        return $this->hasManyThrough(Address::class, City::class);
    }

    public function preferences()
    {
        return $this->hasOne(Preference::class);
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function getActivitiesAttribute()
    {
        $activities = DB::table('activities')
            ->selectRaw('activities.id, activities.name, activities.slug, activities.description, districts.slug as district_slug')
            ->join('locations', 'activities.location_id', 'locations.id')
            ->join('addresses', 'locations.id', 'addresses.addressable_id')
            ->join('cities', 'addresses.city_id', 'cities.id')
            ->join('districts', 'cities.district_id', 'districts.id')
            ->where('districts.id', $this->id)
            ->where('addressable_type', 'App\\Models\\Location')
            ->pluck('id');

        return Activity::find($activities);
    }

    public function getFoodAttribute()
    {
        return $this->servicesByType("Gastronomía");
    }

    public function getLodgingAttribute()
    {
        return $this->servicesByType("Alojamiento");
    }

    public function getTransportAttribute()
    {
        return $this->servicesByType('Transporte');
    }

    private function servicesByType($type)
    {
        $type = Type::findByType($type)->pluck('id');
        $ids = Type::where('type_id', $type)->pluck('id');
        
        $services = DB::table('services')
            ->selectRaw('services.*')
            ->join('addresses', 'services.id', 'addresses.addressable_id')
            ->join('cities', 'addresses.city_id', 'cities.id')
            ->join('districts', 'cities.district_id', 'districts.id')
            ->whereIn('services.type_id', $ids)
            ->where('districts.id', $this->id)
            ->where('addressable_type', 'App\\Models\\Service')
            ->pluck('id');
        
        return Service::find($services);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}