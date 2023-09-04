<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $faker = Faker::create('id_ID');

        DB :: table ( 'products' ) -> insert ( [
            'name' => 'Laptop',
            'price' => 10000000,
            'image' => $faker->imageUrl(640, 480, 'animals', true),
            'product_category_id' => 1,
            'created_at' => now () ,
            'updated_at' => now ()
        ] );
    }
}
