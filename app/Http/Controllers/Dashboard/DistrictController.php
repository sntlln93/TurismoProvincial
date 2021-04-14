<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $can_edit = Auth::user()->district_id == null || Auth::user()->district_id == $district->id;

        if(!$can_edit){
            return back()->with('error', 'no tienes permiso para realizar esta acción');
        }

        return view('dashboard.districts.edit')->with('district', $district);
    }

    public function update(Request $request, District $district)
    {
        $can_edit = Auth::user()->district_id == null || Auth::user()->district_id == $district->id;

        if(!$can_edit){
            return back()->with('error', 'no tienes permiso para realizar esta acción');
        }

        $mayor = $request->validate(['mayor' => 'required', 'description' => 'sometimes']);

        $district->update($mayor);

        return redirect('panel-de-administracion/districts/');
    }
}