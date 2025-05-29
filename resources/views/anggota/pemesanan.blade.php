@extends('layouts.navigation')
@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Pemesanan Produk') }}
    </h2>
</x-slot>

<style>
    .order-container {
        max-width: 650px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .product-info {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    .product-image {
        flex: 1 1 250px;
        max-width: 250px;
        border-radius: 8px;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .product-details {
        flex: 2 1 300px;
    }
    .product-name {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #007bff;
    }
    .product-price {
        font-size: 1.4rem;
        color: #28a745;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .product-description {
        font-size: 1rem;
        color: #555;
        line-height: 1.4;
    }
    form {
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }
    label {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.3rem;
        color: #333;
    }
    input[type="text"],
    input[type="number"],
    input[type="email"],
    textarea {
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        border: 1.5px solid #ced4da;
        border-radius: 5px;
        outline-offset: 2px;
        outline-color: #007bff;
        width: 100%;
        box-sizing: border-box;
        transition: border-color 0.25s ease;
    }
    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    textarea:focus {
        border-color: #007bff;
    }
    textarea {
        resize: vertical;
        min-height: 80px;
    }
    button.submit-btn {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        align-self: flex-start;
    }
    button.submit-btn:hover {
        background-color: #0056b3;
    }
</style>

<div class="order-container">
    @if ($product ?? false)
    <div class="product-info">
        <img src="{{ $product->image_url }}" alt="{{ $product->nama_produk }}" class="product-image">
        <div class="product-details">
            <div class="product-name">{{ $product->nama_produk }}</div>
            <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
            <div class="product-description">{{ $product->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</div>
        </div>
    </div>

    <form action="{{ route('order.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <label for="customer_name">Nama Pemesan</label>
        <input type="text" id="customer_name" name="customer_name" placeholder="Masukkan nama lengkap" required>

        <label for="customer_email">Email</label>
        <input type="email" id="customer_email" name="customer_email" placeholder="Masukkan email" required>

        <label for="customer_phone">No. Telepon</label>
        <input type="text" id="customer_phone" name="customer_phone" placeholder="Masukkan nomor telepon" required pattern="[0-9+ ]+">

        <label for="quantity">Jumlah Pesanan</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1" required>

        <label for="notes">Catatan Pesanan (opsional)</label>
        <textarea id="notes" name="notes" placeholder="Tambahkan catatan..."></textarea>

        <button type="submit" class="submit-btn">Pesan Sekarang</button>
    </form>

    @else
        <p class="text-center text-red-600 font-semibold">Produk tidak ditemukan.</p>
    @endif
</div>
@endsection

