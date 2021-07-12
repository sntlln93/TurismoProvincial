<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\StoreImageService;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Image;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Auth::user()->district->activities;

        return view('dashboard.activities.index')
            ->with('activities', $activities);
    }
    

    public function edit(Activity $activity)
    {
        $locations = Auth::user()->district->addresses->where('addressable_type', 'App\\Models\\Location');

        return view('dashboard.activities.edit')
            ->with('activity', $activity)
            ->with('locations', $locations);
    }

    public function update(Request $request, Activity $activity)
    {
        $activity_data = $request->validate([
            'name' => 'required',
            'responsable' => 'required',
            'amount' => 'required',
            'location_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
        ],[

        ],[
            'name' => 'nombre',
            'responsable' => 'responsable',
            'amount' => 'precio',
            'location_id' => 'lugar',
            'start' => 'inicio',
            'end' => 'fin',
            'description' => 'descripción',
        ]);

        $activity->update([
            'name' => $activity_data['name'],
            'responsable' => $activity_data['responsable'],
            'amount' => $activity_data['amount'],
            'location_id' => $activity_data['location_id'],
            'start' => $activity_data['start'],
            'end' => $activity_data['end'],
            'description' => $activity_data['description'],
            'slug' => Str::slug($activity_data['name']),
        ]);

        return redirect('dashboard/activities');
    }

    public function create()
    {
        $locations = Auth::user()->district->addresses->where('addressable_type', 'App\\Models\\Location');

        return view('dashboard.activities.create')
            ->with('locations', $locations);
    }

    public function store(Request $request, StoreImageService $service)
    {
        $activity_data = $this->validateActivity($request);

        DB::transaction(function () use ($activity_data, $service) {
            $activity = Activity::create([
                'name' => $activity_data['name'],
                'start' => $activity_data['start'],
                'end' => $activity_data['end'],
                'description' => $activity_data['description'],
                'amount' => $activity_data['amount'],
                'responsable' => $activity_data['responsable'],
                'location_id' => $activity_data['location_id'],
                'slug' => Str::slug($activity_data['name']),
            ]);
    
            foreach ($activity_data['photos'] as $photo) {
                Image::create([
                    'path' => $service->store($photo, 'activities'),
                    'imageable_id' => $activity->id,
                    'imageable_type' => 'App\\Models\\Activity'
                ]);
            }
        });

        return redirect('dashboard/activities');
    }

    public function validateActivity($request)
    {
        return $request->validate([
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'photos' => 'required',
            'responsable' => 'required',
            'location_id' => 'nullable',
        ],[
            'photos.required' => 'El campo :attribute es obligatorio. Recuerda que además de seleccionar una foto, deber recortarla.'
        ],[
            'name' => 'nombre',
            'responsable' => 'responsable',
            'amount' => 'precio',
            'photos' => 'fotos',
            'location_id' => 'lugar',
            'start' => 'inicio',
            'end' => 'fin',
            'description' => 'descripción',
        ]);
    }

    public function destroy(Activity $activity)
    {
        $activity->images()->delete();
        $activity->delete();

        return redirect('dashboard/activities');
    }
}