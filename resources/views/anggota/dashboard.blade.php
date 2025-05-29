@extends('layouts.navigation')
@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div id="notif"
     class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-500 text-white font-bold py-3 px-6 rounded shadow-lg z-50">
    You're logged in anggota!
</div>

<script>
    setTimeout(() => {
        document.getElementById('notif').style.display = 'none';
    }, 3000);
</script>

<style>
    /* Dashboard main title */
    .dashboard-title {
        text-align: center;
        font-weight: 800;
        font-size: 2.25rem;
        color: #007bff;
        margin-bottom: 2rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .category-title {
        margin-top: 2rem;
        font-size: 1.5rem;
        font-weight: bold;
        color: #007bff;
        border-bottom: 3px solid #007bff;
        padding-bottom: 0.25rem;
    }
    /* Added margin-bottom for spacing below category title */
    .category-section {
        margin-bottom: 2rem; /* space between category and next category */
    }
    .products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem; /* space between category title and products */
    }
    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        width: 250px;
        overflow: hidden;
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
    .card-body {
        padding: 1rem;
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .card-text {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0.5rem 0;
    }
    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<!-- Main Dashboard Title -->
<h1 class="dashboard-title">Dashboard Produk</h1>

@foreach($produk as $kategori => $items)
    <section class="category-section">
        <h2 class="category-title">{{ ucfirst($kategori) }}</h2>
        <div class="products-container">
            @foreach($items as $item)
                <div class="card">
                    <img src="{{ $item->image_url }}" alt="{{ $item->nama_produk }}" class="card-img-top">
                    <div class="card-body">
                        <div class="card-title">{{ $item->nama_produk }}</div>
                        <div class="card-text">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                        <a href="{{ url('anggota/pesanan/'.$item->id_barang.'/pesanan') }}" class="btn-primary">Pesan</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endforeach

@endsection
