{{-- <x-app-layout> --}}
@extends('layouts.navigation')
@section('content')
    {{-- <x-guest-layout> --}}
@if (session('errors'))
    <div class="alert alert-danger">
        <strong>Lengkapi dulu alamat dan no hp anda di menu profil</strong>
    </div>
@endif
 <form method="POST" action="{{ route('pesan_sekarang') }}">
    @csrf

    <!-- ID Produk -->
    <div class="hidden">
        <x-input-label for="id_barang" :value="__('ID Produk')" />
        <x-text-input id="id_barang" class="block mt-1 w-full" type="text"
            name="id_barang" :value="$produk->id_barang" readonly />
    </div>

    <!-- ID Anggota -->
    <div class="hidden">
        <x-input-label for="detailanggota_id" :value="__('Detail Anggota ID')" />
        <x-text-input id="detailanggota_id" class="block mt-1 w-full" type="text"
            name="detailanggota_id"
            :value="Auth::user()->detail_anggota->id_anggota ?? ''"
            readonly />
    </div>

    <!-- Nama Produk -->
    <div class="mt-4">
        <x-input-label for="nama_produk" :value="__('Nama Produk')" />
        <x-text-input id="nama_produk" class="block mt-1 w-full" type="text"
            name="nama_produk" :value="$produk->nama_produk" readonly />
    </div>

    <!-- Jumlah -->
    <div class="mt-4">
        <x-input-label for="jumlah" :value="__('Jumlah')" />
        <x-text-input id="jumlah" class="block mt-1 w-full" type="number"
            name="jumlah" required />
    </div>
   <div class="mt-4">
        <x-input-label for="bulan" :value="__('Lama Simpanan (Bulan)')" />
        <x-text-input id="bulan" class="block mt-1 w-full" type="number"
            name="bulan"  min="1" max="12" />
    </div>

    <!-- Harga -->
    <div class="mt-4">
        <x-input-label for="harga" :value="__('Harga')" />
        <x-text-input id="harga" class="block mt-1 w-full" type="number"
            name="harga" :value="$produk->harga" readonly />
    </div>

    <!-- Total -->
    <div class="mt-4">
        <x-input-label for="total" :value="__('Total')" />
        <x-text-input id="total" class="block mt-1 w-full" type="number"
            name="total" readonly />
    </div>
 
    <!-- Awal Setoran -->
    <div class="mt-4">
        <x-input-label for="awal_setoran" :value="__('Awal Setoran')" />
        <x-text-input id="awal_setoran" class="block mt-1 w-full" type="number"
            name="jumlah_bayar" readonly />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Pesan Sekarang') }}
        </x-primary-button>
    </div>
</form>

<!-- Script perhitungan otomatis -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahInput = document.getElementById('jumlah');
        const bulanInput = document.getElementById('bulan');
        const hargaInput = document.getElementById('harga');
        const totalInput = document.getElementById('total');
        const awalSetoranInput = document.getElementById('awal_setoran');

        function hitung() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const bulan = parseFloat(bulanInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            const total = jumlah * harga;
            const awalSetoran = total / bulan;
            
  if (bulan > 12) {
        bulan = 12;
        bulanInput.value = 12;
    } else if (bulan < 1) {
        bulan = 1;
        bulanInput.value = 1;
    }

            totalInput.value = total.toFixed(0);
            awalSetoranInput.value = awalSetoran.toFixed(0);
        }

        jumlahInput.addEventListener('input', hitung);
        bulanInput.addEventListener('input', hitung);
    });
</script>


    {{-- </x-app-layout> --}}
    
    @endsection