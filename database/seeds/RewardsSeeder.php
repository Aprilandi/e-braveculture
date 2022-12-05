<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tier 1
        //1
        DB::table('rewards')->insert([
            'id_reward_type' => '1',
            'value' => '50000',
            'desc' => 'Voucher pemesanan',
            'prize_point' => '1000',
            'id_level' => '2',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //2
        DB::table('rewards')->insert([
            'id_reward_type' => '2',
            'value' => '20',
            'desc' => 'Diskon pembelian',
            'prize_point' => '1000',
            'id_level' => '2',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Tier 2
        //3
        DB::table('rewards')->insert([
            'id_reward_type' => '1',
            'value' => '70000',
            'desc' => 'Voucher pemesanan',
            'prize_point' => '1500',
            'id_level' => '3',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //4
        DB::table('rewards')->insert([
            'id_reward_type' => '2',
            'value' => '30',
            'desc' => 'Diskon pembelian',
            'prize_point' => '1500',
            'id_level' => '3',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Tier 3
        //5
        DB::table('rewards')->insert([
            'id_reward_type' => '1',
            'value' => '90000',
            'desc' => 'Voucher pemesanan',
            'prize_point' => '2000',
            'id_level' => '4',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //6
        DB::table('rewards')->insert([
            'id_reward_type' => '2',
            'value' => '40',
            'desc' => 'Diskon pembelian',
            'prize_point' => '2000',
            'id_level' => '4',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Tier 4
        //7
        DB::table('rewards')->insert([
            'id_reward_type' => '1',
            'value' => '100000',
            'desc' => 'Voucher pemesanan',
            'prize_point' => '2500',
            'id_level' => '5',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //8
        DB::table('rewards')->insert([
            'id_reward_type' => '2',
            'value' => '50',
            'desc' => 'Diskon pembelian',
            'prize_point' => '2500',
            'id_level' => '5',
            'hari_berlaku' => '7',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
