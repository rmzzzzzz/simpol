{{-- <x-app-layout> --}}
@extends('layouts.navigation')
@section('content')
    {{-- <x-guest-layout> --}}
    <form method="POST" action="{{ route('add.kategori') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="nama_kategori" :value="old('nama')" required autofocus autocomplete="name" />
            @error('nama_kategori')
                 <small class="text-danger">{{ $message }}</small>
            @enderror
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
