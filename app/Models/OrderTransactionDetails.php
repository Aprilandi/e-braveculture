<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTransactionDetails extends Model
{
    protected $table = 'order_transaction_details';

    protected $primaryKey = 'id_order_detail';

    protected $fillable = [
        'id_order_detail', 'id_order', 'size', 'product_quantity'
    ];

    public function OrderTransactions(){
        return $this->belongsTo(OrderTransactions::class, 'id_order', 'id_order');
    }
}
