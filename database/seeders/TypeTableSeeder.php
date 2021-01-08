<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $food = Type::create([
            'name' => 'Gastronomía',
            'type_id' => null,
            'slug' => 'gastronomia'
        ]);

        $hotel = Type::create([
            'name' => 'Alojamiento',
            'type_id' => null,
            'slug' => 'alojamiento'
        ]);

        $transport = Type::create([
            'name' => 'Transporte',
            'type_id' => null,
            'slug' => 'transporte'
        ]);

        Type::create([
            'name' => 'Restaurantes',
            'type_id' => $food->id,
            'slug' => 'restaurantes'
        ]);

        Type::create([
            'name' => 'Bares',
            'type_id' => $food->id,
            'slug' => 'bares'
        ]);

        Type::create([
            'name' => 'Hoteles',
            'type_id' => $hotel->id,
            'slug' => 'hoteles'
        ]);


        Type::create([
            'name' => 'Hostels',
            'type_id' => $hotel->id,
            'slug' => 'hostels'
        ]);

        $micro = Type::create([
            'name' => 'Microservicios',
            'type_id' => null,
            'slug' => 'microservicios'
        ]);

        Type::create([
            'name' => 'Kioscos',
            'type_id' => $micro->id,
            'slug' => 'kiosco'
        ]);

        Type::create([
            'name' => 'Farmacias',
            'type_id' => $micro->id,
            'slug' => 'farmacias'
        ]);
        
        Type::create([
            'name' => 'Transporte Público',
            'type_id' => $transport->id,
            'slug' => 'transporte-publico',
        ]);
    }
}
