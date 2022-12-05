<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    protected $table = 'points';

    protected $primaryKey = 'id_point';

    protected $fillable = [
        'id_point', 'point', 'min_sum_total'
    ];
}
