<?php

namespace App\Http\Controllers;

use App\Models\detailAnggotaModel;
use App\Models\distribusiModel;
use App\Models\pesananModel;
use App\Models\produkModel;
use App\Models\setoranModel;
use App\Models\User;
use App\Models\userModel;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Midtrans\Config;
use Midtrans\Snap;


class pesananController extends Controller
{
    public function pesanan()
    {
           $data['pesanan'] = pesananModel::whereHas('distribusi', function($query) {
                                      $query->where('status', 'proses');
                                  })
                                  ->with(['produk', 'detail_anggota', 'distribusi'])
                                  ->get();
        return view('admin/data/pesanan', $data);
    }

        public function pesan($id)
    {
        $produk = produkModel::findOrFail($id);

        $data = [
            'produk' => $produk,
            'user' => Auth::user(), // Ambil user yang login
        ];

        return view('/anggota/pesanan/pesanan', $data);
    }

    // Proses pemesanan
 public function action_pesan(Request $request)
{
    $request->validate([
        'id_barang' => ['required', 'integer', 'min:1'],
        'detailanggota_id' => ['required', 'integer', 'min:1'],
        'jumlah' => ['required', 'integer', 'min:1'],
        'total' => ['required', 'integer'],
        'jumlah_bayar' => ['required', 'integer']
    ]);

    DB::beginTransaction();
    try {
        $pesanan = PesananModel::create([
            'detail_anggota_id' => $request->detailanggota_id,
            'produk_id' => $request->id_barang,
            'jumlah' => $request->jumlah,
            // 'tanggal' => now(), // wajib karena field tidak nullable
            'total' => $request->total
        ]);

        $setoran = setoranModel::create([
            'pesanan_id' => $pesanan->id_pesanan, // sesuaikan dengan primary key
            'nominal_uang' => $request->jumlah_bayar
        ]);


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
// dd($snapToken);

$userId = User::where('role', 'petugas')->inRandomOrder()->value('id');
distribusiModel::create([
    'user_id'=>$userId,
'pesanan_id' => $pesanan->id_pesanan,
'anggota_id' => $request->detailanggota_id,
]);
        DB::commit();
        return redirect()->route('setoran.bayar', $setoran->id_setoran)->with('success', 'Pesanan dan Transaksi berhasil disimpan');
    } catch (\Exception ) {
        DB::rollBack();
         return back()->with(['errors' => 'Gagal menyimpan data: '])->withInput();
    }
}

public function riwayat()
{
//    $user = auth()->user();
    $user = Auth::user()->id;
    // dd($user);
    $anggota = detailAnggotaModel::where('user_id', $user)->first();
    // dd($idAnggota);
    $idAnggota = $anggota->id_anggota ??'';
    $data['pesanan'] = pesananModel::where('detail_anggota_id', $idAnggota)->get();
        return view('/anggota/pesanan/riwayat', $data);
}


public function distribusi()
{
    $user = Auth::user(); // atau $request->user();

// $data = $user->detail_anggota
//             ? $user->detail_anggota->pesanan->load(['produk', 'distibusi'])
//             : collect();
$data = $user->detail_anggota
            ? $user->detail_anggota->pesanan()
                ->whereHas('distribusi', function($query) {
                    $query->where('status', 'dikirim');
                })
                ->with(['produk', 'distribusi'])
                ->get()
            : collect();
return view('/anggota/pesanan/distribusi', [
    'data' => $data
]);


}
}

