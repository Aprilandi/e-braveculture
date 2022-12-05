<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $primaryKey = 'id_quiz';

    protected $fillable = [
        'id_quiz', 'pertanyaan'
    ];

    public function Answer(){
        return $this->hasMany(QuizAnswer::class, 'id_quiz', 'id_quiz');
    }
}
