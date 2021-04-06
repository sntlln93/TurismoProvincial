<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::all();
        
        return view('dashboard.districts.index')->with('districts', $districts);
    }

    public function edit(District $district)
    {
        return view('dashboard.districts.edit')->with('district', $district);
    }

    public function update(Request $request, District $district)
    {
        $mayor = $request->validate(['mayor' => 'required']);

        $district->update($mayor);

        return redirect('panel-de-administracion/districts/');
    }
}