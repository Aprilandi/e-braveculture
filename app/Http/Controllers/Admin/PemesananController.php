<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use App\Models\OrderTransactions;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index() {
        $menunggu = OrderTransactions::where(function($query) {
            $query->where('status', "Not Confirmed")
            ->whereNull('bukti_pembayaran');
        })->orWhere(function($query2) {
            $query2->where('status', "Confirmed")
            ->where('status_bayar', 'Belum Lunas');
        })
        ->join('order_transaction_payments', 'order_transactions.id_order', '=', 'order_transaction_payments.id_order')
        ->orderBy('order_transactions.created_at', 'asc')
        ->paginate(10, ['*'], 'menunggu');

        // $menunggu2 = SaleTransactions::where('status', "Not Confirmed")
        // ->whereNull('bukti_pembayaran')
        // ->join('order_transaction_payments', 'order_transactions.id_sale', '=', 'order_transaction_payments.id_sale')
        // ->orderBy('order_transactions.created_at', 'asc')
        // ->get();

        $terbayar = OrderTransactions::select('order_transactions.*', DB::raw('max(order_transaction_payments.created_at) as tgl'))
        ->with(['ordertransactionpayments' => function($q) {
            $q->orderBy('created_at', 'desc');
            // ->max('created_at');
        }])->where('status', "Not Confirmed")
        ->whereNotNull('bukti_pembayaran')
        ->join('order_transaction_payments', 'order_transactions.id_order', '=', 'order_transaction_payments.id_order')
        ->orderBy('order_transactions.created_at', 'asc')
        ->groupBy('order_transactions.id_order')
        ->groupBy('order_transactions.id_user')
        ->groupBy('order_transactions.id_voucher')
        ->groupBy('order_transactions.alamat_penuh')
        ->groupBy('order_transactions.total_quantity')
        ->groupBy('order_transactions.sub_total')
        ->groupBy('order_transactions.kurir')
        ->groupBy('order_transactions.paket')
        ->groupBy('order_transactions.shipping_fee')
        ->groupBy('order_transactions.total')
        ->groupBy('order_transactions.dp')
        ->groupBy('order_transactions.status_bayar')
        ->groupBy('order_transactions.perolehan_points')
        ->groupBy('order_transactions.bonus_points')
        ->groupBy('order_transactions.persentase_bonus')
        ->groupBy('order_transactions.status')
        ->groupBy('order_transactions.model_3d_json')
        ->groupBy('order_transactions.canvas_height')
        ->groupBy('order_transactions.canvas_width')
        ->groupBy('order_transactions.no_resi')
        ->groupBy('order_transactions.created_at')
        ->groupBy('order_transactions.updated_at')
        ->paginate(10, ['*'], 'terbayar');

        // dd($terbayar);

        // $pelunasan = SaleTransactions::where('status', "Confirmed")
        // ->where('status_bayar', 'Belum Lunas')
        // ->join('order_transaction_payments', 'order_transactions.id_sale', '=', 'order_transaction_payments.id_sale')
        // ->orderBy('order_transactions.created_at', 'asc')
        // ->get();

        $dikirim = OrderTransactions::with(['ordertransactionpayments' => function($q) {
            $q->orderBy('created_at', 'desc')
            ->whereNotNull('bukti_pembayaran');
        }])->where('status', "Dikirim")
        ->orderBy('order_transactions.created_at', 'desc')
        ->paginate(10, ['*'], 'dikirim');

        $selesai = OrderTransactions::with(['ordertransactionpayments' => function($q) {
            $q->orderBy('created_at', 'desc')
            ->whereNotNull('bukti_pembayaran');
        }])->where('status', "Selesai")
        ->orderBy('order_transactions.created_at', 'desc')
        ->paginate(10, ['*'], 'selesai');

        return view('admin/transaksi/pemesanan',
        ['menunggu' => $menunggu, 'terbayar' => $terbayar, 'dikirim' => $dikirim, 'selesai' => $selesai, 'page' => 'Pemesanan'])
        ->with('pemesanan', 'active');
    }

    public function konfirmasi(Request $request, $id){
        $order = OrderTransactions::where('id_order', $id)->get();
        if($order->first()->status_bayar == "Lunas"){
            $status = OrderTransactions::where('id_order', $id)->update([
                'status' => 'Dikirim',
                'no_resi' => $request->txtNomerResi,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user = OrderTransactions::where('id_order', $id)->get();

            $userSTS = UserStatus::where('id_user', $user->first()->id_user)->get();
            $newPoints = $userSTS->first()->redeemable_points + $user->first()->perolehan_points;
            $newPending = $userSTS->first()->redeemable_points_pending - $user->first()->perolehan_points;

            $oldXP = UserStatus::where('id_user', '=', $user->first()->id_user)->select('experience_points')->get();
            $newXP = $oldXP->first()->experience_points + 10;

            // GET ALL LEVEL
            $levels = Levels::get();

            // Level Check Minimum
            foreach($levels as $key => $value){
                if($value->id_level == $user->first()->user->userstatus->id_level){
                    $indexLVL = $key;
                    $min = $value->minimal;
                }
            }

            // Check if Level UP
            if($newXP >= $min){
                $newXP = $newXP - $min;
                $newLVL = $levels[( $indexLVL + 1 )]->id_level;
            }

            try {
                if(!empty($newLVL)){
                    UserStatus::where('id_user', '=', $user->first()->id_user)->update([
                        'id_level' => $newLVL,
                        'experience_points' => $newXP,
                        'redeemable_points' => $newPoints,
                        'redeemable_points_pending' => $newPending,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
                else{
                    UserStatus::where('id_user', '=', $user->first()->id_user)->update([
                        'experience_points' => $newXP,
                        'redeemable_points' => $newPoints,
                        'redeemable_points_pending' => $newPending,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        else{
            $status = OrderTransactions::where('id_order', $id)->update([
                'status' => 'Confirmed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('pemesanan.index')->with('update', 'Data Berhasil Disimpan!');
    }

    public function tolak($id){
        $order = OrderTransactions::where('id_order', $id)->update([
            'status' => 'Ditolak',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->route('pemesanan.index')->with('update', 'Transaksi Berhasil Ditolak!');
    }
}
