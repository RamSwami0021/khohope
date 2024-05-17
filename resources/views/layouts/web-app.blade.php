<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Khojo Right Now</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    {{-- <link href="asset{{('img/favicon.ico)}}" rel="icon"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('/public/web-assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/web-assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/web-assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('/public/web-assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('/public/web-assets/css/style.css') }}" rel="stylesheet">
<!--     <link rel="stylesheet" href="{{asset('sweet-modal/dist/min/jquery.sweet-modal.min.css)}}" /> -->
<!--     <script src="{{asset('sweet-modal/dist/min/jquery.sweet-modal.min.js)}}"></script> -->
    <style>
        .fade-carousel .carousel-inner .carousel-item {
            opacity: 0;
            transition-property: opacity;
            transition-duration: 0.5s;
            /* Adjust the duration as needed */
        }

        .fade-carousel .carousel-inner .carousel-item.active {
            opacity: 1;
        }

        .fade-carousel .carousel-inner .carousel-item.active.left,
        .fade-carousel .carousel-inner .carousel-item.active.right {
            left: 0;
            opacity: 0;
            z-index: 1;
        }

        .fade-carousel .carousel-inner .carousel-item.next,
        .fade-carousel .carousel-inner .carousel-item.prev {
            opacity: 1;
        }

        .fade-carousel .carousel-control-prev,
        .fade-carousel .carousel-control-next {
            z-index: 10;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3 px-lg-5 py-3 py-lg-0">
                <a href="#" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>{{ $user->name ?? 'Khojo' }}
                    </h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="{{ asset('/' . ($user->username ?? '#')) }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ asset('/about/' . urlencode($user->username ?? '#')) }}"
                            class="nav-item nav-link">About</a>
                        <a href="{{ asset('/contact/' . urlencode($user->username ?? '#')) }}"
                            class="nav-item nav-link">Contact</a>

                    </div>
                    <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @if (isset($SupCategorie) && count($SupCategorie) > 0)
                                @foreach ($SupCategorie as $item)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ asset('menu/' . ($user->username ?? '#')) . '/' . $item->id }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <a class="dropdown-item" href="#">Not Available</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    @if (session('customer'))
                        <a href="{{ asset('cart/' . ($user->username ?? '#')) }}" class="btn btn-primary py-2 px-4"
                            style="margin-left: 10px">Cart</a>
                    @endif

                </div>
            </nav>

            @yield('web-content')
        </div>
        <!-- Navbar & Hero End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-12 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Khojo Right Now </a>, All Rights Reserved.
                            Designed By <a class="border-bottom" href="#">Ram</a><br><br>
                            Developed By <a class="border-bottom" href="https://khojorightnow.com" target="_blank">Khojo
                                Right Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> --}}
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/public/web-assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('/public/web-assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('/public/web-assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('/public/web-assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('/public/web-assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/public/web-assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('/public/web-assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('/public/web-assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('/public/web-assets/js/main.js') }}"></script>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
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
</body>

</html>
