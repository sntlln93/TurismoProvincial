<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\District;

class UserController extends Controller
{
    public function index()
    {
        $current_user = Auth::user();

        if ($current_user->district_id) {
            $districts = null;
            $users = User::where('district_id', $current_user->district_id)->get();
        } else {
            $users = User::all();
            $districts = District::all();
        }

        return view('dashboard.users.index')
            ->with('districts', $districts)
            ->with('users', $users);
    }

    public function store(Request $request)
    {
        $user_data = $this->validateUser($request);
        $user_data['password'] = Hash::make($user_data['password']);

        User::create($user_data);

        return redirect('panel-de-administracion/users');
    }

    private function validateUser($request)
    {
        return $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'dni' => 'required|unique:users',
            'district_id' => 'nullable',
            'password' => 'required',
        ]);
    }
}
