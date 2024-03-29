<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;


class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            Categorie::create([
                'code' => $faker->unique()->regexify('[A-Z]{1}-[0-9]{3}'),
                'name' => $faker->name,
            ]);
        }
    }
}
