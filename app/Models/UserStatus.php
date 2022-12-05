<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $table = 'user_statuses';

    protected $primaryKey = 'id_user_status';

    protected $fillable = [
        'id_user_status', 'id_user', 'id_level', 'experience_points', 'redeemable_points', 'redeemable_points_pending'
    ];

    public function Users(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function Levels(){
        return $this->belongsTo(Levels::class, 'id_level', 'id_level');
    }
}
