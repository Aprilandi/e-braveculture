<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    protected $table = 'rewards';

    protected $primaryKey = 'id_reward';

    protected $fillable = [
        'id_reward', 'id_reward_type', 'value', 'desc', 'prize_point', 'id_level', 'hari_berlaku'
    ];

    public function RewardTypes(){
        return $this->belongsTo(RewardTypes::class, 'id_reward_type', 'id_reward_type');
    }

    public function Levels(){
        return $this->belongsTo(Levels::class, 'id_level', 'id_level');
    }

    public function RewardHistories(){
        return $this->hasMany(RewardHistories::class, 'id_reward', 'id_reward');
    }
}
