<?php

namespace App\Models;

use App\Models\ProductSize;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $table = 'product_types';

    protected $primaryKey = 'id_product_type';

    protected $fillable = [
        'id_product_type', 'product_type_name'
    ];

    public function Products(){
        return $this->hasMany(Products::class, 'id_product_type', 'id_product_type');
    }

    public function ProductSize(){
        return $this->hasMany(ProductSize::class, 'id_product_type', 'id_product_type');
    }
}
