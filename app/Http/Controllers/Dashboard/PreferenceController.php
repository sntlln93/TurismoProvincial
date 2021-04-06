<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Preference;

class PreferenceController extends Controller
{
    public function index()
    {
        $preferences = Auth::user()->district->preferences;
        return view('dashboard.preferences.index')->with('preferences', $preferences);
    }

    public function update(Request $request, Preference $preference)
    {
        $preferences_data = $this->validatePreferences($request);
        
        if (array_key_exists('logo', $preferences_data) && $preferences_data['logo']) {
            $preferences_data['logo'] = $preferences_data['logo']->store('logos', 'public');
        }
        
        $preference->update($preferences_data);
        
        return redirect('panel-de-administracion/preferences');
    }

    private function validatePreferences($request)
    {
        return $request->validate([
            'primary_color' => 'required',
            'secondary_color' => 'required',
            'font_family' => 'required',
            'logo' => 'nullable'
        ]);
    }
}