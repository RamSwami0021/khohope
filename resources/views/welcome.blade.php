@extends('layouts.web-app')

@section('web-content')
    <div class="container-xxl py-5 bg-dark hero-header">
        <div class="container my-5 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                    <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam
                        dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed
                        stet lorem sit clita duo justo magna dolore erat amet</p>
                    @if ($SupCategorie->isNotEmpty())
                        @foreach ($SupCategorie as $item)
                            <a href="{{ asset('menu/' . ($user->username ?? '#')) . '/' . $item->id }}"
                                class="btn btn-primary py-2 px-4">{{ $item->name }}</a>
                        @endforeach
                    @else
                        <a href="#" class="btn btn-primary py-2 px-4">Not Available</a>
                    @endif

                </div>
                <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                    <!-- <img class="img-fluid" src="img/hero.png" alt=""> -->
                    <div id="carouselExample" class="carousel slide fade-carousel" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('pizza.png') }}" class="d-block w-100" alt="Hero Image">
                            </div>
                            <div class="carousel-item ">
                                <img src="{{ asset('pizza2.png') }}" class="d-block w-100" alt="Hero Image">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
