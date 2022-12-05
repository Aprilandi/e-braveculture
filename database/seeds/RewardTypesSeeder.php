<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('reward_types')->insert([
            'reward_type' => 'Voucher',
            'desc' => 'Digunakan untuk mendapatkan potongan dalam pemesanan.',
            'gambar' => 'voucher.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //2
        DB::table('reward_types')->insert([
            'reward_type' => 'Diskon',
            'desc' => 'Digunakan untuk mendapatkan diskon dalam pembelian produk jadi.',
            'gambar' => 'diskon.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
