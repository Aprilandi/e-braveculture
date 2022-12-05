<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardHistories extends Model
{
    protected $table = 'reward_histories';

    protected $primaryKey = 'id_history';

    protected $fillable = [
        'id_history', 'id_user', 'id_reward', 'status', 'expired_at'
    ];

    public function Users(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function Rewards(){
        return $this->belongsTo(Rewards::class, 'id_reward', 'id_reward');
    }

    public function Redeemed(){
        return $this->hasOne(SaleTransactions::class, 'id_voucher', 'id_history');
    }
}
