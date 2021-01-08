<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\User;

class PauseUserController extends Controller
{
    public function edit(User $user)
    {
        return view('dashboard.users.pause-user')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $pause_info = $request->validate(['paused_for' => 'required'])['paused_for'];

        $user->update([
            'paused_for' => $pause_info,
            'paused_by' => Auth::user()->full_name,
            'paused_at' => Carbon::now()
        ]);

        return redirect('panel-de-administracion/users');
    }

    public function unPause(User $user)
    {
        $user->update([
            'paused_for' => null,
            'paused_by' => null,
            'paused_at' => null
        ]);

        return redirect('panel-de-administracion/users');
    }
}