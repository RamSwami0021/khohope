@extends('layouts.admin-app')

@section('admin-content')
    <section class="content-main">
        <form action="{{ route('restaurant.menu.update', ['id' => $menu->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="content-header">
                        <h2 class="content-title">Add New Menu</h2>
                        <div>
                            <button type="submit" class="btn btn-md rounded font-sm hover-up">Update</button>
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
                                    <h6>1. General info</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="name" value="{{ $menu->name ?? '' }}" placeholder="Type here" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" value="{{ Auth::user()->id }}" name="user_id" placeholder="Type here" class="form-control" hidden>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea name="short_description" placeholder="Type here" class="form-control" rows="4">{{ $menu->description ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="status" {{ (isset($menu) && $menu->status === 'on') ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" name="category">
                                            @forelse($list as $item)
                                                <option value="{{ $item->id }}" {{ (isset($menu) && $menu->categorie_id == $item->id) ? 'selected' : '' }}> {{ $item->name }} </option>
                                            @empty
                                                <option disabled value="#"> No Category Added </option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>2. Pricing</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Cost in RS</label>
                                        <input type="text" name="price" value="{{ $menu->price ?? '' }}" placeholder="Rs00.0" class="form-control">
                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>3. Type</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                            <input class="form-check-input" name="type" value="veg" type="radio" {{ (isset($menu) && $menu->type == 'veg') ? 'checked' : '' }}>
                                            <span class="form-check-label"> Veg </span>
                                        </label>
                                        <label class="mb-2 form-check form-check-inline" style="width: 45%;">
                                            <input class="form-check-input" name="type" value="non-veg" type="radio" {{ (isset($menu) && $menu->type == 'non-veg') ? 'checked' : '' }}>
                                            <span class="form-check-label"> Non Veg </span>
                                        </label>

                                    </div>
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            <hr class="mb-4 mt-0">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>4. Media</h6>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-4">
                                        <label class="form-label">Images</label>
                                        <input class="form-control" name="image" type="file">
                                    </div>
                                    <div class="mb-4" id="imagePreviewContainer">
                                        <img width="10%" src="{{asset('public/'.$menu->image_url)}}" class="img-fluid" alt="Image Preview">
                                    </div>
                                </div> <!-- col.// -->

                            </div> <!-- .row end// -->
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>
    </form>
@endsection
