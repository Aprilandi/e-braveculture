<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CombedSablon extends Model
{
    protected $table = 'combed_sablons';

    protected $primaryKey = 'id_combed';

    protected $fillable = [
        'id_combed', 'id_material', 'combed', 'harga'
    ];

    public function Materials(){
        return $this->belongsTo(Materials::class, 'id_material', 'id_material');
    }
}
