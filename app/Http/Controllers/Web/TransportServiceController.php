<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\District;
use App\Models\Type;

class TransportServiceController extends Controller
{
    public function index(District $district)
    {
        $type = Type::findByType('Transporte')->pluck('id');
        $types = Type::where('type_id', $type)->get();

        return view('web.transport')
            ->with('types', $types->load('services'))
            ->with('district', $district);
    }
}