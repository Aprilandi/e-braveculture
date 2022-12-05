<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    public function index() {
        $mm = Materials::get();
        return view('admin/pemesanan/sablon', [ 'material' => $mm ])->with('sablons', 'active');
    }
}
