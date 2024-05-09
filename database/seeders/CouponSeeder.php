<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Faker\Factory as Faker;

class CouponSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            Coupon::create([
                'code' => $faker->unique()->bothify('??????##'),
                'brand_id' => $faker->numberBetween(1, 10), // Assuming there are 10 brands seeded
                'status' => $faker->randomElement(['active', 'expired', 'redeemed']),
                'redeemed_at' => $faker->optional()->dateTimeThisMonth()
                // Add any additional fields as needed
            ]);
        }
    }
}

