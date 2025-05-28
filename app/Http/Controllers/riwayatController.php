<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class riwayatController extends Controller
{
    public function riwayatPesanan()
    {
        // Ambil semua pesanan milik user yang login, urut berdasarkan tanggal terbaru
        $orders = DB::select("SELECT * from orders where user_id = ?", [Auth::user()->id]);

        return view('anggota.riwayatpesanan', compact('orders'));
    }
}
