<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleTransactions extends Model
{
    protected $table = 'sale_transactions';

    protected $primaryKey = 'id_sale';

    protected $fillable = [
        'id_sale', 'id_user', 'id_diskon', 'total_quantity', 'sub_total', 'kurir', 'paket', 'shipping_fee', 'total', 'status', 'alamat_penuh', 'dp', 'status_bayar', 'perolehan_points', 'bonus_points', 'persentase_bonus', 'no_resi'
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function Diskon(){
        return $this->belongsTo(RewardHistories::class, 'id_diskon', 'id_history');
    }

    public function SaleTransactionDetails(){
        return $this->hasMany(SaleTransactionDetails::class, 'id_sale', 'id_sale');
    }

    public function SaleTransactionPayments(){
        return $this->hasMany(SaleTransactionPayments::class, 'id_sale', 'id_sale');
    }
}
