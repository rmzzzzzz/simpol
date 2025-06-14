


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
                <p class="text-center">Simpol</p>
                <form method="POST" action="{{ route('register') }}">
                         @csrf
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" :value="old('name')" required autofocus autocomplete="name"
                    aria-describedby="textHelp"/> <x-input-error :messages="$errors->get('name')" class="mt-2" />
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control"   id="email" name="email" :value="old('email')" required autocomplete="username" aria-describedby="emailHelp"> <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password" >
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" >
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>
                  <button class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Daftar</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Sudah Punya akun?</p>
                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Masuk</a>
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