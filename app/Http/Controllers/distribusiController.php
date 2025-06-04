<?php

namespace App\Http\Controllers;
use App\Models\distribusiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class distribusiController extends Controller
{
    public function dikirim()
    {
        $user = Auth::user(); // atau 
  $data = distribusiModel::where('user_id', $user->id)
        ->where('status', 'dikirim')
        ->with([
            'pesanan.produk',
            'pesanan.detail_anggota.user'
        ])
        ->get();
return view('/petugas/distribusi/dikirim', [
    'data' => $data
]);
    }
  public function update(Request $request)
{
    // Validasi input
    $request->validate([
        'id_distribusi' => ['required', 'integer'],
        'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Validasi foto
    ]);

    // Ambil ID distribusi
    $id = $request->input('id_distribusi');
    
    // Cari distribusi berdasarkan ID
    $distri = distribusiModel::findOrFail($id);

    // Cek jika ada file foto yang di-upload
    if ($request->hasFile('foto')) {
        // Simpan foto di folder public/fotoProduk
        $foto = $request->file('foto')->store('fotobukti', 'public'); 

        // Update nama file foto di kolom bukti pada distribusi
        $distri->foto = $foto;
    }

    // Update status distribusi menjadi 'selesai'
    $distri->update([
        'status' => 'selesai',
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Pesanan Telah dikirim.');
}


    public function selesai()
    {
        $user = Auth::user(); 
  $data = distribusiModel::where('user_id', $user->id)
        ->where('status', 'selesai')
        ->with([
            'pesanan.produk',
            'pesanan.detail_anggota.user' 
        ])
        ->get();
return view('/petugas/distribusi/selesai', [
    'data' => $data
]);
    }

}
