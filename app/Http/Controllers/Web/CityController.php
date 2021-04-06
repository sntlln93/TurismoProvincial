<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\District;
use App\Models\City;

class CityController extends Controller
{
    public function index(District $district)
    {
        $cities = $district->cities;

        return view('web.cities')
            ->with('cities', $cities)
            ->with('district', $district);
    }

    public function show($district_slug, City $city)
    {
        $district = District::where('slug', $district_slug)->first();

        return view('web.city')
            ->with('city', $city)
            ->with('district', $district);
    }
}