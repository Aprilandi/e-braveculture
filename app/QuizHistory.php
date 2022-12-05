<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizHistory extends Model
{
    protected $table = 'quiz_histories';

    protected $primaryKey = 'id_quiz_history';

    protected $fillable = [
        'id_quiz_history', 'id_user', 'benar', 'redeemable_points', 'experience_points'
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
