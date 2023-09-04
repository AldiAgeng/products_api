<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_products')->insert([
            'name' => 'Electronic',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('category_products')->insert([
            'name' => 'Fashion',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
