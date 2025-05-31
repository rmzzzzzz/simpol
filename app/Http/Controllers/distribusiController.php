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
         $request->validate([
        'id_distribusi' => ['required', 'integer'],
    ]);
    $id = $request->input('id_distribusi');
    $distri = distribusiModel::findOrFail($id);
    $distri->update([
        'status' => 'selesai',
    ]);

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
