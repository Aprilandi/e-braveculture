<?php

namespace App\Http\Controllers;

use App\Models\ProductDetails;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\ProductTypes;
use App\Helpers\RajaOngkir;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class ProductsController extends Controller
{
    public function index(Request $request, $sex){
        $type = ProductTypes::get();
        // dd($type);

        if(empty($request->id_tipe)){
            $products = Products::select('products.*')
            ->join('product_types', 'products.id_product_type', '=', 'product_types.id_product_type')
            ->join('product_sizes', 'product_types.id_product_type', '=', 'product_sizes.id_product_type')
            ->where('product_sizes.kelamin', $sex)
            ->groupBy('products.id_product')
            ->groupBy('products.product_name')
            ->groupBy('products.product_desc')
            ->groupBy('products.product_price')
            ->groupBy('products.product_edition')
            ->groupBy('products.id_product_type')
            ->groupBy('products.id_material')
            ->groupBy('products.product_discount')
            ->groupBy('products.created_at')
            ->groupBy('products.updated_at')
            ->paginate(6);

            // $products = Products::with('type')->with('productsize')->
            // whereHas('productsize', function($query){
            //     $query->where('kelamin', $sex);
            // })->paginate(6);
        }
        else{
            $products = Products::where('product_sex', '=', $sex)->where('id_product_type', $request->id_tipe)->paginate(6);
        }
        // dd($products);
        return view('products', ['products' => $products, 'type' => $type, 'sex' => $sex]);
    }

    public function detail($id){
        $products = Products::find($id);
        $pd = ProductDetails::where('id_product', '=', $id)->get();
        $st = $pd->sum('product_stock');
        $pi = ProductImages::where('id_product', '=', $id)->get();
        // dd($pd);
        foreach ($pd as $va) {
            # code...
            $sz[$va->id_product_size] = $pd->where('id_product_size', '=', $va->id_product_size)->first()->product_stock;
        }
        return view('product_details', ['products' => $products, 'detail' => $pd, 'image' => $pi, 'stock' => $st, 'size_stock' => $sz]);
    }

    public function cart(){
        $products = Products::get();
        $province = RajaOngkir::instance()->get_provinces();
        $city = RajaOngkir::instance()->get_cities();
        return view('cart', ['stock' => $products, 'province' => $province, 'city' => $city]);
    }

    public function addCart(Request $request, $id){
        // dd($request);
        $products = Products::find($id);
        $weight = ProductDetails::where('id_product', $id)->where('id_product_size', $request->id_product_size)->first()->product_weight;
        // dd($weight);
        if(!$products){
            abort(404);
        }
        $cart = session()->get('cart');
        if(!$cart) {
            $cart = [
                    $id => [
                        "product_id" => $id,
                        "product_name" => $products->product_name,
                        "product_price" => $products->product_price,
                        "image" => $products->images->first()->image,
                        "ttlQty" => $request->txtQty,
                        "ttlWgt" => $weight,
                        "ttlPrice" => $request->txtQty * $products->product_price,
                        "detail" => array([
                            "id_product_size" => $request->id_product_size,
                            "product_size" => $request->product_size,
                            "product_weight" => $weight,
                            "quantity" => $request->txtQty,
                            "subTtlWgt" => $weight
                        ])
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Produk berhasil di masukkan ke keranjang!');
        }
        if(isset($cart[$id])){
            for($i = 0; $i < count($cart[$id]['detail']); $i++){
                if($cart[$id]['detail'][$i]['id_product_size'] == $request->id_product_size){
                    if(($cart[$id]['detail'][$i]['quantity'] + $request->txtQty) > $products->find($id)->details->where('id_product_size', '=', $request->id_product_size)->first()->product_stock){
                        $addQty = $products->find($id)->details->where('id_product_size', '=', $request->id_product_size)->first()->product_stock - $cart[$id]['detail'][$i]['quantity'];
                        $cart[$id]['detail'][$i]['quantity'] += $addQty;
                        $cart[$id]['detail'][$i]['subTtlWgt'] += ($addQty * $cart[$id]['detail'][$i]['product_weight']);
                    }else{
                        $cart[$id]['detail'][$i]['quantity'] += $request->txtQty;
                        $cart[$id]['detail'][$i]['subTtlWgt'] += ($request->txtQty * $cart[$id]['detail'][$i]['product_weight']);
                    }
                    break;
                }
                if(($i+1) == count($cart[$id]['detail'])){
                    $cart[$id]['detail'][($i+1)]["id_product_size"] = $request->id_product_size;
                    $cart[$id]['detail'][($i+1)]["product_size"] = $request->product_size;
                    $cart[$id]['detail'][($i+1)]['product_weight'] = $weight;
                    $cart[$id]['detail'][($i+1)]["quantity"] = $request->txtQty;
                    $cart[$id]['detail'][($i+1)]['subTtlWgt'] = $weight;
                    break;
                }
            }
            $cart[$id]['ttlQty'] = array_sum(array_column($cart[$id]['detail'], "quantity"));
            $cart[$id]['ttlWgt'] = array_sum(array_column($cart[$id]['detail'], "subTtlWgt"));
            $cart[$id]['ttlPrice'] = $cart[$id]['ttlQty'] * $cart[$id]['product_price'];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Produk berhasil di masukkan ke keranjang!');
        }
        $cart [$id] = [
                    "product_id" => $id,
                    "product_name" => $products->product_name,
                    "product_price" => $products->product_price,
                    "image" => $products->images->first()->image,
                    "ttlQty" => $request->txtQty,
                    "ttlWgt" => $weight,
                    'ttlPrice' => $products->product_price * $request->txtQty,
                    "detail" => array([
                        "id_product_size" => $request->id_product_size,
                        "product_size" => $request->product_size,
                        "product_weight" => $weight,
                        "quantity" => $request->txtQty,
                        "subTtlWgt" => $weight
                        ])
                    ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil di masukkan ke keranjang!');
    }

    public function cartUpdate(Request $request){
        // dd($request);
        // echo 'tes';
        try{
            if($request->id && $request->quantity && $request->size)
            {
                    $cart = session()->get('cart');
                    for($i = 0; $i < count($cart[$request->id]['detail']); $i++ ){
                        if($cart[$request->id]['detail'][$i]['id_product_size'] == $request->size){
                            $cart[$request->id]['detail'][$i]["quantity"] = $request->quantity;
                            $cart[$request->id]['detail'][$i]["subTtlWgt"] = ($request->quantity * $cart[$request->id]['detail'][$i]["product_weight"]);
                        }
                    }
                    $cart[$request->id]['ttlQty'] = array_sum(array_column($cart[$request->id]['detail'], "quantity"));
                    $cart[$request->id]['ttlWgt'] = array_sum(array_column($cart[$request->id]['detail'], "subTtlWgt"));
                    $cart[$request->id]['ttlPrice'] = $cart[$request->id]['ttlQty'] * $cart[$request->id]['product_price'];
                    session()->put('cart', $cart);
                    session()->flash('success', 'Cart updated successfully');
            }
        }catch(Exception $e){
            session()->flash('error', '<script>console.log("'.$e.'")</script>');
        }
    }

    public function cartDelete(Request $request){
        try {
            if($request->id && $request->size)  {
                $cart = session()->get('cart');
                if(isset($cart[$request->id])) {
                    if(count($cart[$request->id]['detail']) > 1){
                        for($i = 0; $i < count($cart[$request->id]['detail']); $i++){
                            if($cart[$request->id]['detail'][$i]['id_product_size'] == $request->size){
                                unset($cart[$request->id]['detail'][$i]);
                                $cart[$request->id]['detail'] = array_values($cart[$request->id]['detail']);
                            }
                        }
                        $cart[$request->id]['ttlQty'] = array_sum(array_column($cart[$request->id]['detail'], "quantity"));
                        $cart[$request->id]['ttlWgt'] = array_sum(array_column($cart[$request->id]['detail'], "subTtlWgt"));
                        $cart[$request->id]['ttlPrice'] = $cart[$request->id]['ttlQty'] * $cart[$request->id]['product_price'];
                    }
                    else{
                        unset($cart[$request->id]);
                    }
                    session()->put('cart', $cart);
                }
                session()->flash('success', 'Produk berhasil dihapus!');
            }
        } catch (Exception $e) {
            session()->flash('error', '<script>console.log("'.$e.'")</script>');
        }
    }

    public function cartClear(){
        // buat hapus session
        Session::pull('cart');
        session()->flash('success', 'Cart berhasil dikosongkan!');
    }

    public function get_cost(Request $request){
        // dd(isset($request->gram));
        $cart = session()->get('cart');

        $gram = 0;
        // dd($cart);
        if(!empty($cart)){
            foreach( $cart as $id => $row ){
                $gram += $row['ttlWgt'];
            }
            // dd($cart[1]['ttlWgt']);
        }
        elseif (isset($request->gram)) {
            if($request->gram == 0){
                $gram = 1;
            }
            else{
                $gram = $request->gram;
            }
        }
        else{
            return back()->with('nocart',  'Cart anda masih kosong.');
        }

        $curl = curl_init();

        $kota = RajaOngkir::instance()->get_cities();
        foreach ($kota as $key => $value) {
            if(strtolower($value['city_name']) == 'jakarta selatan'){
                $kotapengirim = $value['city_id'];
            }
        }
        // dd($request);

        $ongkir = RajaOngkir::instance()->get_cost($kotapengirim, $request->txtKota, $gram, $request->txtKurir);

        return $ongkir;
    }
}
