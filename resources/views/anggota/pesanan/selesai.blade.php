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
                                           Nama</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           Alamat</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           Produk</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           Jumlah</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           Total</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           Status</div>
                                        </th>
                                        <th class="align-middle text-center text-sm">
                                            <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                           aksi</div>
                                        </th>
                                </thead>
                                <tbody>
                                    @foreach ( $data as $item)  
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
                                                    <h6 class="mb-0 text-sm">{{ $item->detail_anggota->nama_anggota ??''}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->detail_anggota->alamat ??''}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->produk->nama_produk ??'' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->detail_anggota->pesanan->first()?->jumlah ??'' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Rp {{ number_format($item->detail_anggota->pesanan->first()?->total,0, ',', '.' ??'')}}</h6>
                                                </div>
                                            </div>
                                        </td>                      
                                        <td>
                                            <div class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->distribusi->first()?->status ??''}}</h6>
                                                </div>
                                            </div>
                                        </td>  
                                      <td>
                                        <div class="align-middle text-center text-sm">
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($item->distribusi->isNotEmpty() && $item->distribusi->first()->foto)
                                                    <a href="{{ asset('storage/' . $item->distribusi->first()->foto) }}" target="_blank" class="btn btn-sm btn-info">Lihat Bukti</a>
                                                @else
                                                    <span class="text-danger">Belum Upload</span>
                                                @endif
                                            </div>
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
