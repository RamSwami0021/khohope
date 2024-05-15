@extends('layouts.admin-app')

@section('admin-content')
<section class="content-main">
    <form action="{{route('supcategory.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

    <div class="row">
        <div class="col-6">
            <div class="content-header">
                <h2 class="content-title">Add New Super Category</h2>
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
                            <h6>Name</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <input type="text" placeholder="Type here" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Status</h6>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="status" checked>
                                  </div>
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
