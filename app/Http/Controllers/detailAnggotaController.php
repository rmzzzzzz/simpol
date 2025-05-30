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
     public function action_tambah(Request $request){
     $request->validate([
            'user_id' => ['required', 'integer', 'max:255'],
            'nama_anggota' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],
        ]);
 $userId = $request->user_id;

$alamat = detailAnggotaModel::where('user_id', $userId)->first();

if ($alamat === null) {
    detailAnggotaModel::create($request->all());
} else {
    $alamat->update($request->all());
}

       
        return redirect('/anggota/dashboard')->with('success', 'Berhasil Di Tambah');
    }
}
