<?php

namespace App\Http\Controllers;

use App\Models\setoranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class setoranController extends Controller
{
public function bayar($id)
{
    $setoran = setoranModel::findOrFail($id);
// dd($setoran->snap_token);
    return view('/anggota/setoran/bayar', [
        'snapToken' => $setoran->snap_token,
        'id'=>$setoran->id_setoran
    ]);
}
 public function riwayat($id)
    {
        $data =['detail'=> DB::table('setoran')
    ->rightJoin('pesanan', 'pesanan.id_pesanan', '=', 'setoran.pesanan_id')
    ->select('setoran.*', 'pesanan.*')
    ->where('setoran.pesanan_id', $id)
    ->get()];


        return view("anggota/setoran/riwayat", $data);}

public function sukses(setoranModel $setoran ){
    $setoran->status = 'berhasil';
    $setoran->save();
    return redirect('anggota/pesanan/riwayat');
}
}
