<?php

namespace App\Http\Controllers;

use App\Models\pesananModel;
use App\Models\produkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class pesananController extends Controller
{
    public function pesanan()
    {
        $data['pesanan'] = pesananModel::get();
        return view('admin/data/pesanan', $data);
    }

    public function formPesan($id)
{
    $product = produkModel::find($id);

    return view('anggota.pemesanan', compact('product'));
}

public function submitPesanan(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:produk,id_barang',
        'quantity' => 'required|integer|min:1'
    ]);

    $produk = produkModel::findOrFail($request->product_id);

    $user = Auth::user();
    $anggotaId = $user->detail_anggota->id_anggota; // pastikan relasi ini ada

    pesananModel::create([
        'detail_anggota_id' => $anggotaId,
        'produk_id' => $produk->id_barang,
        'jumlah' => $request->quantity,
        'tanggal' => now(),
        'total' => $produk->harga * $request->quantity
    ]);

    return redirect()->route('anggota.dashboard')->with('success', 'Pesanan berhasil dibuat!');
}
}
