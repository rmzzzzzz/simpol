<?php

namespace App\Http\Controllers;

use App\Models\kategoriModel;
use App\Models\produkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class produkController extends Controller
{
     public function produk()
    {
        $data['user'] = produkModel::get();
        return view('admin/data/produk', $data);
    }
          public function tambah()
    {
        $data = [
            'nama_kategori' => kategoriModel::all(),
        ];
        return view('admin/add/produk', $data);
    }
     public function action_tambah(Request $request){
         $request->validate([
        'nama_produk' => ['required', 'string', 'max:255'],
        'harga' => ['required', 'string', 'max:255'],
        'kategori_id' => ['required', 'string', 'max:255'],
        'foto' => ['required', 'mimes:png,jpg,jpeg', 'max:2048']
    ]);
    $foto = $request->file('foto')->store('fotoProduk', 'public');
    produkModel::create([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'kategori_id' => $request->kategori_id,
        'foto' => $foto,
    ]);
        return redirect('/admin/data/produk')->with('success', 'Berhasil Di Tambah');
    }

      public function edit($id)
    {
        $data = [
            'detail' => produkModel::findOrfail($id),
            'kategori' => kategoriModel::all()
        ];

        return view("admin/edit/produk", $data);
}
 
public function action_edit(Request $request, $id)
{
    $request->validate([
        'nama_produk' => ['required', 'string', 'max:255'],
        'harga' => ['required', 'string', 'max:255'],
        'kategori_id' => ['required', 'string', 'max:255'],
        'foto' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048']
    ]);

    $produk = produkModel::findOrFail($id);
    if ($request->hasFile('foto')) {

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }
        $fotoBaru = $request->file('foto')->store('produk', 'public');
    } else {
        $fotoBaru = $produk->foto; 
    }
    $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'kategori_id' => $request->kategori_id,
        'foto' => $fotoBaru,
    ]);

    return redirect('/admin/data/produk')->with('success', 'Data Berhasil Diperbarui');
}
public function hapus($id)
    {
        $produk = produkModel::findOrfail($id);
        if ($produk->pesanan()->exists()) {
        return back()->withErrors(['error' => 'Tidak bisa menghapus kategori karena masih memiliki produk terkait.']);
    }
        $produk->delete();
        return back()->with('success', 'data user berhasil dihapus');
    }

    public function anggotaDashboard()
{
    $produk = produkModel::with('kategori')->get()->groupBy(function ($item) {
        return strtolower($item->kategori->nama_kategori); // pastikan kolom ini sesuai
    });

    return view('/anggota/dashboard', compact('produk'));
}
}
