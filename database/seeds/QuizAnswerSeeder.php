<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('quiz_answers')->insert([
            'id_quiz' => '1',
            'jawab' => 'Habibie',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '1',
            'jawab' => 'Soeharto',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '1',
            'jawab' => 'Soekarno',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '1',
            'jawab' => 'Megawati',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //2
        DB::table('quiz_answers')->insert([
            'id_quiz' => '2',
            'jawab' => 'Pancasila',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '2',
            'jawab' => 'UUD 1945',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '2',
            'jawab' => 'Kitab',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '2',
            'jawab' => 'Presiden',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //3
        DB::table('quiz_answers')->insert([
            'id_quiz' => '3',
            'jawab' => 'Rp 350.000',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '3',
            'jawab' => 'Rp 300.000',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '3',
            'jawab' => 'Rp 400.000',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '3',
            'jawab' => 'Rp 375.000',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //4
        DB::table('quiz_answers')->insert([
            'id_quiz' => '4',
            'jawab' => 'Persatuan Indonesia',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '4',
            'jawab' => 'Kemanusiaan yang Adil dan Beradab',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '4',
            'jawab' => 'Kerakyatan yang Dipimpin oleh Hikmat Kebijaksanaan dalam Permusyawaratan/Perwakilan',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '4',
            'jawab' => 'Keadilan Sosial bagi Seluruh Rakyat Indonesia',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //5
        DB::table('quiz_answers')->insert([
            'id_quiz' => '5',
            'jawab' => '1 Juni',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '5',
            'jawab' => '1 Juli',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '5',
            'jawab' => '1 Oktober',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '5',
            'jawab' => '2 Mei',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //6
        DB::table('quiz_answers')->insert([
            'id_quiz' => '6',
            'jawab' => 'Jepang',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '6',
            'jawab' => 'Korea Selatan',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '6',
            'jawab' => 'China',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '6',
            'jawab' => 'Korea Utara',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //7
        DB::table('quiz_answers')->insert([
            'id_quiz' => '7',
            'jawab' => 'Monaco',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '7',
            'jawab' => 'Poland',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '7',
            'jawab' => 'Switzerland',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '7',
            'jawab' => 'Austria',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //8
        DB::table('quiz_answers')->insert([
            'id_quiz' => '8',
            'jawab' => 'Samsung',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '8',
            'jawab' => 'Yamaha',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '8',
            'jawab' => 'Tencent',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '8',
            'jawab' => 'Intel',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //9
        DB::table('quiz_answers')->insert([
            'id_quiz' => '9',
            'jawab' => 'Kulkas',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '9',
            'jawab' => 'Lampu',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '9',
            'jawab' => 'Listrik',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '9',
            'jawab' => 'Gravitasi',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        //10
        DB::table('quiz_answers')->insert([
            'id_quiz' => '10',
            'jawab' => 'UUD 1945',
            'benar' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '10',
            'jawab' => 'Pancasila',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '10',
            'jawab' => 'Kitab',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quiz_answers')->insert([
            'id_quiz' => '10',
            'jawab' => 'Presiden',
            'benar' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
