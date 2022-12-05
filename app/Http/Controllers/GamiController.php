<?php

namespace App\Http\Controllers;

use App\Models\Levels;
use App\Models\Points;
use App\Models\ProductDetails;
use App\Models\Products;
use App\Models\Quiz;
use App\Models\RewardHistories;
use App\Models\Rewards;
use App\Models\SaleTransactionDetails;
use App\Models\SaleTransactionPayments;
use App\Models\SaleTransactions;
use App\Models\User;
use App\Models\UserStatus;
use App\QuizHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class GamiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reward(){
        // $reward = Rewards::get();
        $list_reward = RewardHistories::where('id_user', Auth::user()->id_user)->where('status',  'Not Claimed')->get();
        $tier = Levels::get();
        foreach ($tier as $row) {
            $reward[$row->tier_level] = Rewards::where('id_level', $row->id_level)->get();
        }
        return view('reward', ['reward' => $reward, 'tier' => $tier, 'list_reward' => $list_reward]);
    }

    public function claim_reward(Request $request){
        $reward = Rewards::where('id_reward', $request->id_reward)->get();
        // dd(Auth::user()->userstatus->levels->tier_level);
        if(Auth::user()->userstatus->levels->tier_level >= $reward->first()->levels->tier_level){
            if(Auth::user()->userstatus->redeemable_points >= $reward->first()->prize_point){
                $RP = Auth::user()->userstatus->redeemable_points - $reward->first()->prize_point;
                try {
                    $user = UserStatus::where('id_user', Auth::user()->id_user)->update([
                        'redeemable_points' => $RP,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    $reward = Rewards::where('id_reward', $request->id_reward)->get();
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::today());
                    $exDate = $date->addDays($reward->first()->hari_berlaku);
                    $rewardhistories = RewardHistories::create([
                        'id_user' => Auth::user()->id_user,
                        'id_reward' => $request->id_reward,
                        'status' => 'Not Claimed',
                        'expired_at' => $exDate,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')

                    ]);
                } catch (\Exception $ex) {
                    return $ex;
                }
                $status = "success";
                $msg = "Berhasil Menukarkan Hadiah.";
            }
            else{
                $status = "error";
                $msg = "Point anda tidak mencukupi untuk mengklaim hadiah ini.";
            }
        }
        else{
            $status = "error";
            $msg = "Level anda terlalu rendah untuk mengklaim hadiah ini.";
        }
        return redirect()->route('rewards', ['user' => Auth::user()->username])->with(['status' => $status, 'msg' => $msg]);
    }

    public function quiz(){
        return view('quiz');
    }

    public function get_ques(){
        $quiz = Quiz::inRandomOrder()->limit(5)->with(['answer' => function($q){ $q->inRandomOrder(); }])->get();
        return json_encode($quiz);
    }

    public function get_tries(Request $request){
        $tries = QuizHistory::where('id_user', Auth::user()->id_user)->whereDate('created_at', Carbon::today())->count();
        if($tries < 5){
            $sts = 1;
        }
        else{
            $sts = 0;
        }
        // dd($sts);
        return $sts;
    }

    public function saveQues(Request $request){
        $xp = $request->result * 1;
        $rp = $request->result * 5;
        $user = UserStatus::where('id_user', Auth::user()->id_user)->get();
        $newXP = $user->first()->experience_points + $xp;
        $newRP = $user->first()->redeemable_points + $rp;

        try{
            QuizHistory::create([
                "id_user" => Auth::user()->id_user,
                "benar" => $request->result,
                "redeemable_points" => $rp,
                "experience_points" => $xp,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ]);
        }
        catch(\Exception $e){
            dd("Error saving quiz history: " . $e);
        }

        try{
            UserStatus::where('id_user', Auth::user()->id_user)->update([
                "redeemable_points" => $newRP,
                "experience_points" => $newXP,
                "updated_at" => date('Y-m-d H:i:s')
            ]);
        }
        catch(\Exception $e){
            dd("Error updating user status: " . $e);
        }

        return dd("Berhasil");
    }

    public function checkout(Request $request){
        // dd($request->data);
        if(session('cart')){
            $a = json_decode($request->data);
            $cart = session()->get('cart');
            // dd($cart);
            $ttl = array_sum(array_column($cart, "ttlPrice"));

            $pointDB = Points::where('min_sum_total', '<=', $ttl)->orderBy('min_sum_total', 'desc')->first();

            $points = $ttl * ( $pointDB->point / 100 );

            $bonusPoint = $points * ( Auth::user()->userstatus->levels->bonus_point / 100 );

            $totalPoints = $points + $bonusPoint;
            // dd($points);
            // if ($ttl <= 50000){
            //     $points = $ttl * (0.4 / 100);
            // }
            // else if ($ttl > 50000 && $ttl <= 100000){
            //     $points = $ttl * (0.5 / 100);
            // }
            // else if ($ttl > 100000 && $ttl <= 200000){
            //     $points = $ttl * (0.6 / 100);
            // }
            // else if ($ttl > 200000 && $ttl <= 500000){
            //     $points = $ttl * (0.7 / 100);
            // }
            // else if ($ttl > 500000 && $ttl <= 1000000){
            //     $points = $ttl * (0.8 / 100);
            // }
            // else if ($ttl > 1000000 && $ttl <= 3000000){
            //     $points = $ttl * (0.9 / 100);
            // }
            // else if ($ttl > 3000000 && $ttl <= 5000000){
            //     $points = $ttl * (1.0 / 100);
            // }
            // else if ($ttl > 5000000){
            //     $points = $ttl * (1.1 / 100);
            // }
            // dd($points);
            if($a->dp < 100){
                $stsbayar = "Belum Lunas";
            }
            else{
                $stsbayar = "Lunas";
            }
            if(!empty($a->id_provinsi)){
                try{
                    $user = User::where('id_user', Auth::user()->id_user)->update([
                        'city_id' => $a->id_kota,
                        'province_id' => $a->id_provinsi,
                        'nomer' => $a->nomer,
                        'alamat' => $a->alamat_user,
                        'rt' => $a->rt,
                        'rw' => $a->rw,
                        'keldes' => $a->keldes,
                        'isi_keldes' => $a->isi_keldes,
                        'kecamatan' => $a->kecamatan,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
                catch(\Exception $e){
                    dd($e);
                }
            }

            if($a->diskon != 0){
                $diskon = RewardHistories::where('id_history', $a->diskon)->get();
                $total =  ( array_sum(array_column($cart, "ttlPrice")) + $a->ongkir ) - ( array_sum(array_column($cart, "ttlPrice")) * ( $diskon->first()->rewards->value / 100 ) );
                try{
                    RewardHistories::where('id_history', $a->diskon)->update([
                        "Status" => "Claimed",
                        "updated_at" => date('Y-m-d H:i:s')
                    ]);
                }
                catch(\Exception $e){
                    dd($e);
                }
            }
            else{
                $total = ( array_sum(array_column($cart, "ttlPrice")) + $a->ongkir );
            }

            try{
                $id_sale = SaleTransactions::create([
                    "id_user" => Auth::user()->id_user,
                    "alamat_penuh" => $a->alamat,
                    "total_quantity" => array_sum(array_column($cart, "ttlQty")),
                    "sub_total" => array_sum(array_column($cart, "ttlPrice")),
                    "kurir" => $a->kurir,
                    "paket" => $a->paket,
                    "shipping_fee" => $a->ongkir,
                    "total" => $total,
                    "status" => "Not Confirmed",
                    "dp" => $a->dp,
                    "status_bayar" => $stsbayar,
                    "perolehan_points" => $points,
                    "bonus_points" => $bonusPoint,
                    "persentase_bonus" => Auth::user()->userstatus->levels->bonus_point,
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s')
                ])->id_sale;
                $payments = SaleTransactionPayments::create([
                    "id_sale" => $id_sale,
                    "pembayaran" => ($total * ( $a->dp / 100 )),
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s')
                ]);
                if($a->diskon != 0){
                    try{
                        RewardHistories::where('id_history', $a->diskon)->update([
                            "Status" => "Claimed",
                            "updated_at" => date('Y-m-d H:i:s')
                        ]);
                        SaleTransactions::where('id_sale', $id_sale)->update([
                            "id_diskon"  => $a->diskon
                        ]);
                    }
                    catch(\Exception $e){
                        dd($e);
                    }
                }
            }
            catch(\Exception $e){
                dd($e);
            }

            foreach($cart as $id => $row){
                // dd($row);
                for($i = 0; $i < count($row['detail']); $i++){
                    try{
                        SaleTransactionDetails::insert([
                            'id_sale' => $id_sale,
                            'id_product' => $row['product_id'],
                            'id_product_size' => $row['detail'][$i]['id_product_size'],
                            'product_quantity' => $row['detail'][$i]['quantity'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                    catch(\Exception $e){
                        dd($e);
                    }

                    $oldStock = ProductDetails::where('id_product', '=', $row['product_id'])
                        ->where('id_product_size', '=', $row['detail'][$i]['id_product_size'])->select('product_stock')->get();
                    $newStock = $oldStock->first()->product_stock - $row['detail'][$i]['quantity'];

                    try{
                        ProductDetails::where('id_product', '=', $row['product_id'])
                            ->where('id_product_size', '=', $row['detail'][$i]['id_product_size'])
                            ->update(['product_stock' => $newStock]);
                    }
                    catch(\Exception $e){
                        dd($e);
                    }

                    $oldRP = UserStatus::where('id_user', '=', Auth::user()->id_user)->select('redeemable_points_pending')->get();

                    $newRP = $oldRP->first()->redeemable_points_pending + $totalPoints;


                    try {
                        UserStatus::where('id_user', '=', Auth::user()->id_user)->update([
                            'redeemable_points_pending' => $newRP,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }

                }
            }
            Session::pull('cart');
            return redirect()->route('dashboard')->with('transaksi', 'Berhasil melakukan checkout silahkan menunggu konfirmasi dari pemilik');
        }
    }
}
