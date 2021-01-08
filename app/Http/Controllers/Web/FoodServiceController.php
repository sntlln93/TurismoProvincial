<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\District;
use App\Service;

class FoodServiceController extends Controller
{
    public function index(District $district)
    {
        $food_services = $district->food;

        return view('web.food-services')
            ->with('food_services', $food_services->load('address', 'images'))
            ->with('district', $district);
    }

    public function show($district_slug, Service $service)
    {
        $district = District::where('slug', $district_slug)->first();

        return view('web.food-service')
            ->with('food_service', $service->load('address', 'images', 'contacts', 'type'))
            ->with('district', $district);
    }
}