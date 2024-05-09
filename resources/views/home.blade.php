@extends('layouts.admin-app')

@section('admin-content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Dashboard </h2>
            <p>Whole data about your business here</p>
        </div>
        <div>
            <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Today Orders</h6>
                        <span>{{$todayOrders ?? 0}}</span>
                        <span class="text-sm">
                            Shipping fees are not included
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_shipping"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Placed Orders</h6> <span>{{$placedCount ?? 0}}</span>
                        <span class="text-sm">
                            Excluding orders in transit
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Preparing Orders</h6> <span>{{$preparingCount ?? 0}}</span>
                        <span class="text-sm">
                            In 19 Categories
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Serve Orders</h6> <span>{{$serveCount ?? 0}}</span>
                        <span class="text-sm">
                            Based in your local time.
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Complete Orders</h6> <span>{{$completeCount ?? 0}}</span>
                        <span class="text-sm">
                            Based in your local time.
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Menu</h6> <span>{{$menu ?? 0}}</span>
                        <span class="text-sm">
                            Based in your local time.
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Categories</h6> <span>{{$categories ?? 0}}</span>
                        <span class="text-sm">
                            Based in your local time.
                        </span>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
