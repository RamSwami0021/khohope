@extends('layouts.admin-app')

@section('admin-content')
<section class="content-main">
    <form action="{{route('restaurants.about')}}" method="POST" enctype="multipart/form-data">
        @csrf

    <div class="row">
        <div class="col-6">
            <div class="content-header">
                <h2 class="content-title">About Us</h2>
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
                            <h6>Description</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <textarea placeholder="Description" name="description" class="form-control">{{$data->description??''}}</textarea>
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
