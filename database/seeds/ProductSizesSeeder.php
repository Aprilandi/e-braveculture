<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // BAJU
        // S
        // 1 Laki Dewasa
        $a = ['tinggi_badan' => '66', 'lebar_badan' => '48'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'S',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 2 Perempuan Dewasa
        $a = ['tinggi_badan' => '58', 'lebar_badan' => '46', 'dada' => '46'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'S',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 3 Unisex Anak2
        $a = ['tinggi_badan' => '44', 'lebar_badan' => '31'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'S',
            'umur' => 'Anak-anak',
            'kelamin' => 'Unisex',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // M
        // 4 Laki Dewasa
        $a = ['tinggi_badan' => '68', 'lebar_badan' => '52'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'M',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 5 Perempuan Dewasa
        $a = ['tinggi_badan' => '62', 'lebar_badan' => '48', 'dada' => '46'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'M',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 6 Unisex Anak2
        $a = ['tinggi_badan' => '49', 'lebar_badan' => '34'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'M',
            'umur' => 'Anak-anak',
            'kelamin' => 'Unisex',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // L
        // 7 Laki Dewasa
        $a = ['tinggi_badan' => '74', 'lebar_badan' => '54'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'L',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 8 Perempuan Dewasa
        $a = ['tinggi_badan' => '66', 'lebar_badan' => '50', 'dada' => '48'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'L',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 9 Unisex Anak2
        $a = ['tinggi_badan' => '53', 'lebar_badan' => '37'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'L',
            'umur' => 'Anak-anak',
            'kelamin' => 'Unisex',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // XL
        // 10 Laki Dewasa
        $a = ['tinggi_badan' => '78', 'lebar_badan' => '58'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'XL',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 11 Perempuan Dewasa
        $a = ['tinggi_badan' => '70', 'lebar_badan' => '52', 'dada' => '50'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'XL',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 12 Unisex Anak2
        $a = ['tinggi_badan' => '57', 'lebar_badan' => '40'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '1',
            'product_size' => 'XL',
            'umur' => 'Anak-anak',
            'kelamin' => 'Unisex',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // CELANA
        // S
        // 13 Laki Dewasa
        $a = ['lingkar pinggang' => '72', 'panjang' => '102', 'lingkar paha' => '27', 'lingkar pinggul' => '86'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '27',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 14 Perempuan Dewasa
        $a = ['lingkar pinggang' => '66', 'panjang' => '94', 'lingkar paha' => '46', 'lingkar pinggul' => '76'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '27',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // M
        // 15 Laki Dewasa
        $a = ['lingkar pinggang' => '74', 'panjang' => '102', 'lingkar paha' => '28', 'lingkar pinggul' => '88'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '28',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 16 Perempuan Dewasa
        $a = ['lingkar pinggang' => '69', 'panjang' => '94', 'lingkar paha' => '48', 'lingkar pinggul' => '79'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '28',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // L
        // 17 Laki Dewasa
        $a = ['lingkar pinggang' => '76', 'panjang' => '104', 'lingkar paha' => '30', 'lingkar pinggul' => '90'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '29',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 18 Perempuan Dewasa
        $a = ['lingkar pinggang' => '72', 'panjang' => '94', 'lingkar paha' => '50', 'lingkar pinggul' => '82'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '29',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // XL
        // 19 Laki Dewasa
        $a = ['lingkar pinggang' => '80', 'panjang' => '105', 'lingkar paha' => '31', 'lingkar pinggul' => '100'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '30',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 20 Perempuan Dewasa
        $a = ['lingkar pinggang' => '75', 'panjang' => '94', 'lingkar paha' => '52', 'lingkar pinggul' => '85'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '2',
            'product_size' => '30',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);


        // HOODIE
        // S
        // 21 Laki Dewasa
        $a = ['tinggi_badan' => '68', 'lebar_badan' => '50'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'S',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 22 Perempuan Dewasa
        $a = ['tinggi_badan' => '60', 'lebar_badan' => '48', 'dada' => '48'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'S',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // M
        // 23 Laki Dewasa
        $a = ['tinggi_badan' => '70', 'lebar_badan' => '54'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'M',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 24 Perempuan Dewasa
        $a = ['tinggi_badan' => '64', 'lebar_badan' => '50', 'dada' => '48'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'M',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // L
        // 25 Laki Dewasa
        $a = ['tinggi_badan' => '76', 'lebar_badan' => '56'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'L',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 26 Perempuan Dewasa
        $a = ['tinggi_badan' => '68', 'lebar_badan' => '52', 'dada' => '50'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'L',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // XL
        // 27 Laki Dewasa
        $a = ['tinggi_badan' => '80', 'lebar_badan' => '60'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'XL',
            'umur' => 'Dewasa',
            'kelamin' => 'Laki-laki',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // 28 Perempuan Dewasa
        $a = ['tinggi_badan' => '72', 'lebar_badan' => '54', 'dada' => '52'];
        DB::table('product_sizes')->insert([
            'id_product_type' => '4',
            'product_size' => 'XL',
            'umur' => 'Dewasa',
            'kelamin' => 'Perempuan',
            'ukuran' => json_encode($a),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
