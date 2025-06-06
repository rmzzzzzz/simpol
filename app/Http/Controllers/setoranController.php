<?php

namespace App\Http\Controllers;

use App\Models\pesananModel;
use App\Models\setoranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class setoranController extends Controller
{

    

public function bayar($id)
{
    
    $setoran = setoranModel::findOrFail($id);
// dd($setoran);

$denda = 0;
$tanggalBayar = Carbon::now();
$setoran->id=$id;

if (!is_null($setoran->id)) {
    $setoranSebelumnya = setoranModel::where('pesanan_id', $setoran->pesanan_id)
        ->where('id_setoran', '<', $setoran->id)
        ->orderByDesc('id_setoran')
        ->first();
// dd($setoranSebelumnya);
 $jatuhTempo = Carbon::parse($setoranSebelumnya->jatuh_tempo ?? '');
    if ($setoranSebelumnya) {
        $jatuhTempo = Carbon::parse($setoranSebelumnya->jatuh_tempo);

        if ($tanggalBayar->greaterThan($jatuhTempo)) {
            $terlambatHari = (int) $jatuhTempo->diffInDays($tanggalBayar);
            $denda = (int) round($setoran->nominal_uang * 0.01 * $terlambatHari);
        }
    }
}

$totalBayar = $setoran->nominal_uang + $denda;
//  $setoran->nominal_uang = $totalBayar;
// $setoran->save();

// dd($totalBayar);
    if ($denda > 0) {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'SETORAN-' . $setoran->id_setoran . '-' . time(),
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $setoran = setoranModel::findOrFail($id);
        // Update token di database
       $setoran->fill([
                'snap_token' => $snapToken,
                'denda' => $denda,
                ]);
        $setoran->save();

    } else {
        // Gunakan snap token lama dari database
        $snapToken = $setoran->snap_token;
    }
    return view('/anggota/setoran/bayar', [
        'snapToken' => $snapToken,
        // 'snapToken' =>  $setoran->snap_token,
        'id'        => $setoran->id_setoran,
        'awal'        => $setoran->nominal_uang,
        'nominal'   => $totalBayar,
        'denda'     => $denda,
        'telat'     => $tanggalBayar->greaterThan($jatuhTempo) ? $terlambatHari : 0
    ]);
}



public function setor(Request $request)
{
    $request->validate([
        'pesanan_id' => ['required', 'integer'],
        'nominal_uang' => ['required', 'integer']
    ]);

    DB::beginTransaction();

    try {
        $pesanan = pesananModel::findOrFail($request->pesanan_id);
        $totalTagihan = $pesanan->total;
        $totalSetoran = setoranModel::where('pesanan_id', $pesanan->id_pesanan)->where('status', 'berhasil')->sum('nominal_uang');

        // Cek lunas
        if ($totalSetoran >= $totalTagihan) {
            // return back()->withErrors(['errors' => 'Tagihan sudah lunas. Tidak bisa setor lagi.']);
             return redirect()->route('pesanan.riwayat')->withErrors(['errors' => 'Tagihan sudah lunas. Tidak bisa setor lagi.']);
             
        }
        
// dd(session()->all());
        // Simpan setoran
        $setoran = setoranModel::create([
            'pesanan_id'   => $pesanan->id_pesanan,
            'nominal_uang' => $request->nominal_uang,
            'jatuh_tempo'  => Carbon::now()->addDays(30),
        ]);
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

        return redirect()->route('setoran.bayar', $setoran->id_setoran)
                         ->with('success', 'Setoran berhasil. Silakan lanjut ke pembayaran.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Gagal menyimpan setoran: ' . $e->getMessage()]);
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
