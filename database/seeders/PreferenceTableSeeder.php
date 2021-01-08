<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Preference;

class PreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 19; $i++){
            Preference::create([
                'primary_color' => 'orange',
                'secondary_color' => 'gray',
                'font_family' => 'Roboto',
                'logo' => null,
                'district_id' => $i
            ]);
        }
    }
}
