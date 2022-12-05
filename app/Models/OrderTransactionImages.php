<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTransactionImages extends Model
{
    protected $table = 'order_transaction_images';

    protected $primaryKey = 'id_order_images';

    protected $fillable = [
        'id_order_images', 'id_order', 'bagian', 'image'
    ];

    public function OrderTransactions(){
        return $this->belongsTo(OrderTransactions::class, 'id_order', 'id_order');
    }
}
