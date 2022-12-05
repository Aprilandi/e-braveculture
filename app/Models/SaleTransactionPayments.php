<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleTransactionPayments extends Model
{
    protected $table = 'sale_transaction_payments';

    protected $primaryKey = 'id_sale_payments';

    protected $fillable = [
        'id_sale_payments', 'id_sale', 'bukti_pembayaran', 'pembayaran'
    ];

    public function SaleTransactions(){
        return $this->belongsTo(SaleTransactions::class, 'id_sale', 'id_sale');
    }
}
