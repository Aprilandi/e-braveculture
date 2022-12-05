<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colour;
use App\Models\Materials;
use Illuminate\Http\Request;

class SablonController extends Controller
{
    public function index(){
        $material = Materials::get();
        $colour = Colour::get();
        return view('admin.produk.sablon', ['material' => $material, 'colour' => $colour, 'page' => 'List Bahan Sablon'])->with('sablon', 'active');
    }

    public function simpankain(Request $request){
        $material = Materials::create([
            "material_name" => $request->txtNamaKain,
            "material_desc" => $request->txtDesc,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('sablon.index')->with('insert', 'Data Berhasil Ditambah!');
    }

    public function editkain(Request $request, $id){
        $material = Materials::where('id_material', $id)->update([
            "material_name" => $request->txtedNamaKain,
            "material_desc" => $request->txtedDesc,
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('sablon.index')->with('update', 'Data Berhasil Dirubah!');
    }

    public function hapuskain($id){
        Materials::where('id_material', $id)->delete();

        return redirect()->route('sablon.index')->with('delete', 'Data Berhasil Dihapus!');
    }

    public function simpanwarna(Request $request){
        $colour = Colour::create([
            "warna" => $request->txtNamaWarna,
            "rgb" => $request->txtRGBCode,
            "hex" => $request->txtHexCode,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('sablon.index')->with('insert', 'Data Berhasil Ditambah!');
    }

    public function editwarna(Request $request, $id){
        $colour = Colour::where('id_colour', $id)->update([
            "warna" => $request->txtedNamaWarna,
            "rgb" => $request->txtedRGBCode,
            "hex" => $request->txtedHexCode,
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('sablon.index')->with('update', 'Data Berhasil Dirubah!');
    }

    public function hapuswarna($id){
        Colour::where('id_colour', $id)->delete();

        return redirect()->route('sablon.index')->with('delete', 'Data Berhasil Dihapus!');
    }
}
