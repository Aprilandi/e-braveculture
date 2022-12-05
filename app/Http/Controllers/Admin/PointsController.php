<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Points;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function index() {
        $pp = Points::orderBy('min_sum_total', 'asc')->get();
        $pl = 0;
        $index = 0;
        $min = "";
        $max = "";
        $summax = $pp[count($pp)-1]->min_sum_total;
        foreach ($pp as $row) {
            if($index != 0){
                $pl = $index;
                $min = $pp[( $index - 1 )]->min_sum_total;
                $max = $pp[$index]->min_sum_total;
                // dd($tl, $min, $max);
                break;
            }
            if($index === ( count($pp) - 1 )){
                $pl = $index + 1;
                $min = $pp[$index]->min_sum_total;
                break;
            }
            $index++;
        }
        return view('admin/gamifikasi/points', ['point' => $pp, 'summax' => $summax, 'min' => $min, 'max' => $max, 'tl' => $pl, 'page' => 'Points'])->with('points', 'active');
    }

    public function store(Request $request) {
        // return $request->all();
        $point = Points::create([
            'point' => $request->txtPoint,
            'min_sum_total' => $request->txtMin,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('point.index')->with('insert', 'Data Berhasil Ditambah');;
    }

    public function simpanharga(Request $request) {
        // dd($request->data);
        $a = json_decode($request->data);
        // dd($a);
        foreach($a as $key => $value){
            $point = Points::where('id_point', '=', $key)->update([
                'min_sum_total' => $value
            ]);
        }

        return redirect()->route('point.index')->with('update', 'Data Berhasil Diubah');;
    }

    public function update(Request $request, $id){
        // dd($request);
        $point = Points::where('id_point', $id)->update([
            'point' => $request->txtedPoint,
            'min_sum_total' => $request->txtedMin,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('point.index')->with('update', 'Data Berhasil Diubah');;
    }

    public function destroy($id) {
        Points::where('id_point', $id)->delete();

        return redirect()->route('point.index')->with('delete', 'Data Berhasil Dihapus');;
    }
}
