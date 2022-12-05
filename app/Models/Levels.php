<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    protected $table = 'levels';

    protected $primaryKey = 'id_level';

    protected $fillable = [
        'id_level', 'tier_level', 'minimal', 'badge', 'bonus_point'
    ];

    public function Rewards(){
        return $this->hasMany(Rewards::class, 'id_level', 'id_level');
    }

    public function UserStatus(){
        return $this->hasMany(UserStatus::class, 'id_level', 'id_level');
    }
}
