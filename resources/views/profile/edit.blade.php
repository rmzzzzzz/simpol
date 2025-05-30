@extends('layouts.navigation')
@section('content')

    </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
              <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
            @if (Auth::user()->role=='anggota')
             <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Alamat') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Tambah alamat dan no.hp anda") }}
        </p>
            <form method="POST" action="{{ route('tambah.detail') }}">
                @csrf
                <!-- Jumlah -->
                <div hidden>
                    <x-input-label for="user_id" :value="__('id_user')" />
                    <x-text-input id="user_id" class="block mt-1 w-full" type="number"
                    name="user_id" :value="Auth::user()->id" required />
                </div>
                <div class="mt-4">
                    <x-input-label for="namaLengkap" :value="__('Nama Lengkap')" />
                    <x-text-input id="namaLengkap" class="block mt-1 w-full" type="text"
                    name="nama_anggota" :value="$data->nama_anggota ??'' " required />
                </div>
                <div class="mt-4">
                    <x-input-label for="alamat" :value="__('Alamat')" />
                    <x-text-input id="alamat" class="block mt-1 w-full" type="text"
                    name="alamat" :value="$data->alamat ??'' " required />
                </div>
                <div class="mt-4">
                    <x-input-label for="nohp" :value="__('N0.Hp')" />
                    <x-text-input id="nohp" class="block mt-1 w-full" type="number"
                    name="no_hp" :value="$data->no_hp ??'' " />
                </div>
                <div class="flex items-center  mt-4">
                    <x-primary-button >
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
            @endif
             </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection