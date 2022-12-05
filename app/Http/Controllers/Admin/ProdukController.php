<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\ProductDetails;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\ProductSize;
use App\Models\ProductTypes;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index() {
        $produk = Products::get();
        $tipe = ProductTypes::get();
        $material = Materials::get();
        return view('admin.produk.produk', ['product' => $produk, 'tipe' => $tipe, 'material' => $material, 'page' => 'List Produk Jual'])->with('produk', 'active');
    }

    public function store(Request $request) {
        // dd($request);

        $product = Products::create([
            'id_product_type' => $request->txtIDType,
            'id_material' => $request->txtIDMaterial,
            'product_name' => $request->txtNama,
            'product_desc' => $request->txtDesc,
            'product_price' => $request->txtHarga,
            'product_edition' => $request->txtEdisi,
            'product_discount' => $request->txtDiskon,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ])->id_product;

        foreach ($request->txtStock as $key => $value) {
            $detail = ProductDetails::create([
                'id_product' => $product,
                'id_product_size' => $key,
                'product_stock' => $value,
                'product_weight' => $request->txtBerat[$key],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ])->id_product_detail;
        }

        if($request->file('uploadgambar')) {
            foreach($request->file('uploadgambar') as $key => $value) {
                $uploadedFile = $value;
                $extension = '.'.$uploadedFile->getClientOriginalExtension();
                $filename  = $key.str_replace(' ', '-', $request->txtNama).$extension;
                $uploadedFile->move(base_path('public/images/products/'), $filename);

                $gambar = ProductImages::create([
                    'id_product' => $product,
                    'image' => $filename,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return redirect()->route('produk.index')->with('insert', 'Data Berhasil Disimpan!');

    }

    public function update(Request $request, $id){
        $product = Products::where('id_product', $id)->update([
            'id_product_type' => $request->txtedIDType,
            'id_material' => $request->txtedIDMaterial,
            'product_name' => $request->txtedNama,
            'product_desc' => $request->txtedDesc,
            'product_price' => $request->txtedHarga,
            'product_edition' => $request->txtedEdisi,
            'product_discount' => $request->txtedDiskon,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        ProductDetails::where('id_product', $id)->delete();

        foreach ($request->txtedStock as $key => $value) {
            $detail = ProductDetails::create([
                'id_product' => $id,
                'id_product_size' => $key,
                'product_stock' => $value,
                'product_weight' => $request->txtedBerat[$key],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ])->id_product_detail;
        }

        if($request->file('uploadgambared')) {
            foreach($request->file('uploadgambared') as $key => $value) {
                $uploadedFile = $value;
                $extension = '.'.$uploadedFile->getClientOriginalExtension();
                $filename  = $key.str_replace(' ', '-', $request->txtedNama).$extension;
                $uploadedFile->move(base_path('public/images/products/'), $filename);

                $gambar = ProductImages::create([
                    'id_product' => $product,
                    'image' => $filename,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return redirect()->route('produk.index')->with('update', 'Data Berhasil Dirubah!');
    }

    public function destroy($id) {
        ProductImages::where('id_product', $id)->delete();
        ProductDetails::where('id_product', $id)->delete();
        Products::where('id_product', $id)->delete();
        return redirect()->route('produk.index')->with('delete', 'Data Berhasil Dihapus!');
    }

    public function typestore(Request $request){
        // dd($request);
        $type = ProductTypes::create([
            "product_type_name" => $request->txtType,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ])->id_product_type;
        for($i = 0; $i < count($request->txtKelamin); $i++){
            for($ii = 0; $ii < count($request->txtNamaUkuran[$i]); $ii++){
                $isiArray[$i][$ii] = [];
                for($iii = 0; $iii < count($request->txtJenisUkuran[$i][$ii]); $iii++){
                    $isiArray[$i][$ii] = array_slice($isiArray[$i][$ii], 0, -1, true) +
                                            array(str_replace(' ', '_', $request->txtJenisUkuran[$i][$ii][$iii]) => $request->txtIsiJenis[$i][$ii][$iii]) +
                                            array_slice($isiArray[$i][$ii], -1, NULL, true);
                }
                $size = ProductSize::create([
                    'id_product_type' => $type,
                    'product_size' => $request->txtNamaUkuran[$i][$ii],
                    'umur' => $request->txtUmur[$i],
                    'kelamin' => $request->txtKelamin[$i],
                    'ukuran' => json_encode($isiArray[$i][$ii]),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        return redirect()->route('produk.index')->with('insert', 'Data Berhasil Ditambah!');
    }

    public function typeupdate(Request $request, $id){
        dd($request);
        ProductSize::where('id_product_type', $id)->delete();
        $type = ProductTypes::where('id_product_type', $id)->update([
            "product_type_name" => $request->txtedType,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        for($i = 0; $i < count($request->txtedKelamin); $i++){
            for($ii = 0; $ii < count($request->txtedNamaUkuran[$i]); $ii++){
                $isiArray[$i][$ii] = [];
                for($iii = 0; $iii < count($request->txtedJenisUkuran[$i][$ii]); $iii++){
                    $isiArray[$i][$ii] = array_slice($isiArray[$i][$ii], 0, -1, true) +
                                            array(str_replace(' ', '_', $request->txtedJenisUkuran[$i][$ii][$iii]) => $request->txtedIsiJenis[$i][$ii][$iii]) +
                                            array_slice($isiArray[$i][$ii], -1, NULL, true);
                }
                $size = ProductSize::create([
                    'id_product_type' => $type,
                    'product_size' => $request->txtedNamaUkuran[$i][$ii],
                    'umur' => $request->txtedUmur[$i],
                    'kelamin' => $request->txtedKelamin[$i],
                    'ukuran' => json_encode($isiArray[$i][$ii]),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        return redirect()->route('produk.index')->with('update', 'Data Berhasil Dirubah!');
    }

    public function typedestroy($id){
        ProductSize::where('id_product_type', $id)->delete();
        ProductTypes::where('id_product_type', $id)->delete();
        return redirect()->route('produk.index')->with('delete', 'Data Berhasil Dihapus!');
    }
}
