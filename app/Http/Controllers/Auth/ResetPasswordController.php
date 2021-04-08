<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ResetPasswordController extends Controller
{
    public function edit(User $user)
    {
        return view('dashboard.users.reset-password')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
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