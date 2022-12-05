<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('users')->insert([
            'id_role' => '1',
            'username' => 'admin',
            'name' => 'Admin',
            'avatar' => 'admin.jpg',
            'email'=>'admin@mail.com',
            'password' => bcrypt('admin123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //2
        DB::table('users')->insert([
            'id_role' => '2',
            'username' => 'owner',
            'name' => 'Owner',
            'avatar' => 'pemilik.jpg',
            'email'=>'owner@mail.com',
            'password' => bcrypt('owner123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //3
        DB::table('users')->insert([
            'id_role' => '3',
            'username' => 'toko',
            'name' => 'Toko',
            'avatar' => 'toko.jpg',
            'email'=>'toko@mail.com',
            'password' => bcrypt('toko123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        //4
        DB::table('users')->insert([
            'id_role' => '4',
            'username' => 'user',
            'name' => 'user',
            'avatar' => 'user.jpg',
            'email'=>'user@mail.com',
            'password' => bcrypt('user123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
