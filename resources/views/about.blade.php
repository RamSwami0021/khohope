@extends('layouts.web-app')

@section('web-content')
<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container text-center pt-5 pb-4">
        <h1 class="display-3 text-white mb-3 animated slideInDown">About</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
                <li class="breadcrumb-item"><a href="{{ asset('/' . ($user->username ?? '#')) }}">Home</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">About</li>
            </ol>
        </nav>
    </div>
</div>
</div>
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-12">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Restoran</h1>
                <p class="mb-4">{{$data->description??''}}</p>
                <a class="btn btn-primary py-3 px-5 mt-2" href="">Contact Us</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
<!-- Team End -->
@endsection
