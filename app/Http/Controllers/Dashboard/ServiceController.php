<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Type;
use App\Models\Service;
use App\Models\City;
use App\Models\Address;
use App\Models\Image;

class ServiceController extends Controller
{
    public function index()
    {
        $types = Type::where('type_id', null)->with('subtypes')->get();

        $localAddresses = Address::join('cities', 'addresses.city_id', 'cities.id')
            ->join('districts', 'cities.district_id', 'districts.id')
            ->where('addressable_type', 'App\\Models\\Service')
            ->pluck('addresses.addressable_id')
            ->toArray();

        return view('dashboard.services.index')
            ->with('localAddresses', $localAddresses)
            ->with('types', $types);
    }

    public function show(Service $service)
    {
        return view('dashboard.services.show')->with('service', $service->load('address'));
    }

    public function create()
    {
        $cities = City::where("district_id", Auth::user()->district_id)->get();
        $types = Type::where('type_id', null)->get();

        return view('dashboard.services.create')
            ->with('types', $types)
            ->with('cities', $cities);
    }

    public function store(Request $request)
    {
        $service_data = $this->validateService($request);
        $address_data = $this->validateAddress($request);
        $photos = $request->validate([
            'photos' => 'required',
            'photos.*' => 'image'
        ], [], [
            'photos' => 'fotos'
        ])['photos'];

        DB::transaction(function () use ($service_data, $address_data, $photos) {
            $service = Service::create([
                'name' => $service_data['name'],
                'responsable' => $service_data['responsable'],
                'start' => $service_data['start'],
                'end' => $service_data['end'],
                'type_id' => $service_data['type_id'],
                'slug' => Str::slug($service_data['name']),
            ]);

            Address::create([
                'street' => $address_data['street'],
                'indications' => $address_data['indications'] ?? null,
                'number' => $address_data['number'],
                'city_id' => $address_data['city_id'],
                'map_link' => $address_data['map_link'],
                'addressable_id' => $service->id,
                'addressable_type' => 'App\\Models\\Service'
            ]);


            foreach ($photos as $photo) {
                Image::create([
                    'path' => $photo->store('services', 'public'),
                    'imageable_id' => $service->id,
                    'imageable_type' => 'App\\Models\\Service'
                ]);
            }
        });

        return redirect('panel-de-administracion/services');
    }

    public function edit(Service $service)
    {
        $types = Type::where('type_id', null)->get();

        return view('dashboard.services.edit')
            ->with('types', $types)
            ->with('service', $service);
    }

    public function update(Request $request, Service $service)
    {
        $service_data = $this->validateService($request);

        $service->update($service_data);

        return redirect('panel-de-administracion/services');
    }

    public function destroy(Service $service)
    {
        $service->contacts()->delete();

        /* need to find out why this delete doesnt work */ //<--- because its public not storage
        foreach ($service->images as $image) {
            Storage::delete('public/' . $image->path);
        }

        $service->images()->delete();
        $service->address()->delete();
        $service->delete();

        return back();
    }

    private function validateService($request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:services,name',
            'responsable' => 'required',
            'start' => 'required',
            'end' => 'required',
            'type_id' => 'required',
        ], [], [
            'name' => 'nombre',
            'responsable' => 'responsable',
            'start' => 'hora de apertura o checkin',
            'end' => 'hora de cierre o checkout',
            'type_id' => 'tipo',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        return $validated;
    }

    private function validateAddress($request)
    {
        return $request->validate([
            'street' => 'required',
            'number' => 'nullable',
            'city_id' => 'required',
            'map_link' => 'required|max:500',
            'indications' => 'nullable'
        ], [], [
            'street' => 'calle',
            'number' => 'número',
            'city_id' => 'localidad',
            'map_link' => 'enlace de mapa',
            'indications' => 'indicaciones'
        ]);
    }

    private function validateContact($request)
    {
        return $request->validate([
            'type' => 'required',
            'contact' => 'required',
        ], [], [
            'type' => 'tipo',
            'contact' => 'contacto'
        ]);
    }
}
