{{-- <x-app-layout> --}}
@extends('layouts.navigation')
@section('content')
    {{-- <x-guest-layout> --}}
    <form method="POST" action="{{ route('add.produk') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama produk')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="nama_produk" :value="old('nama')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        
        
        <div class="mt-4">
            <x-input-label for="name" :value="__('Nama produk')" />
            <select  class=" form-select block mt-1 w-full border-radius-sm " name="kategori_id" >
                <option selected>Pilih disini</option>
                @foreach ($nama_kategori as $item)
                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="harga" :value="__('Harga')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="harga" :value="old('nama')" required autofocus autocomplete="harga" />
        </div>
        <div class="mt-4">
            <x-input-label for="foto" :value="__('Foto')" />
            <x-text-input id="foto" class="block mt-1 w-full" type="file" name="foto" :value="old('nama')" required autofocus autocomplete="foto" />
        </div>
        <div class="flex items-center justify-end mt-4">
            
            <x-primary-button class="ms-4">
                {{ __('tambah') }}
            </x-primary-button>
        </div>
    </form>
{{-- </x-guest-layout> --}}

    @endsection
{{-- </x-app-layout> --}}
