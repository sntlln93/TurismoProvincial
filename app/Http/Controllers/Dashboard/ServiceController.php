<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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

        return view('dashboard.services.index')->with('types', $types);
    }

    public function show(Service $service)
    {
        return view('dashboard.services.show')->with('service', $service);
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
        ],[

        ],[
            'photos' => 'fotos'
        ])['photos'];

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
            'addressable_id' => $service->id,
            'addressable_type' => 'App\\Service'
        ]);


        foreach ($photos as $photo) {
            Image::create([
                'path' => $photo->store('locations', 'public'),
                'imageable_id' => $service->id,
                'imageable_type' => 'App\\Service'
            ]);
        }

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

    private function validateService($request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'responsable' => 'required',
            'start' => 'required',
            'end' => 'required',
            'type_id' => 'required',
        ],[

        ],[
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
            'indications' => 'nullable'
        ],[

        ],[
            'street' => 'calle',
            'number' => 'número',
            'city_id' => 'localidad',
            'indications' => 'indicaciones'
        ]);
    }

    private function validateContact($request)
    {
        return $request->validate([
            'type' => 'required',
            'contact' => 'required',
        ], [

        ],[
            'type' => 'tipo',
            'contact' => 'contacto'
        ]);
    }
}