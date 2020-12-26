<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
             ['category_id' => 1, 'product_name' => 'Iphone 6 RoseGold', 'desc' => 'Iphone By Apple', 'price' => 2000000, 'image' => 'Iphone 6 RoseGold 64 GB.jpg'],
             ['category_id' => 2, 'product_name' => 'Acer Predator', 'desc' => 'Predator by Acer', 'price' => 2200000, 'image' => 'predator.jpg'],
             ['category_id' => 1, 'product_name' => 'Samsung S20', 'desc' => 'S20 by Samsung', 'price' => 2200000, 'image' => 'Samsung S20.jpg'],
             ['category_id' => 2, 'product_name' => 'Asus TUF 15', 'desc' => 'TUF 15 by ASUS', 'price' => 2500000, 'image' => 'ASUS TUF A15.jpg']
        ]);
    }
}
