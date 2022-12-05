<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Siapa nama presiden ketiga Indonesia?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 2
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Landasan ldiil Koperasi yaitu?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 3
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Dari 85% uang Budi, ia harus menggunakannya sebanyak Rp 297.500. Berapa besar uang awal milik Budi?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 4
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Sebutkan sila ketiga?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 5
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Kapan Hari Lahir Pancasila diperingati?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 6
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Negara Asia ini pernah menjajah Indonesia dan membuat Belanda menyerahkan kekuasaannya, siapakah?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 7
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Negara mana yang benderanya mirip sama Indonesia? Merah (atas) dan Putih (bawah)',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 8
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Apa nama perusahaan teknologi terbesar di Korea Selatan?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 9
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Pada 1930 Albert Einstein dan seorang kolega mengeluarkan paten AS 1781541. Untuk apa itu?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // 10
        DB::table('quizzes')->insert([
            'pertanyaan' => 'Landasan struktural dari lembaga koperasi yaitu?',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
