<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Khojo Right Now</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="stylesheet" href="sweet-modal/dist/min/jquery.sweet-modal.min.css" />
<script src="sweet-modal/dist/min/jquery.sweet-modal.min.js"></script>
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="public/assets/imgs/theme/favicon.svg"> --}}
    <!-- Template CSS -->
    <link href="{{asset('public/assets/css/main.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="{{ asset('restaurants/home') }}" class="brand-wrap">
                <!-- <img src="public/assets/imgs/theme/logo.svg" class="logo" alt="Khojo Dashboard"> -->
                <h3> {{ Auth::user()->name }}</h3>
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
            </div>
        </div>
        <nav>
            <ul class="menu-aside">
                <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ asset('restaurants/home') }}"> <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item has-submenu {{ request()->is('menu*') ? 'active' : '' }}">
                    <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_bag"></i>
                        <span class="text">Menu</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ asset('restaurant/menu/add') }}">Add</a>
                        <a href="{{ asset('restaurant/menu/list') }}">List</a>
                    </div>
                </li>
                <li class="menu-item has-submenu {{ request()->is('category*') ? 'active' : '' }}">
                    <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_cart"></i>
                        <span class="text">Category</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ asset('/restaurants/category/add') }}">Add</a>
                        <a href="{{ asset('/restaurants/category/list') }}">List</a>
                    </div>
                </li>
                <li class="menu-item has-submenu {{ request()->is('order*') ? 'active' : '' }}">
                    <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_cart"></i>
                        <span class="text">Order</span>
                    </a>
                    <div class="submenu">
                        <a href="{{ asset('/restaurants/order') }}">Placed</a>
                        <a href="{{ asset('/order/preparing') }}">Preparing</a>
                        <a href="{{ asset('/order/serve') }}">Serve</a>
                        <a href="{{ asset('/order/complete') }}">Complete</a>
                        <a href="{{ asset('/order/history') }}">History</a>
                    </div>
                </li>
            </ul>

            <hr>
            <ul class="menu-aside">
                <li class="menu-item">
                    <a class="menu-link" href="{{ asset('/restaurants/theme') }}"> <i class="icon material-icons md-local_offer"></i>
                        <span class="text"> Theme </span>
                    </a>
                </li>
            </ul>
            <br>
            <br>
        </nav>
    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">
            </div>
            <div class="col-nav">
                <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="material-icons md-apps"></i> </button>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{asset ('public/assets/imgs/people/avatar2.jpg')}}" alt="User"></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="{{ asset('restaurants/profile') }}"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
                            <a class="dropdown-item" href="#"><i class="material-icons md-settings"></i>Account Settings</a>
                            <a class="dropdown-item" href="#"><i class="material-icons md-help_outline"></i>Help center</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><i class="material-icons md-exit_to_app"></i>Logout</a>
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
@yield('admin-content')
<footer class="main-footer font-xs">
    <div class="row pb-30 pt-15">
        <div class="col-sm-6">
            <script>
            document.write(new Date().getFullYear())
            </script> ©, Khojo Right Now .
        </div>
        <div class="col-sm-6">
            <div class="text-sm-end">
                All rights reserved
            </div>
        </div>
    </div>
</footer>
</main>
<script src="{{asset('public/assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('public/assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/js/vendors/select2.min.js')}}"></script>
<script src="{{asset('public/assets/js/vendors/perfect-scrollbar.js')}}"></script>
<script src="{{asset('public/assets/js/vendors/jquery.fullscreen.min.js')}}"></script>
<script src="{{asset('public/assets/js/vendors/chart.js')}}"></script>
<!-- Main Script -->
<script src="{{asset('public/assets/js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/js/custom-chart.js')}}" type="text/javascript"></script>
{{-- Sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 3000,
            showConfirmButton: true
        });
    </script>
@endif
@if (session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                timer: 3000,
                showConfirmButton: true
            });
        </script>
    @endif
</body>

</html>
