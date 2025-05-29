<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simpol</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  {{-- {{ asset('assets/images/logos/favicon.png') }} --}}
  {{-- brezz --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" data-simplebar>
        <div class="d-flex mb-4 align-items-center justify-content-between">
            <a href="" class="text-nowrap logo-img ms-0 ms-md-1">
              <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="mb-4 pb-2">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">Home</span>
            </li>
            @if (Auth::user()->role=='admin')
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link primary-hover-bg"
                href='/admin/dashboard'
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-layout-dashboard fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Dashboard</span>
              </a>
            </li> 
           <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">Pesanan</span>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link warning-hover-bg"
                href='/admin/data/pesanan'
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-warning rounded-3">
                  <i class="ti ti-article fs-7 text-warning"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Pesanan</span>
              </a>
            </li>
           <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">UI Componenst</span>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link warning-hover-bg"
                href='/admin/data/userdata'
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-warning rounded-3">
                  <i class="ti ti-article fs-7 text-warning"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">user</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link primary-hover-bg"
                href="/admin/data/kategori"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-primary rounded-3">
                  <i class="ti ti-file-description fs-7 text-primary"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">kategori</span>
              </a>
            </li>
              <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link success-hover-bg"
                href="/admin/data/produk"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-success rounded-3">
                  <i class="ti ti-cards fs-7 text-success"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Produk</span>
              </a>
            </li>
            @endif
            @if (Auth::user()->role=='petugas')
                 <li class="sidebar-item">
              <a
                class="sidebar-link sidebar-link danger-hover-bg"
                href="./ui-alerts.html"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-danger rounded-3">
                  <i class="ti ti-alert-circle fs-7 text-danger"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Alerts</span>
              </a>
            </li>
          
            <li class="sidebar-item">
            @endif
           @if (Auth::user()->role=='anggota')
               
          
           
              <a
                class="sidebar-link sidebar-link indigo-hover-bg"
                href="/anggota/dashboard"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-indigo rounded-3">
                  <i class="ti ti-typography fs-7 text-indigo"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Dashboard</span>
              </a>
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                <span class="hide-menu">Extra</span>
              </li>
              <li class="sidebar-item">
                <a
                class="sidebar-link sidebar-link success-hover-bg"
                href="./icon-tabler.html"
                aria-expanded="false"
                >
                <span class="aside-icon p-2 bg-light-success rounded-3">
                  <i class="ti ti-mood-happy fs-7 text-success"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a
              class="sidebar-link sidebar-link primary-hover-bg"
              href="./sample-page.html"
              aria-expanded="false"
              >
              <span class="aside-icon p-2 bg-light-primary rounded-3">
                <i class="ti ti-aperture fs-7 text-primary"></i>
              </span>
              <span class="hide-menu ms-2 ps-1">Sample Page</span>
            </a>
          </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
          <span class="hide-menu">Auth</span>
        </li>
        <li class="sidebar-item">
          <a
            class="sidebar-link sidebar-link warning-hover-bg"
            href="./authentication-login.html"
            aria-expanded="false"
          >
            <span class="aside-icon p-2 bg-light-warning rounded-3">
              <i class="ti ti-login fs-7 text-warning"></i>
            </span>
            <span class="hide-menu ms-2 ps-1">Login</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a
            class="sidebar-link sidebar-link danger-hover-bg"
            href="./authentication-register.html"
            aria-expanded="false"
          >
            <span class="aside-icon p-2 bg-light-danger rounded-3">
              <i class="ti ti-user-plus fs-7 text-danger"></i>
            </span>
            <span class="hide-menu ms-2 ps-1">Register</span>
          </a>
        </li>
        @endif
        </ul>
        
        {{-- <div class="mt-5 blocks-card sidebar-ad">
          <div class="card bg-light-primary">
            <div class="card-body">
              <div class="text-center">
                <img
                src="../assets/images/backgrounds/education-blocks.png"
                width="136"
                height="136"
                class="mt-n9"
                    alt=""
                  />

                  <h5>Are you<br/> satisfied ?</h5>

                  <div class="mt-4">
                    <a href="" target="_blank" class="btn btn-primary buynow-link w-100 px-2">
                      Buy Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbar-nav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('assets/images/profile/user1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                     
                     
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>   --}}
                    <x-dropdown-link :href="route('profile.edit')">
                    <i class="ti ti-user fs-6"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                      <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            {{-- <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link> --}} 
                            <a :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="btn btn-outline-primary mx-3 mt-2 d-block shadow-none">{{('Log Out') }}</a>
                        </form>
                   
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>

{{-- isi content --}}
 <div class="container-fluid">
        @yield('content')

      </div>
{{-- end isi content --}}

       <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="" target="_blank" class="pe-1 text-primary text-decoration-underline">yang buat</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>
</html>