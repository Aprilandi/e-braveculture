<?php

namespace App\Models;

use App\Models\Roles;
use App\Models\ProductReviews;
use App\QuizHistory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user', 'username', 'name', 'avatar', 'email', 'password', 'nomer', 'id_role', 'city_id', 'province_id', 'alamat', 'rt', 'rw', 'keldes', 'isi_keldes', 'kecamatan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Role(){
        return $this->belongsTo(Roles::class, 'id_role', 'id_role');
    }

    public function Reviews(){
        return $this->hasMany(ProductReviews::class, 'id_user', 'id_user');
    }

    public function UserStatus(){
        return $this->hasOne(UserStatus::class, 'id_user', 'id_user');
    }

    public function RewardHistories(){
        return $this->hasMany(RewardHistories::class, 'id_user', 'id_user');
    }

    public function SaleTransactions(){
        return $this->hasMany(SaleTransactions::class, 'id_user', 'id_user');
    }

    public function OrderTransactions(){
        return $this->hasMany(OrderTransactions::class, 'id_user', 'id_user');
    }

    public function QuizHistories(){
        return $this->hasMany(QuizHistory::class, 'id_user', 'id_user');
    }
}
