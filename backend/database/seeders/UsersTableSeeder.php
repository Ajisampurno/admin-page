<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'password' => bcrypt('password'),
                'created_at' => $faker->date('Y-m-d')
            ]);
        }
    }
}
