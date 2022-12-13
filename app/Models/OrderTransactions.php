<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTransactions extends Model
{
    protected $table = 'order_transactions';

    protected $primaryKey = 'id_order';

    protected $fillable = [
    'id_order', 'id_user', 'id_colour', 'id_combed', 'id_voucher', 'total_quantity', 'sub_total', 'kurir', 'paket', 'shipping_fee', 'total', 'status', 'alamat_penuh', 'dp', 'status_bayar', 'perolehan_points', 'bonus_points', 'persentase_bonus', 'no_resi', 'model_3d_json', 'canvas_height', 'canvas_width'
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function Voucher(){
        return $this->belongsTo(RewardHistories::class, 'id_voucher', 'id_history');
    }

    public function OrderTransactionDetails(){
        return $this->hasMany(OrderTransactionDetails::class, 'id_order', 'id_order');
    }

    public function OrderTransactionPayments(){
        return $this->hasMany(OrderTransactionPayments::class, 'id_order', 'id_order');
    }

    public function OrderTransactionImages(){
        return $this->hasMany(OrderTransactionImages::class, 'id_order', 'id_order');
    }

    public function Colours(){
        return $this->belongsTo(Colour::class, 'id_colour', 'id_colour');
    }

    public function Combed(){
        return $this->belongsTo(CombedSablon::class, 'id_combed', 'id_combed');
    }
}
