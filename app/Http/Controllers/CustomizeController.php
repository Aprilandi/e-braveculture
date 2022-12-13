<?php

namespace App\Http\Controllers;

use App\Helpers\RajaOngkir;
use App\Models\Colour;
use App\Models\Materials;
use App\Models\OrderTransactionDetails;
use App\Models\OrderTransactionImages;
use App\Models\OrderTransactionPayments;
use App\Models\OrderTransactions;
use App\Models\Points;
use App\Models\RewardHistories;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomizeController extends Controller
{
    public function index(){
        $material = Materials::get();
        $province = RajaOngkir::instance()->get_provinces();
        $city = RajaOngkir::instance()->get_cities();
        $colour = Colour::get();
        return view('customize', ['colour' => $colour, 'material' => $material, 'province' => $province, 'city' => $city]);
    }

    public function saveOrder(Request $request){
        $data = json_decode($request->data);
        // dd($data);
        try{
            if($request->model){
                $model3d  = date('Y-m-d')."-".Auth::user()->name."-".date('H-i-s').".json";
                file_put_contents(public_path('/images/design/'.$model3d), $request->model);
            }

            try{
                if($data->dp < 100){
                    $stsbayar = "Belum Lunas";
                }
                else{
                    $stsbayar = "Lunas";
                }
                if(!empty($data->id_provinsi)){
                    try{
                        $user = User::where('id_user', Auth::user()->id_user)->update([
                            'city_id' => $data->id_kota,
                            'province_id' => $data->id_provinsi,
                            'nomer' => $data->nomer,
                            'alamat' => $data->alamat_user,
                            'rt' => $data->rt,
                            'rw' => $data->rw,
                            'keldes' => $data->keldes,
                            'isi_keldes' => $data->isi_keldes,
                            'kecamatan' => $data->kecamatan,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                    catch(\Exception $e){
                        dd("Data User Error: " . $e);
                    }
                }

                $pointDB = Points::where('min_sum_total', '<=', $data->ttl)->orderBy('min_sum_total', 'desc')->first();

                $points = $data->ttl * ( $pointDB->point / 100 );

                $bonusPoint = $points * ( Auth::user()->userstatus->levels->bonus_point / 100 );

                $totalPoints = $points + $bonusPoint;

                if($data->voucher != 0){
                    $dataVoucher = RewardHistories::where('id_history', $data->voucher)->get();
                    $voucher = $dataVoucher->first()->rewards->value;
                }
                else{
                    $voucher = 0;
                }


                try{
                    $id_order = OrderTransactions::create([
                        "id_colour" => $data->warna,
                        "id_combed" => $data->combed,
                        "id_user" => Auth::user()->id_user,
                        "alamat_penuh" => $data->alamat,
                        "total_quantity" => $data->total_quantity,
                        "sub_total" => $data->subttl,
                        "kurir" => $data->kurir,
                        "paket" => $data->paket,
                        "shipping_fee" => $data->ongkir,
                        "total" => $data->ttl - $voucher,
                        "dp" => $data->dp,
                        "status_bayar" => $stsbayar,
                        "perolehan_points" => $points,
                        "bonus_points" => $bonusPoint,
                        "persentase_bonus" => Auth::user()->userstatus->levels->bonus_point,
                        "status" => "Not Confirmed",
                        "model_3d_json" => $model3d,
                        "canvas_height" => $data->height,
                        "canvas_width" => $data->width,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ])->id_order;
                    $payments = OrderTransactionPayments::create([
                        "id_order" => $id_order,
                        "pembayaran" => ($data->ttl * ( $data->dp / 100 )) - $voucher,
                        "created_at" => date('Y-m-d H:i:s'),
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
                catch(\Exception $e){
                    dd("Error Saving Order: " . $e);
                }

                if($data->voucher != 0){
                    try{
                        RewardHistories::where('id_history', $data->voucher)->update([
                            "Status" => "Claimed",
                            "updated_at" => date('Y-m-d H:i:s')
                        ]);
                        OrderTransactions::where('id_order', $id_order)->update([
                            "id_voucher"  => $data->voucher
                        ]);
                    }
                    catch(\Exception $e){
                        dd("Error Redeeming Voucher: " . $e);
                    }
                }

                $oldRP = UserStatus::where('id_user', '=', Auth::user()->id_user)->select('redeemable_points_pending')->get();

                $newRP = $oldRP->first()->redeemable_points_pending + $totalPoints;

                try {
                    UserStatus::where('id_user', '=', Auth::user()->id_user)->update([
                        'redeemable_points_pending' => $newRP,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    $userSts = "updated";
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            catch(\Exception $e){
                dd("Saving Database Error: " . $e);
            }

            if($data->ukuran){
                try{
                    foreach($data->ukuran as $row){
                        OrderTransactionDetails::create([
                            "id_order" => $id_order,
                            "size" => $row->ukuran,
                            "product_quantity" => $row->jumlah,
                            "created_at" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s')
                        ]);
                    }
                }
                catch(\Exception $e){
                    dd($e);
                }
            }

            if($request->image){
                foreach(json_decode($request->image) as $key => $value){
                    $i = 1;
                    foreach($value as $key2 => $value2){
                        try{
                            $extension = "." . pathinfo($value2->FileName, PATHINFO_EXTENSION);
                            // dd(json_decode($request->image));
                            $filename  = date('Y-m-d')."-".Auth::user()->name."-".$key."-".$i.$extension;
                            // dd($value2->Content);
                            // Obtain the original content (usually binary data)
                            $bin = base64_decode($value2->Content);

                            // Load GD resource from binary data
                            $im = imageCreateFromString($bin);

                            // Make sure that the GD library was able to load the image
                            // This is important, because you should not miss corrupted or unsupported images
                            if (!$im) {
                                die('Base64 value is not a valid image');
                            }

                            // Save the GD resource as PNG in the best possible quality (no compression)
                            // This will strip any metadata or invalid contents (including, the PHP backdoor)
                            // To block any possible exploits, consider increasing the compression level
                            imagepng($im, public_path('/images/design/'.$filename), 0);
                            $i++;

                            try{
                                OrderTransactionImages::create([
                                    "id_order" => $id_order,
                                    "bagian" => $key,
                                    "image" => $filename,
                                    "created_at" => date('Y-m-d H:i:s'),
                                    "updated_at" => date('Y-m-d H:i:s')
                                ]);
                            }
                            catch(\Exception $e){
                                dd("Database Images Error: " . $e);
                            }
                        }
                        catch(\Exception $e){
                            OrderTransactionPayments::where('id_order', $id_order)->delete();
                            OrderTransactionImages::where('id_order', $id_order)->delete();
                            OrderTransactionDetails::where('id_order', $id_order)->delete();
                            OrderTransactions::where('id_order', $id_order)->delete();
                            if($userSts == "updated"){
                                UserStatus::where('id_user', '=', Auth::user()->id_user)->update([
                                    'redeemable_points_pending' => $oldRP,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            }
                            dd("Saving Image Error: " . $e);
                        }
                    }
                }
            }
        }
        catch(\Exception $e){
            dd("Saving Image Error: " . $e);
        }
    }
}
