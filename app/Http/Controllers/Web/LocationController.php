<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\District;
use App\Location;

class LocationController extends Controller
{
    public function index(District $district)
    {
        $cities_id = $district->cities->pluck('id');
        $locations = Location::findByCities($cities_id)->get();

        return view('web.locations')
            ->with('locations', $locations->load('address'))
            ->with('district', $district);
    }

    public function show($district_slug, Location $location)
    {
        $district = District::where('slug', $district_slug)->first();

        return view('web.location')
            ->with('location', $location->load('address'))
            ->with('district', $district);
    }
}