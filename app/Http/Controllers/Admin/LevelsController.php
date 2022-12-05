<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelsController extends Controller
{
    public function index() {
        $ll = Levels::orderBy('tier_level', 'asc')->get();
        $tl = 0;
        $index = 0;
        $min = "";
        $max = "";
        $xpmax = $ll[count($ll)-1]->minimal;
        foreach ($ll as $row) {
            if($index != $row->tier_level){
                $tl = $index;
                $min = $ll[( $index - 1 )]->minimal;
                $max = $ll[$index]->minimal;
                // dd($tl, $min, $max);
                break;
            }
            if($index === ( count($ll) - 1 )){
                $tl = $index + 1;
                $min = $ll[$index]->minimal;
                break;
            }
            $index++;
        }
        return view('admin/gamifikasi/levels', ['mdLevels' => $ll, 'xpmax' => $xpmax, 'min' => $min, 'max' => $max, 'tl' => $tl, 'page' => 'Badge & Level'])->with('levels', 'active');
    }

    public function store(Request $request) {
        // dd($request->all());

        if($request->file('txtIcon')) {
            $uploadedFile = $request->file('txtIcon');
            $extension = '.'.$uploadedFile->getClientOriginalExtension();
            $filename  = $request->txtBadge.$extension;
            $uploadedFile->move(base_path('public/images/avatar/badge/'), $filename);

            $level = Levels::create([
                'tier_level' => $request->txtTier,
                'minimal' => $request->txtMin,
                'badge' => $filename,
                'bonus_point' => $request->txtBonus,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('level.index')->with('insert', 'Data Berhasil Ditambah');;
    }

    public function simpanxp(Request $request) {
        // dd($request->data);
        $a = json_decode($request->data);
        // dd($a);
        foreach($a as $key => $value){
            $level = Levels::where('tier_level', '=', $key)->update([
                'minimal' => $value
            ]);
        }

        return redirect()->route('level.index')->with('update', 'Data Berhasil Diubah');;
    }

    public function update(Request $request, $id){
        // dd($request);
        if($request->file('txtedIcon')) {
            $uploadedFile = $request->file('txtedIcon');
            $extension = '.'.$uploadedFile->getClientOriginalExtension();
            $filename  = $request->txtedBadge.$extension;
            $uploadedFile->move(base_path('public/images/avatar/badge/'), $filename);

            $level = Levels::where('id_level', $id)->update([
                'tier_level' => $request->txtedTier,
                'minimal' => $request->txtedMin,
                'badge' => $filename,
                'bonus_point' => $request->txtedBonus,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        else{
            $level = Levels::where('id_level', $id)->update([
                'tier_level' => $request->txtedTier,
                'minimal' => $request->txtedMin,
                'bonus_point' => $request->txtedBonus,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('level.index')->with('update', 'Data Berhasil Diubah');;
    }

    public function destroy($id) {
        Levels::where('id_level', $id)->delete();

        return redirect()->route('level.index')->with('delete', 'Data Berhasil Dihapus');;
    }

}
