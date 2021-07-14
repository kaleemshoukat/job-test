<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=1; $i<=100; $i++){
            \App\User::insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('123456'),
            ]);
        }
    }
}
