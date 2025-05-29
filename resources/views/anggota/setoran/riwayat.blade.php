@extends('layouts.navigation')
@section('content')
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
                              <div>
                                 <a href="/admin/data/setoran"><x-primary-button >tambah</x-primary-button ></a>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            no</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            nominal</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            status</th>
                                      
                                </thead>
                                <tbody>
                                    @foreach ( $detail as $item)  
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                            <p class="text-xs font-weight-bold mb-2 ">{{ $loop->iteration  }}</p>
                                        </div>
                                        </div>
                                    
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->nominal_uang ??''}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $item->status ??''}}</h6>
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
