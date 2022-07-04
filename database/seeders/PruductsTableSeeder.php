<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PruductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 11; $i++) {
            \Illuminate\Support\Facades\DB::table('products')->insert([
                'title' => 'Product '.$i,
                'price' => rand(200, 15000),
                'in_stock' => 1,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quo quos alias iusto at voluptate, magnam delectus maxime ut et minus sapiente repudiandae voluptas quisquam eius deleniti, doloremque pariatur consectetur.'
            ]);
        }
    }
}
