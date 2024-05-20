@extends('layouts.web-app')

@section('web-content')

<style>
.placeorder{
    display:flex;
justify-content: space-between;
}
@media only screen and (max-width: 768px) {
    .minus-btn{
        padding-left: 8% !important;
    }
    .status{
        padding-top:4px;
    }
    .placeorder{
        display:block;
    }
    button{
        margin-bottom: 15px;
    }

}
</style>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Food Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ asset('/' . ($user->username ?? '#')) }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Menu Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">404</h5>
                <h1 class="mb-5">Oops! The page you are looking for could not be found.</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <section class="h-100">

                </section>
            </div>
        </div>
    </div>
@endsection
