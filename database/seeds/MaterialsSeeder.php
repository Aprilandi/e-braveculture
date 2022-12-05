<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('materials')->insert([
            'material_name' => 'Katun',
            'material_desc' => 'Memiliki tekstur yang halus dan lembut, Nyaman dipakai, Perawatan busana dari bahan katun ini mudah, Sifatnya kuat dan tahan lama, Cocok untuk di segala cuaca, Tidak membuat alergi',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //2
        DB::table('materials')->insert([
            'material_name' => 'Polyester',
            'material_desc' => 'Awet dan tahan terhadap kuman, Tidak mudah berkerut, Cepat kering dan tahan air',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //3
        DB::table('materials')->insert([
            'material_name' => 'Denim',
            'material_desc' => 'Tidak mudah robek, Kuat dan tahan lama, Nyaman',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //4
        DB::table('materials')->insert([
            'material_name' => 'Chiffon',
            'material_desc' => 'Sangat nyaman dikenakan, Tidak mudah kusut, Mudah untuk dicuci, Kain lebih awet',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //5
        DB::table('materials')->insert([
            'material_name' => 'Rayon',
            'material_desc' => 'Daya serap tinggi, Tekstur kain yang lembut, Banyak varian, Harga lebih bersahabat',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //6
        DB::table('materials')->insert([
            'material_name' => 'Jersey',
            'material_desc' => 'Tidak Mudah Kusut, Anti Pudar dan Fleksibel, Nyaman Dipakai dan Sejuk, Mudah Dicuci, Pilihan Warna Bervariasi, Perawatan Mudah, Punya Banyak Jenis',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
