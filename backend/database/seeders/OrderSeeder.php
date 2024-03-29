<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Order::create([
                'pd_id' => $faker->numberBetween(1, 10),
                'amount' => $faker->randomFloat(3, 1000, 1000000)
            ]);
        }
    }
}
