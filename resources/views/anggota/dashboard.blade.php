@extends('layouts.navigation')

@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

{{-- Notifikasi login --}}
<div id="notif" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="notify-box">
        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
        </svg>
        Berhasil login sebagai <span class="highlight">anggota</span>!
    </div>
</div>

<script>
    setTimeout(() => {
        document.getElementById('notif').style.display = 'none';
    }, 3000);
</script>

<style>
    @keyframes fadeScaleIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    #notif {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: auto;
    }

    #notif .notify-box {
        background: linear-gradient(135deg, #38b2ac, #319795);
        color: #f0fdfa;
        font-size: 1.125rem;
        font-weight: 600;
        padding: 1rem 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(50, 50, 60, 0.2), 0 1px 3px rgba(50, 50, 60, 0.15);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: fadeScaleIn 0.4s ease forwards;
        user-select: none;
    }

    #notif .notify-box .icon {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
        fill: #a7f3d0;
    }

    #notif .notify-box .highlight {
        font-weight: 700;
        color: #d4f9f0;
    }

    /* Dashboard styles */
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

    .category-section {
        margin-bottom: 2rem;
    }

    .products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
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
<h1 class="dashboard-title">Daftar Produk</h1>

@foreach($produk as $kategori => $items)
    <section class="category-section">
        <h2 class="category-title">{{ ucfirst($kategori) }}</h2>
        <div class="products-container">
            @foreach($items as $item)
                <div class="card">
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_produk }}" class="card-img-top">
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
