<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Product 1
        //1
        DB::table('product_images')->insert([
            'id_product' => '1',
            'image' => 'tshirt-brave-stripes-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //2
        DB::table('product_images')->insert([
            'id_product' => '1',
            'image' => 'tshirt-brave-stripes-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 2
        //3
        DB::table('product_images')->insert([
            'id_product' => '2',
            'image' => 'Hoodie-Zipper-Dare-to-be-Brave-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //4
        DB::table('product_images')->insert([
            'id_product' => '2',
            'image' => 'Hoodie-Zipper-Dare-to-be-Brave-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 3
        //5
        DB::table('product_images')->insert([
            'id_product' => '3',
            'image' => 'Hoodie-Tshirt-Brave-Culture-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //6
        DB::table('product_images')->insert([
            'id_product' => '3',
            'image' => 'Hoodie-Tshirt-Brave-Culture-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 4
        //7
        DB::table('product_images')->insert([
            'id_product' => '4',
            'image' => 'Cargo-Pants-Brave-Culture-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //8
        DB::table('product_images')->insert([
            'id_product' => '4',
            'image' => 'Cargo-Pants-Brave-Culture-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 5
        //9
        DB::table('product_images')->insert([
            'id_product' => '5',
            'image' => 'Tshirt-Normality-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 6
        //10
        DB::table('product_images')->insert([
            'id_product' => '6',
            'image' => 'Tshirt-Brave-Dare-To-Be-Brave-Glow-in-the-Dark-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //11
        DB::table('product_images')->insert([
            'id_product' => '6',
            'image' => 'Tshirt-Brave-Dare-To-Be-Brave-Glow-in-the-Dark-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 7
        //10
        DB::table('product_images')->insert([
            'id_product' => '7',
            'image' => 'Tshirt-Brave-Culture-Jakarta-Black-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //11
        DB::table('product_images')->insert([
            'id_product' => '7',
            'image' => 'Tshirt-Brave-Culture-Jakarta-Black-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 8
        //12
        DB::table('product_images')->insert([
            'id_product' => '8',
            'image' => 'Tshirt-Fight-Against-Anxiety-Black-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //13
        DB::table('product_images')->insert([
            'id_product' => '8',
            'image' => 'Tshirt-Fight-Against-Anxiety-Black-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 9
        //14
        DB::table('product_images')->insert([
            'id_product' => '9',
            'image' => 'PARTIZAN-JERSEY-FOOTBALL-IS-OURS-1.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //15
        DB::table('product_images')->insert([
            'id_product' => '9',
            'image' => 'PARTIZAN-JERSEY-FOOTBALL-IS-OURS-2.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
