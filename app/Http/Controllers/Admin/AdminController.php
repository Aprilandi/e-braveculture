<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderTransactionDetails;
use App\Models\OrderTransactionPayments;
use App\Models\OrderTransactions;
use App\Models\SaleTransactionDetails;
use App\Models\SaleTransactions;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        return view('admin/dashboard', ['dashboard' => 'active', 'page' => 'Dashboard']);
    }

    public function dataChart(Request $request){
        if($request->perperiode == "tahun"){
            $transaksiPemesanan = OrderTransactions::whereYear('created_at', $request->periode)
            ->select(
                DB::raw('count(id_order) as transaksi'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->get();
            $produkPemesanan = OrderTransactionDetails::whereYear('created_at', $request->periode)
            ->select(
                DB::raw('sum(product_quantity) as produk'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->get();
            $pendapatanPemesanan = OrderTransactions::whereYear('created_at', $request->periode)
            ->select(
                DB::raw('sum(sub_total) as pendapatan'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->get();

            $transaksiPembelian = SaleTransactions::whereYear('created_at', $request->periode)
            ->select(
                DB::raw('count(id_sale) as transaksi'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->get();
            $produkPembelian = SaleTransactionDetails::whereYear('created_at', $request->periode)
            ->select(
                DB::raw('sum(product_quantity) as produk'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->get();
            $pendapatanPembelian = SaleTransactions::whereYear('created_at', $request->periode)
            ->select(
                DB::raw('sum(sub_total) as pendapatan'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->get();

            $totalTransaksi = $transaksiPemesanan->sum('transaksi') + $transaksiPembelian->sum('transaksi');
            $totalPendapatan = $pendapatanPemesanan->sum('pendapatan') + $pendapatanPembelian->sum('pendapatan');
        }
        else if($request->perperiode == "bulan"){
            $transaksiPemesanan = OrderTransactions::whereMonth('created_at', date('m', strtotime($request->periode)))
            ->whereYear('created_at', date('Y', strtotime($request->periode)))
            ->select(
                DB::raw('count(id_order) as transaksi'),
                DB::raw('date_format(created_at, "%d") as day')
            )
            ->groupBy('day')
            ->get();
            $produkPemesanan = OrderTransactionDetails::whereMonth('created_at', date('m', strtotime($request->periode)))
            ->whereYear('created_at', date('Y', strtotime($request->periode)))
            ->select(
                DB::raw('sum(product_quantity) as produk'),
                DB::raw('date_format(created_at, "%d") as day')
            )
            ->groupBy('day')
            ->get();
            $pendapatanPemesanan = OrderTransactions::whereMonth('created_at', date('m', strtotime($request->periode)))
            ->whereYear('created_at', date('Y', strtotime($request->periode)))
            ->select(
                DB::raw('sum(sub_total) as pendapatan'),
                DB::raw('date_format(created_at, "%d") as day')
            )
            ->groupBy('day')
            ->get();

            $transaksiPembelian = SaleTransactions::whereMonth('created_at', date('m', strtotime($request->periode)))
            ->whereYear('created_at', date('Y', strtotime($request->periode)))
            ->select(
                DB::raw('count(id_sale) as transaksi'),
                DB::raw('date_format(created_at, "%d") as day')
            )
            ->groupBy('day')
            ->get();
            $produkPembelian = SaleTransactionDetails::whereMonth('created_at', date('m', strtotime($request->periode)))
            ->whereYear('created_at', date('Y', strtotime($request->periode)))
            ->select(
                DB::raw('sum(product_quantity) as produk'),
                DB::raw('date_format(created_at, "%d") as day')
            )
            ->groupBy('day')
            ->get();
            $pendapatanPembelian = SaleTransactions::whereMonth('created_at', date('m', strtotime($request->periode)))
            ->whereYear('created_at', date('Y', strtotime($request->periode)))
            ->select(
                DB::raw('sum(sub_total) as pendapatan'),
                DB::raw('date_format(created_at, "%d") as day')
            )
            ->groupBy('day')
            ->get();

            $totalTransaksi = $transaksiPemesanan->sum('transaksi') + $transaksiPembelian->sum('transaksi');
            $totalPendapatan = $pendapatanPemesanan->sum('pendapatan') + $pendapatanPembelian->sum('pendapatan');
        }
        $data = [
            "transaksiPembelian" => $transaksiPembelian,
            "produkPembelian" => $produkPembelian,
            "pendapatanPembelian" => $pendapatanPembelian,
            "transaksiPemesanan" => $transaksiPemesanan,
            "produkPemesanan" => $produkPemesanan,
            "pendapatanPemesanan" => $pendapatanPemesanan,
            "totalTransaksi" => $totalTransaksi,
            "totalPendapatan" => $totalPendapatan
        ];

        return json_encode($data);
    }

    public function getPointRanking(){
        $user = UserStatus::orderBy('redeemable_points', 'desc')->get();
        return json_encode($user);
    }
}
