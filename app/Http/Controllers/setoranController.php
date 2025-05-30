<?php

namespace App\Http\Controllers;

use App\Models\setoranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class setoranController extends Controller
{
public function bayar($id)
{

    $setoran = setoranModel::findOrFail($id);
// dd($setoran->snap_token);
    return view('/anggota/setoran/bayar', [
        'snapToken' => $setoran->snap_token,
        'id'=>$setoran->id_setoran,
        'nominal'=>$setoran->nominal_uang
    ]);
}

 public function setor(Request $request)
 {
     $request->validate([
        'pesanan_id' => ['required', 'integer'],
        'nominal_uang' => ['required', 'integer']
    ]);
     try {
  $setoran = setoranModel::create([
            'pesanan_id' => $request->pesanan_id,// sesuaikan dengan primary key
            'nominal_uang' => $request->nominal_uang
        ]);
// if (!function_exists('curl_init')) {
//     dd('cURL is NOT enabled on your server.');
// }

        // Set your Merchant Server Key
\Midtrans\Config::$serverKey = config('midtrans.serverKey');
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;
$params = array(
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => $setoran->nominal_uang,
    ),  'customer_details' => array(
                'name' => Auth::user()->name,
                'email' =>  Auth::user()->email,
           ) 
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
$setoran -> snap_token = $snapToken;
$setoran->save();

 return redirect()->route('setoran.bayar', $setoran->id_setoran)->with('success', 'Pesanan dan Transaksi berhasil disimpan');
} catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
    }
 }

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
   
        return view("anggota/setoran/riwayat", $data);}

public function sukses(setoranModel $setoran ){
    $setoran->status = 'berhasil';
    $setoran->save();
    return redirect('anggota/pesanan/riwayat')->with('success', 'Transaksi berhasil');
     
}
}
