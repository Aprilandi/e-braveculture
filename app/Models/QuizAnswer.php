<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table = 'quiz_answers';

    protected $primaryKey = 'id_quiz_answer';

    protected $fillable = [
        'id_quiz_answer', 'id_quiz', 'jawab', 'benar'
    ];

    public function Quiz(){
        return $this->belongsTo(Quiz::class, 'id_quiz', 'id_quiz');
    }
}
