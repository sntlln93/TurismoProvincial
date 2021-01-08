<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'lastname', 'dni', 'role_id', 'district_id', 'password',
        'paused_at','paused_for','paused_by',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['paused_at'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function getFullNameAttribute($value)
    {
        return $this->lastname.' '.$this->name;
    }
}