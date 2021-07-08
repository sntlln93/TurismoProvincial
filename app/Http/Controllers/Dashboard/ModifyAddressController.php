<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Address;
use App\Models\City;

class ModifyAddressController extends Controller
{
    public function edit(Address $address)
    {
        $cities = City::all();

        return view('dashboard.addresses.edit')
            ->with('cities', $cities)
            ->with('address', $address);
    }

    public function update(Request $request, Address $address)
    {
        $address_data = $this->validateAddress($request);
        $address->update($address_data);

        if ($address->addressable_type == "App\\Models\\Location") {
            $addressable = "locations";
        } elseif ($address->addressable_type == "App\\Models\\Service") {
            $addressable = "services";
        }

        return redirect('dashboard/'.$addressable.'/'.$address->addressable->id);
    }

    private function validateAddress($request)
    {
        $validated = $request->validate([
            'street' => 'required',
            'number' => 'nullable',
            'map_link' => 'required|max:500',
            'indications' => 'nullable',
            'city_id' => 'nullable'
        ]);

        $validated['lat'] = $validated['map_link'];
        $validated['lon'] = $validated['map_link'];

        return $validated;
    }
}