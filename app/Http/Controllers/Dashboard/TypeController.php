<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::where('type_id', null)->get();
        return view('dashboard.types.index')->with('types', $types);
    }

    public function store(Request $request)
    {
        $type_data = $this->validateType($request);

        Type::create($type_data);

        return redirect('/panel-de-administracion/types');
    }

    public function edit(Type $type)
    {
        $mtypes = Type::where('type_id', null)->get();

        return view('dashboard.types.edit')
            ->with('mtypes', $mtypes)
            ->with('type', $type);
    }

    public function update(Request $request, Type $type)
    {
        $type_data = $this->validateType($request);

        $type->update($type_data);

        return redirect('/panel-de-administracion/types');
    }

    public function destroy(Type $type)
    {
        $type->services()->delete();
        $type->delete();

        return redirect('/panel-de-administracion/types');
    }

    private function validateType($request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type_id' => 'required',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        return $validated;
    }
}
