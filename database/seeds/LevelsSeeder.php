<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('levels')->insert([
            'tier_level' => '0',
            'minimal' => '0',
            'badge' => 'Bronze.png',
            'bonus_point' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //2
        DB::table('levels')->insert([
            'tier_level' => '1',
            'minimal' => '100',
            'badge' => 'Silver.png',
            'bonus_point' => '10',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //3
        DB::table('levels')->insert([
            'tier_level' => '2',
            'minimal' => '500',
            'badge' => 'Gold.png',
            'bonus_point' => '20',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //4
        DB::table('levels')->insert([
            'tier_level' => '3',
            'minimal' => '1000',
            'badge' => 'Platinum.png',
            'bonus_point' => '30',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //5
        DB::table('levels')->insert([
            'tier_level' => '4',
            'minimal' => '2000',
            'badge' => 'Diamond.png',
            'bonus_point' => '40',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
