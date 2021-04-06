<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//use App\Services\GetCoordsFromLinkService;

use App\Models\Address;
use App\Models\Image;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        if(Auth::user()->role->name == "Admin Provincia"){
            return redirect("panel-de-administracion/users");
        }
        
        $locations = Auth::user()->district->addresses->where('addressable_type', 'App\\Location');
        $cities = Auth::user()->district->cities;

        return view('dashboard.locations.index')
            ->with('locations', $locations)
            ->with('cities', $cities);
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
        ],[

        ],[
            'name' => 'nombre',
            'start' => 'hora de inicio',
            'end' => 'hora de fin',
            'description' => 'descripción',
            'street' => 'calle',
            'number' => 'número',
            'city_id' => 'localidad',
        ]);

        $location->address()->update([
            'street' => $location_data['street'],
            'number' => $location_data['number'],
            'city_id' => $location_data['city_id'],
            'addressable_id' => $location->id,
            'addressable_type' => 'App\\Location',
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

        return redirect('panel-de-administracion/locations');
    }

    public function store(Request $request)//, GetCoordsFromLinkService $service)
    {
        $location_data = $this->validateLocation($request);

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
            'addressable_id' => $location->id,
            'addressable_type' => 'App\\Location'
        ]);

        foreach ($location_data['photos'] as $photo) {
            Image::create([
                'path' => $photo->store('locations', 'public'),
                'imageable_id' => $location->id,
                'imageable_type' => 'App\\Location'
            ]);
        }

        return redirect('panel-de-administracion/locations');
    }

    public function validateLocation($request)
    {
        return $request->validate([
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'photos' => 'required',
            'photos.*' => 'image',
            'street' => 'required',
            'number' => 'nullable',
            'indications' => 'nullable',
            'city_id' => 'nullable',
        ],[

        ],[
            'name' => 'nombre',
            'start' => 'hora de inicio',
            'end' => 'hora de fin',
            'description' => 'descripción',
            'photos' => 'fotos',
            'street' => 'calle',
            'number' => 'número',
            'indications' => 'indicaciones',
            'city_id' => 'localidad',
        ]);
    }

    public function destroy(Location $location)
    {
        $location->address()->delete();
        $location->images()->delete();
        $location->delete();

        return redirect('panel-de-administracion/locations');
    }
}