<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id_role';

    protected $fillable = [
        'id_role', 'role',
    ];

    public function User(){
        return $this->hasMany(User::class, 'id_role', 'id_role');
    }
}
