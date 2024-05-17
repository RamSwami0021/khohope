@extends('layouts.admin-app')

@section('admin-content')
<section class="content-main">
    <form action="{{route('restaurants.contact')}}" method="POST" enctype="multipart/form-data">
        @csrf

    <div class="row">
        <div class="col-6">
            <div class="content-header">
                <h2 class="content-title">Contact Us</h2>
                <div>
                    <button type="submit"  class="btn btn-md rounded font-sm hover-up">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Email</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <input type="text" placeholder="Type here" name="email" value="{{$data->email??''}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Phone</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <input type="text" placeholder="Type here" name="phone" value="{{$data->phone??''}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Website</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <input type="text" placeholder="Type here" name="website" value="{{$data->website ?? ''}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Map</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <input type="text" placeholder="Type here" name="map" value="{{$data->map??''}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
</section>
@endsection
