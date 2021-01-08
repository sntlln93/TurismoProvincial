<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\District;
use App\Service;

class LodgingServiceController extends Controller
{
    public function index(District $district)
    {
        $lodging = $district->lodging;

        return view('web.lodging')
            ->with('lodging', $lodging)
            ->with('district', $district);
    }

    public function show($district_slug, Service $service)
    {
        $district = District::where('slug', $district_slug)->first();
        
        return view('web.lodging-single')
            ->with('lodging', $service->load('address', 'images', 'contacts', 'type'))
            ->with('district', $district);
    }
}