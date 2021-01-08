<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'dni' => '33130932',
            'name' => 'Luciana',
            'lastname' => 'Pereyra',
            'password' => Hash::make('contrasena'),
            'role_id' => 3, //contenido
            'district_id' => 2, //san martin
        ]);

        User::create([
            'dni' => '37415820',
            'name' => 'Matías',
            'lastname' => 'Santillán',
            'password' => Hash::make('contrasena'),
            'role_id' => 1, //super admin
            'district_id' => null, //provincia
        ]);
    }
}
