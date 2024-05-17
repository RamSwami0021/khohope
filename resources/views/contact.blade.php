@extends('layouts.web-app')

@section('web-content')
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ asset('/' . ($user->username ?? '#')) }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    </div>
    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Contact Us</h5>
                <h1 class="mb-5">Contact For Any Query</h1>
            </div>
            <div class="row g-4">
                <div class="col-12">
                    <div class="row gy-4">
                        @if(isset($data->email))
                        <div class="col-md-4">
                            <h5 class="section-title ff-secondary fw-normal text-start text-primary">Email</h5>
                            <p><i class="fa fa-envelope-open text-primary me-2"></i>{{ $data->email }}</p>
                        </div>
                        @endif

                        @if(isset($data->phone))
                        <div class="col-md-4">
                            <h5 class="section-title ff-secondary fw-normal text-start text-primary">Phone</h5>
                            <p><i class="fa fa-envelope-open text-primary me-2"></i>{{ $data->phone }}</p>
                        </div>
                        @endif

                        @if(isset($data->website))
                        <div class="col-md-4">
                            <h5 class="section-title ff-secondary fw-normal text-start text-primary">Website</h5>
                            <p><i class="fa fa-envelope-open text-primary me-2"></i>{{ $data->website }}</p>
                        </div>
                        @endif
                    </div>

                </div>
                @if(isset($data->website))
                <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s">
                    <iframe class="position-relative rounded w-100 h-100" src="{{ $data->map ?? '' }}" frameborder="0"
                        style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
