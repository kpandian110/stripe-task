<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'YOUTH SHIRT',
                'price' => 1050,
                'description' => 'Men Regular Fit Checkered Spread Collar Casual Shirt',
                'image' => 'public/uploads/1.webp'
            ],
            [
                'name' => 'BLUE MARTIN',
                'price' => 1824,
                'description' => 'Men Regular Fit Checkered Spread Collar Casual Shirt  (Pack of 2)',
                'image' => 'public/uploads/2.webp'
            ],
            [
                'name' => 'CAMPUS SUTRA',
                'price' => 1557,
                'description' => 'Men Regular Fit Checkered Spread Collar Casual Shirt',
                'image' => 'public/uploads/3.webp'
            ],
            [
                'name' => 'THE BEAR HOUSE',
                'price' => 1451,
                'description' => 'Men Slim Fit Checkered Button Down Collar Casual Shirt',
                'image' => 'public/uploads/4.webp'
            ],
            [
                'name' => 'VOROXY',
                'price' => 1673,
                'description' => 'Men Regular Fit Checkered Spread Collar Casual Shirt  (Pack of 2)',
                'image' => 'public/uploads/5.webp'
            ],
            [
                'name' => 'METRONAUT',
                'price' => 1379,
                'description' => 'Men Regular Fit Self Design Lapel Collar Casual Shirt',
                'image' => 'public/uploads/6.webp'
            ],
        ]);
    }
}
