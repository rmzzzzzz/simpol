<?php

namespace App\Http\Controllers;

use App\Models\detailAnggotaModel;
use App\Models\pesananModel;
use App\Models\produkModel;
use App\Models\setoranModel;
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
        $data['pesanan'] = pesananModel::get();
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

        DB::commit();
        return redirect()->route('setoran.bayar', $setoran->id_setoran)->with('success', 'Pesanan dan Transaksi berhasil disimpan');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
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
            ? $user->detail_anggota->pesanan()->with(['produk', 'distibusi'])->get()
            : collect();
// $data = $user->detail_anggota
//             ? $user->detail_anggota->pesanan->load('distibusi')
//             : collect(); // handle jika belum ada detailAnggota
//             // dd($user->id);
//             // dd($user->detail_anggota->user_id);
//             // dd($data);
//             return view('/anggota/pesanan/distribusi', [
//     'data' => $data
return view('/anggota/pesanan/distribusi', [
    'data' => $data
]);


//     $detail = DB::table('distribusi')
//     ->rightJoin('pesanan', 'pesanan.id_pesanan', '=', 'distribusi.pesanan_id')
//     ->select('distribusi.*', 'pesanan.*')
//     ->where('distribusi.pesanan_id', $id)
//     ->get();

// $total = $detail->sum('nominal_uang');

// $data = [
//     'detail' => $detail,
//     'total' => $total
// ];
}
}

