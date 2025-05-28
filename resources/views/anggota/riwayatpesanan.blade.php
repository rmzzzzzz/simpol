@extends('layouts.navigation')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Riwayat Pesanan 1</h2>
        <div class="card">
            <div class="card-body">
                @if (empty($orders))
                    <p>Tidak ada riwayat pesanan.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Nama Produk</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->nama_produk }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
@endsection
