<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\District;

class HomeController extends Controller
{
    public function index()
    {
        $districts = District::orderBy('name')->get();
        return view('web.welcome')->with('districts', $districts);
    }

    public function show(District $district)
    {
        return view('web.district')->with('district', $district->load('preferences'));
    }

    public function about(District $district)
    {
        return view('web.about')->with('district', $district->load('preferences'));
    }
}