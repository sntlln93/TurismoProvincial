<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        $district = Auth::user()->district;

        return view('dashboard.cities.index')
            ->with('district', $district);
    }
    
    public function store(Request $request)
    {
        $city_data = $this->validatedCity($request);

        City::create([
            'name' => $city_data['name'],
            'description' => $city_data['description'],
            'district_id' => Auth::user()->district_id,
            'slug' => Str::slug($city_data['name']),
        ]);

        return redirect()->back();
    }

    public function edit(City $city)
    {
        return view('dashboard.cities.edit')->with('city', $city);
    }

    public function update(Request $request, City $city)
    {
        $city_data = $this->validatedCity($request);

        $city->update($city_data);

        return redirect('panel-de-administracion');
    }

    private function validatedCity($request)
    {
        return $request->validate([
            'name' => 'required',
            'description' => 'required',
        ],[

        ],[
            'name' => 'nombre',
            'description' => 'descripción',
        ]);
    }
}