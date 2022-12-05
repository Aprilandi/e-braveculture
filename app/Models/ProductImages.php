<?php

namespace App\Models;

use App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';

    protected $primaryKey = 'id_image';

    protected $fillable = [
        'id_image', 'id_product', 'image',
    ];

    public function Products(){
        return $this->belongsTo(Products::class, 'id_product');
    }
}
