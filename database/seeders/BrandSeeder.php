<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Brand::create([
                'name' => $faker->company,
                'description' => $faker->sentence
                // Add any additional fields as needed
            ]);
        }
    }
}

