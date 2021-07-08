<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\StoreImageService;
use App\Models\Address;
use App\Models\Image;
use App\Models\Location;
//use App\Services\GetCoordsFromLinkService;

class LocationController extends Controller
{
    public function index()
    {
        if (!Auth::user()->district_id) {
            return redirect("dashboard/users");
        }

        $locations = Auth::user()->district->addresses->where('addressable_type', 'App\\Models\\Location');

        return view('dashboard.locations.index')
            ->with('locations', $locations);
    }

    public function create()
    {
        $cities = Auth::user()->district->cities;

        return view('dashboard.locations.create')->with('cities', $cities);
    }

    public function edit(Location $location)
    {
        $cities = Auth::user()->district->cities;

        return view('dashboard.locations.edit')->with('location', $location)
            ->with('cities', $cities);
    }

    public function update(Request $request, Location $location)
    {
        $location_data = $request->validate([
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'street' => 'required',
            'number' => 'nullable',
            'city_id' => 'nullable',
            'map_link' => 'required|max:500',
        ], [], [
            'name' => 'nombre',
            'start' => 'hora de inicio',
            'end' => 'hora de fin',
            'description' => 'descripción',
            'street' => 'calle',
            'number' => 'número',
            'map_link' => 'enlace de mapa',
            'city_id' => 'localidad',
        ]);

        DB::transaction(function () use ($location, $location_data) {
            $location->address()->update([
                'street' => $location_data['street'],
                'number' => $location_data['number'],
                'city_id' => $location_data['city_id'],
                'addressable_id' => $location->id,
                'addressable_type' => 'App\\Models\\Location',
                'lat' => null,
                'lon' => null,
            ]);

            $location->update([
                'name' => $location_data['name'],
                'start' => $location_data['start'],
                'end' => $location_data['end'],
                'description' => $location_data['description'],
                'slug' => Str::slug($location_data['name']),
            ]);
        });

        return redirect('dashboard/locations');
    }

    public function store(Request $request, StoreImageService $service) //, GetCoordsFromLinkService $service)
    {
        $location_data = $this->validateLocation($request);

        DB::transaction(function () use ($location_data, $service) {
            $location = Location::create([
                'name' => $location_data['name'],
                'start' => $location_data['start'],
                'end' => $location_data['end'],
                'description' => $location_data['description'],
                'slug' => Str::slug($location_data['name']),
            ]);

            Address::create([
                'street' => $location_data['street'],
                'indications' => $location_data['indications'] ?? null,
                'number' => $location_data['number'],
                'city_id' => $location_data['city_id'],
                'map_link' => $location_data['map_link'],
                'addressable_id' => $location->id,
                'addressable_type' => 'App\\Models\\Location'
            ]);

            foreach ($location_data['photos'] as $photo) {
                Image::create([
                    'path' => $service->store($photo, 'locations'),
                    'imageable_id' => $location->id,
                    'imageable_type' => 'App\\Models\\Location'
                ]);
            }
        });

        return redirect('dashboard/locations');
    }

    public function validateLocation($request)
    {
        return $request->validate([
            'name' => 'required|unique:locations,name',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'photos' => 'required',
            'street' => 'required',
            'map_link' => 'required|max:500',
            'number' => 'nullable',
            'indications' => 'nullable',
            'city_id' => 'nullable',
        ], [], [
            'name' => 'nombre',
            'start' => 'hora de inicio',
            'end' => 'hora de fin',
            'description' => 'descripción',
            'photos' => 'fotos',
            'map_link' => 'enlace de mapa',
            'street' => 'calle',
            'number' => 'número',
            'indications' => 'indicaciones',
            'city_id' => 'localidad',
        ]);
    }

    public function destroy(Location $location)
    {
        DB::transaction(function () use ($location) {
            $location->address()->delete();
            $location->images()->delete();
            $location->delete();
        });

        return redirect('dashboard/locations');
    }
}
