@extends('layouts.navigation')
@section('content')
     <div class="card">
                    <div class="card-header">
                      Pembayaran
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">{{'Rp' . number_format($nominal, 0, ',', '.' ??'') }}</h5>
                      <p class="card-text">Silahkan segera melakukan pembayaran.</p>
                      {{-- <a href="#" class="btn btn-primary" id="pay-button">bayar sekaraang</a> --}}
                      <button type="button" class="btn btn-primary mt-4" id="pay-button">bayar sekarang</button>
                    </div>
                  </div>
                  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
     <script type="text/javascript">

      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
       
        snap.pay('{{ $snapToken  }}', {
          // Optional
          onSuccess: function(result){
            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            window.location.href = '{{ route('setoran-sukses', $id) }}';
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
@endsection