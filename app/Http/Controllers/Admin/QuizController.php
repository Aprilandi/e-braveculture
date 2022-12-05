<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index() {
        $quizzes = Quiz::get();
        // dd($quiz);
        return view('admin.gamifikasi.quizzies', ['quizzes' => $quizzes, 'page' => 'Quiz'])->with('quiz', 'active');
    }

    public function store(Request $request) {
        // dd($request);
        $quiz = Quiz::create([
            "pertanyaan" => $request->txtPertanyaan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ])->id_quiz;

        foreach ($request->txtJawaban as $key => $value) {
            if($request->txtJawabanBenar == $key){
                $sts = 1;
            }
            else{
                $sts = 0;
            }
            $jawab = QuizAnswer::create([
                "id_quiz" => $quiz,
                "jawab" => $value,
                "benar" => $sts,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        return redirect()->route('quiz.index')->with('insert', 'Data Berhasil Ditambah!');
    }

    public function update(Request $request, $id){
        $quiz = Quiz::where('id_quiz', $id)->update([
            "pertanyaan" => $request->txtedPertanyaan,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        QuizAnswer::where('id_quiz', $id)->delete();
        foreach ($request->txtedJawaban as $key => $value) {
            if($request->txtedJawabanBenar == $key){
                $sts = 1;
            }
            else{
                $sts = 0;
            }
            $jawab = QuizAnswer::create([
                "id_quiz" => $id,
                "jawab" => $value,
                "benar" => $sts,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        return redirect()->route('quiz.index')->with('update', 'Data Berhasil Dirubah!');
    }

    public function destroy($id) {
        QuizAnswer::where('id_quiz', $id)->delete();
        Quiz::where('id_quiz', $id)->delete();
        return redirect()->route('quiz.index')->with('destroy', 'Data Berhasil Dihapus!');
    }
}
