<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailsSeeder extends Seeder
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
        DB::table('product_details')->insert([
            'id_product' => '1',
            'id_product_size' => '1',
            'product_stock' => '15',
            'product_weight' => '450',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //2
        DB::table('product_details')->insert([
            'id_product' => '1',
            'id_product_size' => '4',
            'product_stock' => '10',
            'product_weight' => '500',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //3
        DB::table('product_details')->insert([
            'id_product' => '1',
            'id_product_size' => '7',
            'product_stock' => '5',
            'product_weight' => '550',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //4
        DB::table('product_details')->insert([
            'id_product' => '1',
            'id_product_size' => '10',
            'product_stock' => '10',
            'product_weight' => '600',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 2
        //5
        DB::table('product_details')->insert([
            'id_product' => '2',
            'id_product_size' => '21',
            'product_stock' => '18',
            'product_weight' => '550',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //6
        DB::table('product_details')->insert([
            'id_product' => '2',
            'id_product_size' => '23',
            'product_stock' => '8',
            'product_weight' => '600',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //7
        DB::table('product_details')->insert([
            'id_product' => '2',
            'id_product_size' => '25',
            'product_stock' => '5',
            'product_weight' => '650',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //8
        DB::table('product_details')->insert([
            'id_product' => '2',
            'id_product_size' => '27',
            'product_stock' => '4',
            'product_weight' => '700',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 3
        //9
        DB::table('product_details')->insert([
            'id_product' => '3',
            'id_product_size' => '21',
            'product_stock' => '0',
            'product_weight' => '550',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //10
        DB::table('product_details')->insert([
            'id_product' => '3',
            'id_product_size' => '23',
            'product_stock' => '19',
            'product_weight' => '600',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //11
        DB::table('product_details')->insert([
            'id_product' => '3',
            'id_product_size' => '25',
            'product_stock' => '10',
            'product_weight' => '650',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //12
        DB::table('product_details')->insert([
            'id_product' => '3',
            'id_product_size' => '27',
            'product_stock' => '8',
            'product_weight' => '700',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 4
        //13
        DB::table('product_details')->insert([
            'id_product' => '4',
            'id_product_size' => '13',
            'product_stock' => '0',
            'product_weight' => '350',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //14
        DB::table('product_details')->insert([
            'id_product' => '4',
            'id_product_size' => '15',
            'product_stock' => '10',
            'product_weight' => '400',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //15
        DB::table('product_details')->insert([
            'id_product' => '4',
            'id_product_size' => '17',
            'product_stock' => '6',
            'product_weight' => '450',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //16
        DB::table('product_details')->insert([
            'id_product' => '4',
            'id_product_size' => '19',
            'product_stock' => '8',
            'product_weight' => '500',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 5
        //17
        DB::table('product_details')->insert([
            'id_product' => '5',
            'id_product_size' => '1',
            'product_stock' => '1',
            'product_weight' => '450',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //18
        DB::table('product_details')->insert([
            'id_product' => '5',
            'id_product_size' => '4',
            'product_stock' => '7',
            'product_weight' => '500',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //19
        DB::table('product_details')->insert([
            'id_product' => '5',
            'id_product_size' => '7',
            'product_stock' => '8',
            'product_weight' => '550',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //20
        DB::table('product_details')->insert([
            'id_product' => '5',
            'id_product_size' => '9',
            'product_stock' => '10',
            'product_weight' => '600',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 6
        //21
        DB::table('product_details')->insert([
            'id_product' => '6',
            'id_product_size' => '1',
            'product_stock' => '1',
            'product_weight' => '450',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //22
        DB::table('product_details')->insert([
            'id_product' => '6',
            'id_product_size' => '4',
            'product_stock' => '2',
            'product_weight' => '500',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //23
        DB::table('product_details')->insert([
            'id_product' => '6',
            'id_product_size' => '7',
            'product_stock' => '3',
            'product_weight' => '550',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //24
        DB::table('product_details')->insert([
            'id_product' => '6',
            'id_product_size' => '9',
            'product_stock' => '4',
            'product_weight' => '600',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 7
        //25
        DB::table('product_details')->insert([
            'id_product' => '7',
            'id_product_size' => '1',
            'product_stock' => '9',
            'product_weight' => '450',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //26
        DB::table('product_details')->insert([
            'id_product' => '7',
            'id_product_size' => '4',
            'product_stock' => '12',
            'product_weight' => '500',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //27
        DB::table('product_details')->insert([
            'id_product' => '7',
            'id_product_size' => '7',
            'product_stock' => '15',
            'product_weight' => '550',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //28
        DB::table('product_details')->insert([
            'id_product' => '7',
            'id_product_size' => '9',
            'product_stock' => '3',
            'product_weight' => '600',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //Product 8
        //29
        DB::table('product_details')->insert([
            'id_product' => '8',
            'id_product_size' => '1',
            'product_stock' => '9',
            'product_weight' => '450',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //30
        DB::table('product_details')->insert([
            'id_product' => '8',
            'id_product_size' => '4',
            'product_stock' => '12',
            'product_weight' => '500',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //31
        DB::table('product_details')->insert([
            'id_product' => '8',
            'id_product_size' => '7',
            'product_stock' => '15',
            'product_weight' => '550',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //32
        DB::table('product_details')->insert([
            'id_product' => '8',
            'id_product_size' => '9',
            'product_stock' => '3',
            'product_weight' => '600',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
