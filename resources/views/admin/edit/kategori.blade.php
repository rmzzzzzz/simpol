{{-- <x-app-layout> --}}
@extends('layouts.navigation')
@section('content')
    {{-- <x-guest-layout> --}}
    <form method="POST" action="/admin/edit/{{ $detail->id_kategori }}/kategori">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('nama kategori')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="nama_kategori" :value="old('name', $detail->nama_kategori)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('simpan') }}
            </x-primary-button>
        </div>
    </form>
{{-- </x-guest-layout> --}}

    @endsection
{{-- </x-app-layout> --}}
