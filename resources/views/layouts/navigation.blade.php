{{-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> --}}


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
           @if (Auth::user()->role=='petugas')
               
          
           
              <a
                class="sidebar-link sidebar-link indigo-hover-bg"
                href="./ui-typography.html"
                aria-expanded="false"
              >
                <span class="aside-icon p-2 bg-light-indigo rounded-3">
                  <i class="ti ti-typography fs-7 text-indigo"></i>
                </span>
                <span class="hide-menu ms-2 ps-1">Typography</span>
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
          </ul>
          <div class="pb-3 options text-nowrap">
            <div class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
              <span class="hide-menu">More options</span>
            </div>

            <ul class="sidebar-list">
              <li class="sidebar-list-item">
                <i class="ti ti-circle text-primary fs-4"></i>
                <span class="hide-menu ms-2">Applications</span>
              </li>
              <li class="sidebar-list-item">
                <i class="ti ti-circle text-danger fs-4"></i>
                <span class="hide-menu ms-2">Form Options</span>
              </li>
              <li class="sidebar-list-item">
                <i class="ti ti-circle text-warning fs-4"></i>
                <span class="hide-menu ms-2">Table Variations</span>
              </li>
              <li class="sidebar-list-item">
                <i class="ti ti-circle text-success fs-4"></i>
                <span class="hide-menu ms-2">Charts Selection</span>
              </li>
              <li class="sidebar-list-item">
                <i class="ti ti-circle text-indigo fs-4"></i>
                <span class="hide-menu ms-2">Widgets</span>
              </li>
            </ul>
          </div>
 @endif
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