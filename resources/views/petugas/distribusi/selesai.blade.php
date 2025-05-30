@extends('layouts.navigation')

@section('content')
<h2 class="text-xl font-bold mb-4">Distribusi - Selesai</h2>
 <!-- <a href="{{ route('distribusi.dikirim') }}" class="text-blue-500 underline mb-4 inline-block">Lihat yang Dikirim</a> -->

<table class="table-auto w-full border">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2">Nama Anggota</th>
            <th class="border px-4 py-2">Produk</th>
            <th class="border px-4 py-2">Jumlah</th>
            <th class="border px-4 py-2">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($distribusi as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->pesanan->detail_anggota->nama_anggota ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $item->pesanan->produk->nama_produk ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $item->pesanan->jumlah }}</td>
                <td class="border px-4 py-2">{{ ucfirst($item->status) }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center p-4">Tidak ada data distribusi selesai.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
