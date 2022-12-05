<?php

namespace App\Models;

use App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected $table = 'materials';

    protected $primaryKey = 'id_material';

    protected $fillable = [
        'id_material', 'material_name', 'material_desc'
    ];

    public function Products(){
        return $this->hasMany(Products::class, 'id_material', 'id_material');
    }

    public function Combed(){
        return $this->hasMany(CombedSablon::class, 'id_material', 'id_material');
    }
}
