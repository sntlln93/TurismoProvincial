<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        
        return view('dashboard.users.change-password')->with('user', $user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $password = $this->validatePassword($request);

        $user->update([
            'password' => Hash::make($password)
        ]);

        return redirect('panel-de-administracion/users');
    }

    private function validatePassword($request)
    {
        return $request->validate([
            'password' => 'required|confirmed'
        ])['password'];
    }
}