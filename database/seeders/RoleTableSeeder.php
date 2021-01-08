<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin Provincia',
        ]);

        Role::create([
            'name' => 'Admin Municipalidad',
        ]);

        Role::create([
            'name' => 'Gestor de Contenidos',
        ]);
    }
}
