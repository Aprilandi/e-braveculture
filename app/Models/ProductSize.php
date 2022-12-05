<?php

namespace App\Models;

use App\Models\ProductDetails;
use App\Models\ProductTypes;
use App\Models\SaleTransactionDetails;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_sizes';

    protected $primaryKey = 'id_product_size';

    protected $fillable = [
        'id_product_size', 'id_product_type', 'product_size', 'umur', 'kelamin', 'ukuran'
    ];

    public function ProductTypes(){
        return $this->belongsTo(ProductTypes::class, 'id_product_type', 'id_product_type');
    }

    public function ProductDetails(){
        return $this->hasMany(ProductDetails::class, 'id_product_size', 'id_product_size');
    }

    public function SaleTransactionDetails(){
        return $this->hasMany(SaleTransactionDetails::class, 'id_product_size', 'id_product_size');
    }
}
