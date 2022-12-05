<?php

namespace App\Models;

use App\Models\SaleTransactions;
use App\Models\Products;
use App\Models\ProductSize;

use Illuminate\Database\Eloquent\Model;

class SaleTransactionDetails extends Model
{
    protected $table = 'sale_transaction_details';

    protected $primaryKey = 'id_sale_detail';

    protected $fillable = [
        'id_sale_detail', 'id_sale', 'id_product', 'id_product_size', 'product_quantity'
    ];

    public function SaleTransactions(){
        return $this->belongsTo(SaleTransactions::class, 'id_sale', 'id_sale');
    }

    public function Products(){
        return $this->belongsTo(Products::class, 'id_product', 'id_product');
    }

    public function ProductSize(){
        return $this->belongsTo(ProductSize::class, 'id_product_size', 'id_product_size');
    }
}
