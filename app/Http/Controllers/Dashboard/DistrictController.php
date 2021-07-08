<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\StoreImageService;
use App\Models\District;
use App\Models\Image;

class DistrictController extends Controller
{
    public function index()
    {
        if (Auth::user()->district_id) {
            return redirect('dashboard');
        }

        $districts = District::all();

        return view('dashboard.districts.index')->with('districts', $districts);
    }

    public function edit(District $district)
    {
        $can_edit = Auth::user()->district_id == null || Auth::user()->district_id == $district->id;

        if (!$can_edit) {
            return back()->with('error', 'no tienes permiso para realizar esta acción');
        }

        return view('dashboard.districts.edit')->with('district', $district);
    }

    public function update(Request $request, District $district, StoreImageService $service)
    {
        $can_edit = Auth::user()->district_id == null || Auth::user()->district_id == $district->id;

        if (!$can_edit) {
            return back()->with('error', 'no tienes permiso para realizar esta acción');
        }

        $validated_data = $request->validate([
            'mayor' => 'required',
            'description' => 'sometimes',
            'photos' => 'sometimes',
        ]);

        DB::transaction(function () use ($district, $validated_data, $service) {

            $district->update([
                'mayor' => $validated_data['mayor'],
                'description' => $validated_data['description'],
            ]);

            if (array_key_exists('photos', $validated_data)) {
                if (!$district->image) {
                    Image::create([
                        'path' => $service->store($validated_data['photos'][0], 'districts'),
                        'imageable_id' => $district->id,
                        'imageable_type' => 'App\\Models\\District'
                    ]);
                } else {
                    $image = $district->image;
                    Storage::delete('public/' . $image->path);
                    $image->update(['path' => $service->store($validated_data['photos'][0], 'districts')]);
                }
            }
        });

        return redirect('dashboard/districts/');
    }
}
