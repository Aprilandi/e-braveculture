<?php

namespace App\Http\Controllers;

use App\Models\OrderTransactionPayments;
use App\Models\OrderTransactions;
use App\Models\Products;
use App\Models\SaleTransactionDetails;
use App\Models\SaleTransactionPayments;
use App\Models\SaleTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request){

        if(empty($request->prefix)){
            $sales = SaleTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Not Confirmed")
            ->whereNull('bukti_pembayaran')
            ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
            ->get();
            $order = OrderTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Not Confirmed")
            ->whereNull('bukti_pembayaran')
            ->join('order_transaction_payments', 'order_transactions.id_order', '=', 'order_transaction_payments.id_order')
            ->get();
            $request->prefix = "";
        }
        if($request->prefix == 'terbayar'){
            $sales = SaleTransactions::select('sale_transactions.*', DB::raw('max(sale_transaction_payments.created_at) as tgl'))
            ->with(['saletransactionpayments' => function($q) {
                $q->orderBy('created_at', 'desc');
                // ->max('created_at');
            }])->where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Not Confirmed")
            ->whereNotNull('bukti_pembayaran')
            ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
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
            ->get();

            // $sales = SaleTransactions::where('id_user', '=', Auth::user()->id_user)
            // ->where('status', "Not Confirmed")
            // ->with(['saletransactionpayments' => function($q){
            //     $q->whereNotNull('bukti_pembayaran');
            // }])
            // ->get();

            $order = OrderTransactions::select('order_transactions.*', DB::raw('max(order_transaction_payments.created_at) as tgl'))
            ->with(['ordertransactionpayments' => function($q) {
                $q->orderBy('created_at', 'desc');
                // ->max('created_at');
            }])->where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Not Confirmed")
            ->whereNotNull('bukti_pembayaran')
            ->join('order_transaction_payments', 'order_transactions.id_order', '=', 'order_transaction_payments.id_order')
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
            ->groupBy('order_transactions.no_resi')
            ->groupBy('order_transactions.model_3d_json')
            ->groupBy('order_transactions.canvas_height')
            ->groupBy('order_transactions.canvas_width')
            ->groupBy('order_transactions.created_at')
            ->groupBy('order_transactions.updated_at')
            ->get();
        }
        if($request->prefix == 'ditolak'){
            $sales = SaleTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Ditolak")
            ->whereNull('bukti_pembayaran')
            ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
            ->get();
            $order = OrderTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Ditolak")
            ->whereNull('bukti_pembayaran')
            ->join('order_transaction_payments', 'order_transactions.id_order', '=', 'order_transaction_payments.id_order')
            ->get();
        }
        if($request->prefix == 'pelunasan'){
            $sales = SaleTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Confirmed")
            ->where('status_bayar', 'Belum Lunas')
            ->join('sale_transaction_payments', 'sale_transactions.id_sale', '=', 'sale_transaction_payments.id_sale')
            ->get();

            $order = OrderTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Confirmed")
            ->where('status_bayar', 'Belum Lunas')
            ->join('order_transaction_payments', 'order_transactions.id_order', '=', 'order_transaction_payments.id_order')
            ->get();
        }
        if($request->prefix == 'dikirim'){
            $sales = SaleTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Dikirim")
            ->get();

            $order = OrderTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Dikirim")
            ->get();
        }
        if($request->prefix == 'selesai'){
            $sales = SaleTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Selesai")
            ->get();

            $order = OrderTransactions::where('id_user', '=', Auth::user()->id_user)
            ->where('status', "Selesai")
            ->get();
        }

        // dd($sales->id_sale);
        // dd(!empty($sales->first()->id_sale));

        // dd($bukti);
        return view('history', ['sales' => $sales, 'order' => $order, 'prefix' =>  $request->prefix]);
    }

    public function get_details(Request $request){
        // $details = SaleTransactionDetails::where('id_sale', '=', $request->id_sale)
        // ->join('products', 'sale_transaction_details.id_product', '=', 'products.id_product')
        // ->join('product_images', 'sale_transaction_details.id_product', '=', 'product_images.id_product')
        // ->get();
        $listProduct = SaleTransactionDetails::where('id_sale', '=', $request->id_sale)->groupBy('id_product')->select('id_product')->get();
        $i = 0;
        foreach ($listProduct as $row) {
            $details = SaleTransactionDetails::where('id_sale', '=', $request->id_sale)->where('id_product', '=', $row->id_product)->get();
            $dataDetails[$i]['image'] = $row->products->images->first()->image;
            $dataDetails[$i]['product_name'] = $row->products->product_name;
            $dataDetails[$i]['product_price'] = $row->products->product_price;
            $ii = 0;
            foreach($details as $row1){
                $dataDetails[$i]['details'][$ii]['product_size'] = $row1->productsize->product_size;
                $dataDetails[$i]['details'][$ii]['product_quantity'] = $row1->product_quantity;
                $dataDetails[$i]['details'][$ii]['product_weight'] = $row1->products->details->first()->product_weight;
                $dataDetails[$i]['details'][$ii]['total'] = $row1->products->product_price * $row1->product_quantity;
                $ii++;
            }
            $i++;
        }

        // dd($dataDetails);
        return $dataDetails;
    }

    public function upload_bukti(Request $request){
        if($request->transaksi == "sale"){
            if($request->file('inputBukti')) {
                // dd($request);
                $sales = SaleTransactionPayments::where('id_sale_payments', $request->id)->get();

                $id_sale = $sales->first()->id_sale;

                if($request->bayar == 0){
                    $id_payment = $request->id;
                }
                else{
                    $id_payment = $request->id + 1;
                }

                $uploadedFile = $request->file('inputBukti');
                $extension = '.'.$uploadedFile->getClientOriginalExtension();
                $filename  = date('Y-m-d') . '_bukti_pembayaran_' . Auth::user()->name . '_id_transaksi_' . $id_sale . '_id_pembayaran_' . $id_payment . $extension;
                $uploadedFile->move(base_path('public/images/bukti_pembayaran/'), $filename);

                $pembayaran = $sales->sum('pembayaran');

                $bayar = $sales->first()->saletransactions->total - $pembayaran;

                // dd($bayar);

                if($sales->first()->bukti_pembayaran == null){
                    // dd($request->all());
                    SaleTransactionPayments::where('id_sale_payments', $request->id)->update([
                        "bukti_pembayaran" => $filename,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
                elseif($request->uploadulang != 0){
                    SaleTransactionPayments::where('id_sale_payments', $request->id)->update([
                        "bukti_pembayaran" => $filename,
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                    SaleTransactions::where('id_sale', $id_sale)->update([
                        "status" => "Not Confirmed",
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
                else{
                    // dd('tes');
                    SaleTransactionPayments::create([
                        "id_sale" => $id_sale,
                        "bukti_pembayaran" => $filename,
                        "pembayaran" => $bayar,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);

                    SaleTransactions::where('id_sale', $id_sale)->update([
                        'status_bayar' => 'Lunas',
                        'status' => 'Not Confirmed',
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
        elseif ($request->transaksi == "order") {
            if($request->file('inputBukti')) {
                // dd($request);
                $orders = OrderTransactionPayments::where('id_order_payments', $request->id)->get();

                $id_order = $orders->first()->id_order;

                if($request->bayar == 0){
                    $id_payment = $request->id;
                }
                else{
                    $id_payment = $request->id + 1;
                }

                $uploadedFile = $request->file('inputBukti');
                $extension = '.'.$uploadedFile->getClientOriginalExtension();
                $filename  = date('Y-m-d') . '_bukti_pembayaran_' . Auth::user()->name . '_id_transaksi_' . $id_order . '_id_pembayaran_' . $id_payment . $extension;
                $uploadedFile->move(base_path('public/images/bukti_pembayaran/'), $filename);

                $pembayaran = $orders->sum('pembayaran');

                $bayar = $orders->first()->ordertransactions->total - $pembayaran;

                // dd($bayar);

                if($orders->first()->bukti_pembayaran == null){
                    // dd($request->all());
                    OrderTransactionPayments::where('id_order_payments', $request->id)->update([
                        "bukti_pembayaran" => $filename,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
                elseif($request->uploadulang != 0){
                    OrderTransactionPayments::where('id_order_payments', $request->id)->update([
                        "bukti_pembayaran" => $filename,
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                    OrderTransactions::where('id_order', $id_order)->update([
                        "status" => "Not Confirmed",
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
                else{
                    // dd('tes');
                    OrderTransactionPayments::create([
                        "id_order" => $id_order,
                        "bukti_pembayaran" => $filename,
                        "pembayaran" => $bayar,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);

                    OrderTransactions::where('id_order', $id_order)->update([
                        'status_bayar' => 'Lunas',
                        'status' => 'Not Confirmed',
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
