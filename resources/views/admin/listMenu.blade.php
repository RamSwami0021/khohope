@extends('layouts.admin-app')

@section('admin-content')
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Menu List</h2>
            <p>Lorem ipsum dolor sit amet.</p>
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                    <h5>Menu List</h5>
                </div>
                <div class="col-md-2 col-6">
                    <a href="{{asset('restaurant/menu/add')}}" class="btn btn-primary btn-sm rounded">Create new</a>
                </div>
            </div>
        </header>
        <div class="card-body">
            @forelse ($list as $item)
            <article class="itemlist">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-4 col-8 flex-grow-1 col-name">
                        <a class="itemside" href="#">
                            <div class="left">
                                <img src="{{ asset('public/'.$item->image_url) }}" class="img-sm img-thumbnail" alt="Item">
                            </div>
                            <div class="info">
                                <h6 class="mb-0">{{$item->name}}</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-4 col-price"> <span>Rs{{$item->price}}</span> </div>
                    <div class="col-lg-2 col-sm-2 col-4 col-status">
                        <span class="badge rounded-pill alert-success">{{$item->type}}</span>
                    </div>
                    <div class="col-lg-1 col-sm-2 col-4 col-date">
                        <span>{{$item->category}}</span>
                    </div>
                    <div class="col-lg-1 col-sm-2 col-4 col-date">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked_{{ $item->id }}"
                                {{ $item->status == 'on' ? 'checked' : '' }}
                                data-item-id="{{ $item->id }}">
                            <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                            <label class="form-check-label"
                                for="flexSwitchCheckChecked_{{ $item->id }}">Status</label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-4 col-action text-end">
                        <a href="{{ route('menuedit', ['id' => $item->id]) }}" class="btn btn-sm font-sm rounded btn-brand">
                            <i class="material-icons md-edit"></i> Edit
                        </a>
                        <form action="{{ url("/restaurant/menu/destroy/{$item->id}") }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-sm font-sm btn-light rounded">
                            <i class="material-icons md-delete_forever"></i> Delete
                        </button>
                        </form>
                    </div>
                </div>
            </article>
            @empty
            No Menu Added
            @endforelse
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('input[type="checkbox"]').change(function() {
                                        var isChecked = $(this).is(':checked');
                                        var itemId = $(this).data('item-id');
                                        var csrfToken = $('#csrf_token').val();

                                        console.log('isChecked:', isChecked);
                                        console.log('itemId:', itemId);

                                        $.ajax({
                                            url: "{{ route('updateStatusMenu') }}",
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': csrfToken
                                            },
                                            data:{
                                                itemId: itemId,
                                                status: isChecked ? 'on' : 'off'
                                            },
                                            success: function(response) {
                                                console.log('Status updated successfully');
                                            },
                                        });
                                    });
                                });
                            </script>
        </div>
    </div>
</section>
@endsection
