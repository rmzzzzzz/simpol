<?php

namespace App\Http\Controllers;

use App\Models\detailAnggotaModel;
use Illuminate\Http\Request;

class detailAnggotaController extends Controller
{
   public function detail_anggota()
    {
        $data = detailAnggotaModel::get();
        return view('admin/data/pesanan', $data);
    }
}
