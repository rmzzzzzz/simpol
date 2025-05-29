@extends('layouts.navigation')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="container">
                            <div class="d-flex mb-4 justify-content-between align-items-center">
                              <div>
                                <h6>Data setoran</h6>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           no</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           produk</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           jumlah</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           harga</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           total</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           tanggal</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           aksi</div>
                                        </th>
                                       
                                </thead>
                                <tbody>
                                    @foreach ( $pesanan as $item)  
                                    <tr>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs font-weight-bold mb-2 ">{{ $loop->iteration  }}</p>
                                        </div>
                                        </div>
                                    
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->produk->nama_produk ??''}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->jumlah ??''}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{'Rp' . number_format($item->produk->harga, 0, ',', '.' ??'') }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{'Rp' . number_format($item->total, 0, ',', '.' ??'') }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" flex items-center justify-center gap-2">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->created_at->format('d-m-Y') ??''}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                       <td>
                                        <div class="flex items-center justify-center gap-2">
                                        
                                            <a href="/anggota/setoran/riwayat/{{ $item->id_pesanan }}">
                                                <x-secondary-button>Setoran</x-secondary-button>
                                            </a>
                                            <form method="POST" action="{{ route('setor.lagi') }}">
                                                @csrf
                                                <!-- ID pesanan -->
                                                <input type="hidden" name="pesanan_id" value="{{ $item->id_pesanan }}">
                                                <!--  nominal -->
                                                <input type="hidden" name="nominal_uang" value="{{ $item->total / 12 }}">
                                                <x-primary-button>
                                                    {{ __('Setor') }}
                                                </x-primary-button>
                                            </form>
                                        </div>
                                    </td>                                        
                                    </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
