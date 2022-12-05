
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('points')->insert([
            'point' => '0.4',
            'min_sum_total' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //2
        DB::table('points')->insert([
            'point' => '0.5',
            'min_sum_total' => '50000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //3
        DB::table('points')->insert([
            'point' => '0.6',
            'min_sum_total' => '100000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //4
        DB::table('points')->insert([
            'point' => '0.7',
            'min_sum_total' => '200000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //5
        DB::table('points')->insert([
            'point' => '0.8',
            'min_sum_total' => '500000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //6
        DB::table('points')->insert([
            'point' => '0.9',
            'min_sum_total' => '1000000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //7
        DB::table('points')->insert([
            'point' => '1',
            'min_sum_total' => '3000000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //8
        DB::table('points')->insert([
            'point' => '1.1',
            'min_sum_total' => '5000000',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
