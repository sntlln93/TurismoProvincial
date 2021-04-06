<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Image;

class PhotoController extends Controller
{
    public function create($type, $id)
    {
        return view('dashboard.photos.create')
            ->with('type', $type)
            ->with('id', $id);
    }

    public function store(Request $request, $type, $id)
    {
        $photos = $this->validatePhotos($request)['photos'];

        if ($type == "services") {
            $imageable = "App\\Service";
        } elseif ($type == "locations") {
            $imageable = "App\\Location";
        } elseif ($type == "districts") {
            $imageable = "App\\City";
        } elseif ($type == "activities") {
            $imageable = "App\\Activity";
        }

        foreach ($photos as $photo) {
            Image::create([
                'path' => $photo->store($type, 'public'),
                'imageable_id' => $id,
                'imageable_type' => $imageable
            ]);
        }

        return redirect('panel-de-administracion/'.$type.'/');
    }

    public function show($type, $id)
    {
        if ($type == "services") {
            $imageable_type = "App\\Service";
        } elseif ($type == "locations") {
            $imageable_type = "App\\Location";
        } elseif ($type == "cities") {
            $imageable_type = "App\\City";
        } elseif ($type == "activities") {
            $imageable_type = "App\\Activity";
        }

        $photos = Image::where('imageable_id', $id)
            ->where('imageable_type', $imageable_type)
            ->get();

            return view('dashboard.photos.show')
            ->with('type', $type)
            ->with('id', $id)
            ->with('photos', $photos);
    }

    public function destroy(Image $image)
    {
        $image->delete();

        return redirect()->back();
    }

    public function mark(Image $image)
    {
        $images = DB::table('images')
            ->where('imageable_id', $image->imageable_id)
            ->where('imageable_type', $image->imageable_type)
            ->update(['is_primary' => false]);
        
        $image->update(['is_primary' => true]);

        return redirect()->back();
    }

    private function validatePhotos($request)
    {
        return $request->validate([
            'photos' => 'required',
            'photos.*' => 'image'
        ],[
            'photos.required' => 'Debes incluir por lo menos una foto. En el caso de que no quieras añadir fotos vuelve a la página anterior.'
        ],[
            'photos' => 'fotos'
        ]);
    }
}