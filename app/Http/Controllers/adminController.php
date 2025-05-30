<?php

namespace App\Http\Controllers;

use App\Models\distribusiModel;
use App\Models\pesananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
     public function riwayat($id)
    {
$detail = DB::table('setoran')
    ->rightJoin('pesanan', 'pesanan.id_pesanan', '=', 'setoran.pesanan_id')
    ->select('setoran.*', 'pesanan.*')
    ->where('setoran.pesanan_id', $id)
    ->get();

$total = $detail->where('status', 'berhasil')->sum('nominal_uang');

$data = [
    'detail' => $detail,
    'total' => $total
];
    return view("admin/data/setoran", $data);
}

    public function update(Request $request)
    {
         $request->validate([
        'id_distribusi' => ['required', 'integer'],
    ]);

    // Ambil ID dari inputan request, bukan dari seluruh objek request
    $id = $request->input('id_distribusi');

    // Temukan data distribusi berdasarkan ID tersebut
    $distri = distribusiModel::findOrFail($id);

    // Update status ke "dikirim"
    $distri->update([
        'status' => 'dikirim',
    ]);

    return redirect()->back()->with('success', 'Pesanan akan segera dikirim.');
    }

    public function dikirim()
    {
           $data['pesanan'] = pesananModel::whereHas('distribusi', function($query) {
                                      $query->where('status', 'dikirim');
                                  })
                                  ->with(['produk', 'detail_anggota', 'distribusi'])
                                  ->get();
        return view('admin/data/dikirim', $data);
    }
    
    public function selesai()
    {
           $data['pesanan'] = pesananModel::whereHas('distribusi', function($query) {
                                      $query->where('status', 'selesai');
                                  })
                                  ->with(['produk', 'detail_anggota', 'distribusi'])
                                  ->get();
        return view('admin/data/selesai', $data);
    }
}