<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Redirector;

use App\User;
use App\Role;
use App\District;

class UserController extends Controller
{
    public function __construct(Request $request, Redirector $redirect)
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user->role->name == "Admin Municipalidad" || $user->role->name == "Admin Provincia") {
                return $next($request);
            }
            
            abort(401);
        });
    }

    public function index()
    {
        $current_user = Auth::user();

        if ($current_user->district_id) {
            $districts = null;
            $roles = Role::where('name', '!=', 'Admin Provincia')->get();
            $users = User::where('id', '!=', $current_user->id)->get();
        } else {
            $users = User::where('id', '!=', $current_user->id)->get();
            $districts = District::all();
            $roles = Role::all();
        }

        return view('dashboard.users.index')
            ->with('districts', $districts)
            ->with('roles', $roles)
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
            'role_id' => 'required',
            'district_id' => 'nullable',
            'password' => 'required',
        ]);
    }
}