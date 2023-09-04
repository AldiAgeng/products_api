<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 10; $i++){
            DB::table('users')->insert([
                'email' => $faker->email,
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
