<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardTypes extends Model
{
    protected $table = 'reward_types';

    protected $primaryKey = 'id_reward_type';

    protected $fillable = [
        'id_reward_type', 'reward_type', 'gambar', 'desc'
    ];

    public function Rewards(){
        return $this->hasMany(Rewards::class, 'id_reward_type', 'id_reward_type');
    }
}
