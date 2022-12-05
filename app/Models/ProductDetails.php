<?php

namespace App\Models;

use App\Models\Products;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'product_details';

    protected $primaryKey = 'id_product_detail';

    protected $fillable = [
        'id_product_detail', 'id_product', 'id_product_size', 'product_stock', 'product_weight'
    ];

    public function Products(){
        return $this->belongsTo(Products::class, 'id_product', 'id_product');
    }

    public function Sizes(){
        return $this->belongsTo(ProductSize::class, 'id_product_size', 'id_product_size');
    }
}
