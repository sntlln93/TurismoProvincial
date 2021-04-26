<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        DB::transaction(function () use ($city_data) {
            $city = City::create([
                'name' => $city_data['name'],
                'description' => $city_data['description'],
                'district_id' => Auth::user()->district_id,
                'slug' => Str::slug($city_data['name']),
            ]);

            Image::create([
                'path' => $city_data['photo']->store('cities', 'public'),
                'imageable_id' => $city->id,
                'imageable_type' => 'App\\Models\\City'
            ]);
        });

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
            'photo' => 'required|mimes:jpeg,jpg'
        ], [], [
            'name' => 'nombre',
            'description' => 'descripción',
            'photo' => 'foto'
        ]);
    }
}
