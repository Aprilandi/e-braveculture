<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\RewardHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $product = Products::orderBy('created_at', 'desc')->get();
        RewardHistories::where('expired_at', '<=', Carbon::today())->update([
            "status" => "Expired",
            "updated_at" => date('Y-m-d H:i:s')
        ]);
        return view('dashboard', ['product' => $product])->with('dashboard', 'dashboard');
    }
}
