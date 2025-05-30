<?php

namespace App\Http\Controllers;

use App\Models\kategoriModel;
use App\Models\produkModel;
use Illuminate\Http\Request;

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
            'kategori_id' => ['required', 'string', 'max:255']
        ]);

        produkModel::create($request->all());
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
    $produk = produkModel::findOrFail($id);

    $validatedData = $request->validate([
        'nama_produk' => ['required', 'string', 'max:255']
    ]);
    $produk->update($validatedData); // pastikan $fillable benar di model produk

    return redirect('/admin/data/produk')->with('success', 'Data Berhasil Diperbarui');
}
public function hapus($id)
    {
        $user = produkModel::findOrfail($id);
        $user->delete();
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
