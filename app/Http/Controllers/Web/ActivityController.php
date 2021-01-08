<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\District;
use App\Activity;

class ActivityController extends Controller
{
    public function index(District $district)
    {
        $activities = $district->activities;

        return view('web.activities')
            ->with('activities', $activities->load('location', 'images'))
            ->with('district', $district);
    }

    public function show($district_slug, Activity $activity)
    {
        $district = District::where('slug', $district_slug)->first();

        return view('web.activity')
            ->with('activity', $activity->load('location', 'images'))
            ->with('district', $district);
    }
}