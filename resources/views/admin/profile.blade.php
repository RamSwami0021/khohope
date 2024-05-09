@extends('layouts.admin-app')

@section('admin-content')
    <section class="content-main">
        <form action="{{ route('restaurants.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="content-header">
                        <h2 class="content-title">Edit Profile</h2>
                        <div>
                            <button type="submit" class="btn btn-md rounded font-sm hover-up">Save</button>
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
                                        <h6>Current Password</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <input type="password" placeholder="Your Current Password"
                                                name="current_password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>New Password</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <input type="password" placeholder="Your New Password" name="new_password"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Confirm Password</h6>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <input type="password" placeholder="Your Confirm Password"
                                                name="confirm_password" class="form-control">
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
