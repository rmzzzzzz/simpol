<?php

namespace App\Http\Controllers;

use App\Models\kategoriModel;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function kategori()
    {
        $data['kategori'] = kategoriModel::get();
        return view('admin/data/kategori', $data);
    }
     public function tambah()
    {
        $data = [
            'nama_kategori' => kategoriModel::all(),
        ];
        return view('admin/add/kategori', $data);
    }
     public function action_tambah(Request $request){
     $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255','unique:kategori,nama_kategori']
        ], 
            [
        'nama_kategori.unique' => 'Nama kategori sudah terdaftar.'
        ]);

        kategoriModel::create($request->all());
        return redirect('/admin/data/kategori')->with('success', 'Berhasil Di Tambah');
    }

      public function edit($id)
    {
        $data = ['detail' => kategoriModel::findOrfail($id)];

        return view("admin/edit/kategori", $data);
}
 
public function action_edit(Request $request, $id)
{
    $kategori = kategoriModel::findOrFail($id);

    $validatedData = $request->validate([
        'nama_kategori' => ['required', 'string', 'max:255']
    ]);
    $kategori->update($validatedData); // pastikan $fillable benar di model kategori

    return redirect('/admin/data/kategori')->with('success', 'Data Berhasil Diperbarui');
}
public function hapus($id)
    {
        $kategori = kategoriModel::findOrfail($id);
            if ($kategori->produk()->exists()) {
        return back()->withErrors(['error' => 'Tidak bisa menghapus kategori karena masih memiliki produk terkait.']);
    }
        $kategori->delete();
        return back()->with('success', 'data user berhasil dihapus');
    }

}
