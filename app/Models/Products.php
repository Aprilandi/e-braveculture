<?php

namespace App\Models;

use App\Models\ProductTypes;
use App\Models\Materials;
use App\Models\ProductReviews;
use App\Models\ProductImages;
use App\Models\ProductDetails;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_product', 'product_name', 'product_desc', 'product_price', 'product_edition', 'id_product_type', 'id_material', 'product_discount'
    ];

    public function Type(){
        return $this->belongsTo(ProductTypes::class, 'id_product_type', 'id_product_type');
    }

    public function Material(){
        return $this->belongsTo(Materials::class, 'id_material', 'id_material');
    }

    // public function Reviews(){
    //     return $this->hasMany(ProductReviews::class, 'id_product', 'id_product');
    // }

    public function Images(){
        return $this->hasMany(ProductImages::class, 'id_product', 'id_product');
    }

    public function Details(){
        return $this->hasMany(ProductDetails::class, 'id_product', 'id_product');
    }

    public function SaleTransactionDetails(){
        return $this->hasMany(SaleTransactionDetails::class, 'id_product', 'id_product');
    }
}
