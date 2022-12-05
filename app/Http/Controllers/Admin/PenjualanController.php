<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use App\Models\SaleTransactionDetails;
use App\Models\SaleTransactions;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index() {
        $menunggu = SaleTransactions::where(function($query) {
            $query->where('status', "Not Confirmed")
            ->whereNull('bukti_pembayaran');
        })->orWhere(function($query2) {
            $query2->where('status', "Confirmed")
            ->where('status_bayar', 'Belum Lunas');
        })
        ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
        ->orderBy('sale_transactions.created_at', 'asc')
        ->paginate(10, ['*'], 'menunggu');

        // $menunggu2 = SaleTransactions::where('status', "Not Confirmed")
        // ->whereNull('bukti_pembayaran')
        // ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
        // ->orderBy('sale_transactions.created_at', 'asc')
        // ->get();

        $terbayar = SaleTransactions::select('sale_transactions.*', DB::raw('max(sale_transaction_payments.created_at) as tgl'))
        ->with(['saletransactionpayments' => function($q) {
            $q->orderBy('created_at', 'desc');
            // ->max('created_at');
        }])->where('status', "Not Confirmed")
        ->whereNotNull('bukti_pembayaran')
        ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
        ->orderBy('sale_transactions.created_at', 'asc')
        ->groupBy('sale_transactions.id_sale')
        ->groupBy('sale_transactions.id_user')
        ->groupBy('sale_transactions.id_diskon')
        ->groupBy('sale_transactions.alamat_penuh')
        ->groupBy('sale_transactions.total_quantity')
        ->groupBy('sale_transactions.sub_total')
        ->groupBy('sale_transactions.kurir')
        ->groupBy('sale_transactions.paket')
        ->groupBy('sale_transactions.shipping_fee')
        ->groupBy('sale_transactions.total')
        ->groupBy('sale_transactions.dp')
        ->groupBy('sale_transactions.status_bayar')
        ->groupBy('sale_transactions.perolehan_points')
        ->groupBy('sale_transactions.bonus_points')
        ->groupBy('sale_transactions.persentase_bonus')
        ->groupBy('sale_transactions.status')
        ->groupBy('sale_transactions.no_resi')
        ->groupBy('sale_transactions.created_at')
        ->groupBy('sale_transactions.updated_at')
        ->paginate(10, ['*'], 'terbayar');

        // dd($terbayar);

        // $pelunasan = SaleTransactions::where('status', "Confirmed")
        // ->where('status_bayar', 'Belum Lunas')
        // ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
        // ->orderBy('sale_transactions.created_at', 'asc')
        // ->get();

        $dikirim = SaleTransactions::with(['saletransactionpayments' => function($q) {
            $q->orderBy('created_at', 'desc')
            ->whereNotNull('bukti_pembayaran');
        }])->where('status', "Dikirim")
        ->orderBy('sale_transactions.created_at', 'desc')
        ->paginate(10, ['*'], 'dikirim');

        $selesai = SaleTransactions::with(['saletransactionpayments' => function($q) {
            $q->orderBy('created_at', 'desc')
            ->whereNotNull('bukti_pembayaran');
        }])->where('status', "Selesai")
        ->orderBy('sale_transactions.created_at', 'desc')
        ->paginate(10, ['*'], 'selesai');

        return view('admin/transaksi/penjualan',
        ['menunggu' => $menunggu, 'terbayar' => $terbayar, 'dikirim' => $dikirim, 'selesai' => $selesai, 'page' => 'Penjualan'])
        ->with('penjualan', 'active');
    }

    public function konfirmasi(Request $request, $id){
        $sale = SaleTransactions::where('id_sale', $id)->get();
        if($sale->first()->status_bayar == "Lunas"){
            $status = SaleTransactions::where('id_sale', $id)->update([
                'status' => 'Dikirim',
                'no_resi' => $request->txtNomerResi,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $user = SaleTransactions::where('id_sale', $id)->get();

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
            $status = SaleTransactions::where('id_sale', $id)->update([
                'status' => 'Confirmed',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('penjualan.index')->with('update', 'Data Berhasil Disimpan!');
    }

    public function tolak($id){
        $sales = SaleTransactions::where('id_sale', $id)->update([
            'status' => 'Ditolak',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->route('penjualan.index')->with('update', 'Transaksi Berhasil Ditolak!');
    }
}
