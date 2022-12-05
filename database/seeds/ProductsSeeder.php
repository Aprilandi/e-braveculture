<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Product 1
        DB::table('products')->insert([
            'product_name' => 'Tshirt Brave Stripes Maroon Grey',
            'product_desc' => 'Available Tshirt Brave Stripes Maroon Grey Maroon Grey',
            'product_price' => '75000',
            'product_edition' => 'Limited Edition',
            'id_product_type'=> '1',
            'id_material' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 2
        DB::table('products')->insert([
            'product_name' => 'Hoodie Zipper Dare to be Brave',
            'product_desc' => 'Available Hoodie Zipper Dare to be Brave Hitam Abu-Abu',
            'product_price' => '125000',
            'product_edition' => 'Limited Edition',
            'id_product_type'=> '4',
            'id_material' => '1',//?
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 3
        DB::table('products')->insert([
            'product_name' => 'Hoodie Tshirt Brave Culture',
            'product_desc' => 'Available Hoodie Tshirt Brave Culture Putih Stripes Hitam',
            'product_price' => '125000',
            'product_edition' => 'Limited Edition',
            'id_product_type'=> '4',
            'id_material' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 4
        DB::table('products')->insert([
            'product_name' => 'Cargo Pants Brave Culture',
            'product_desc' => 'Available Cargo Pants Brave Culture Hitam',
            'product_price' => '100000',
            'product_edition' => 'Limited Edition',
            'id_product_type'=> '2',
            'id_material' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 5
        DB::table('products')->insert([
            'product_name' => 'Tshirt Normality',
            'product_desc' => 'Tshirt Normality Hitam',
            'product_price' => '75000',
            'product_edition' => '',
            'id_product_type'=> '1',
            'id_material' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 6
        DB::table('products')->insert([
            'product_name' => 'Tshirt Brave Dare To Be Brave',
            'product_desc' => 'Available Tshirt Dare To Be Brave Glow in the Dark Tosca',
            'product_price' => '75000',
            'product_edition' => '',
            'id_product_type'=> '1',
            'id_material' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 7
        DB::table('products')->insert([
            'product_name' => 'Tshirt Brave Culture Jakarta Black',
            'product_desc' => 'Available Tshirt Brave Culture Jakarta Hitam',
            'product_price' => '110000',
            'product_edition' => '',
            'id_product_type'=> '1',
            'id_material' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 8
        DB::table('products')->insert([
            'product_name' => 'Tshirt Fight Against Anxiety Black',
            'product_desc' => 'Available Tshirt Fight Against Anxiety Hitam',
            'product_price' => '110000',
            'product_edition' => '',
            'id_product_type'=> '1',
            'id_material' => '1',
            'product_discount' => '32',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 9
        DB::table('products')->insert([
            'product_name' => 'PARTIZAN JERSEY - FOOTBALL IS OURS',
            'product_desc' => 'Available Jersey PARTIZAN JERSEY - FOOTBALL IS OURS',
            'product_price' => '150000',
            'product_edition' => '',
            'id_product_type'=> '1',
            'id_material' => '1',
            'product_discount' => '10',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
