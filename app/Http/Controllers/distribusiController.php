<?php

namespace App\Http\Controllers;
use App\Models\distribusiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class distribusiController extends Controller
{
    public function dikirim()
    {
        $userId = Auth::id();
        $distribusi = distribusiModel::whereHas('pesanan.detail_anggota', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'dikirim')->get();
    
        return view('petugas.distribusi.dikirim', compact('distribusi'));
    }
    
    public function selesai()
    {
        $userId = Auth::id();
        $distribusi = distribusiModel::whereHas('pesanan.detail_anggota', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'selesai')->get();
    
        return view('petugas.distribusi.selesai', compact('distribusi'));
    }

    public function updateStatus($id)
{
    $distribusi = distribusiModel::findOrFail($id);
    $distribusi->status = 'selesai';
    $distribusi->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
}

}
