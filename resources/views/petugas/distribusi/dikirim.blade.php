@extends('layouts.navigation')

@section('content')
<h2 class="text-xl font-bold mb-4">Distribusi - Dikirim</h2>
<!-- <a href="{{ route('distribusi.selesai') }}" class="text-blue-500 underline mb-4 inline-block">Lihat yang Selesai</a> -->

{{-- Flash message --}}
@if (session('success'))
    <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

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
                <td class="border px-4 py-2">
                    {{ ucfirst($item->status) }}
                    @if ($item->status !== 'selesai')
                        <form action="{{ route('distribusi.updateStatus', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="ml-2 text-green-500 underline">Tandai Selesai</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-4">Tidak ada data distribusi dikirim.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
