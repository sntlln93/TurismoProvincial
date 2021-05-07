<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = District::all();

        foreach ($districts as $district) {
            Image::create([
                'path' => 'districts/' . $district->slug . '.jpg',
                'imageable_id' => $district->id,
                'imageable_type' => 'App\\Models\\District'
            ]);
        }
    }
}
