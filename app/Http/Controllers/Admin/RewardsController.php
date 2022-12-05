<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use App\Models\Rewards;
use App\Models\RewardTypes;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function index() {
        $rr = Rewards::get();
        $rt = RewardTypes::get();
        $ll = Levels::get();
        return view('admin/gamifikasi/rewards', ['reward' => $rr, 'type' => $rt, 'level' => $ll, 'page' => 'Rewards'])->with('rewards', 'active');
    }

    public function store(Request $request) {
        // return $request->all();

        $rr = Rewards::create([
            'id_reward_type' => $request->txtIDType,
            'id_level' => $request->txtIDLevel,
            'value' => $request->txtValue,
            'desc' => $request->txtDesc,
            'prize_point' => $request->txtPoint,
            'hari_berlaku' => $request->txtBerlaku,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('reward.index')->with('insert', 'Data Berhasil Ditambah');;
    }

    public function typestore(Request $request) {
        // return $request->all();

        if($request->file('txtGambar')) {
            $uploadedFile = $request->file('txtGambar');
            $extension = '.'.$uploadedFile->getClientOriginalExtension();
            $filename  = $request->txtType.$extension;
            $uploadedFile->move(base_path('public/images/random/'), $filename);

            $rt = RewardTypes::create([
                'reward_type' => $request->txtType,
                'gambar' => $filename,
                'desc' => $request->txtTypeDesc,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('reward.index')->with(['insert' => 'Data Berhasil Ditambah', 'typesuccess' => 'showType']);
    }

    public function update(Request $request, $id){
        // dd($request);
        $rr = Rewards::where('id_reward', $id)->update([
            'id_reward_type' => $request->txtedIDType,
            'id_level' => $request->txtedIDLevel,
            'value' => $request->txtedValue,
            'desc' => $request->txtedDesc,
            'prize_point' => $request->txtedPoint,
            'hari_berlaku' => $request->txtedBerlaku,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('reward.index')->with('update', 'Data Berhasil Diubah');;
    }

    public function typeupdate(Request $request, $id){
        // dd($request);
        if($request->file('txtedGambar')) {
            $uploadedFile = $request->file('txtedGambar');
            $extension = '.'.$uploadedFile->getClientOriginalExtension();
            $filename  = $request->txtedType.$extension;
            $uploadedFile->move(base_path('public/images/random/'), $filename);

            $rt = RewardTypes::where('id_reward_type', $id)->update([
                'reward_type' => $request->txtedType,
                'gambar' => $filename,
                'desc' => $request->txtedTypeDesc,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        else{
            $rt = RewardTypes::where('id_reward_type', $id)->update([
                'reward_type' => $request->txtedType,
                'desc' => $request->txtedTypeDesc,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('reward.index')->with(['update' => 'Data Berhasil Diubah', 'typesuccess' => 'showType']);
    }

    public function destroy($id) {
        Rewards::where('id_reward', $id)->delete();

        return redirect()->route('reward.index')->with('delete', 'Data Berhasil Dihapus');;
    }

    public function typedestroy($id) {
        RewardTypes::where('id_reward_type', $id)->delete();

        return redirect()->route('reward.index')->with(['delete' => 'Data Berhasil Dihapus', 'typesuccess' => 'showType']);;
    }
}
