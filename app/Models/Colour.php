<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model
{
    protected $table = 'colours';

    protected $primaryKey = 'id_colour';

    protected $fillable = [
        'id_colour', 'warna', 'hex', 'rgb'
    ];
}
