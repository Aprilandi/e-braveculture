<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTransactionPayments extends Model
{
    protected $table = 'order_transaction_payments';

    protected $primaryKey = 'id_order_payments';

    protected $fillable = [
        'id_order_payments', 'id_order', 'bukti_pembayaran', 'pembayaran'
    ];

    public function OrderTransactions(){
        return $this->belongsTo(OrderTransactions::class, 'id_order', 'id_order');
    }
}
