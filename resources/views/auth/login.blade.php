

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simpol</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/image.png" width="180" alt="">
                </a>
                <p class="text-center">simpol</p>
                <form method="POST" action="{{ route('login') }}">
                     @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Atau Email</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="text" name="id_user" :value="old('id_user')" required autofocus autocomplete="id_user" />
            <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
                
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    {{-- <div class="form-check">
                        <label class="form-check-label text-dark" for="remember_me">
                      <input class="form-check-input primary" type="checkbox" value="" id="remember_me" name="remember" >
                      {{ __('Remember me') }}
                      </label>
                    </div> --}}
                    {{-- <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div> --}}
                  </div>
                  <button  class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Masuk</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Belum Punya Akun?</p>
                    <a class="text-primary fw-bold ms-2" href="{{route ('register') }}">Buat Akun</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>