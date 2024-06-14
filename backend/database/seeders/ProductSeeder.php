<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
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
            Product::create([
                'categorie_id' => $faker->numberBetween(1, 5),
                'name' => $faker->name,
                'price' => $faker->randomFloat(3, 1000, 1000000)
            ]);
        }
    }
}
