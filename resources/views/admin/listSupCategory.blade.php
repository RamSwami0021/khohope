@extends('layouts.admin-app')

@section('admin-content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Super Category List</h2>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h5>Super Category List</h5>
                    </div>
                    <div class="col-md-2 col-6">
                        <a href="{{ asset('restaurants/supcategory/add') }}" class="btn btn-primary btn-sm rounded">Create new</a>
                    </div>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                @forelse ($list as $item)
                    <article class="itemlist">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-sm-4 col-8 flex-grow-1 col-name">
                                <a class="itemside" href="#">
                                    <div class="info">
                                        <h6 class="mb-0">{{ $item->name }}</h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-8 flex-grow-1 col-name">
                                <a class="itemside" href="#">
                                    <div class="info">
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
                                </a>
                            </div>

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
                                            url: "{{ route('supcategory.updateStatus') }}",
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

                            <div class="col-lg-2 col-sm-2 col-4 col-action text-end">
                                <form
                                    action="{{ route('supcategory.destroy', ['id' => $item->id]) }}
                                    "
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm font-sm btn-light rounded" type="submit">
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </button>
                                </form>

                            </div>
                        </div> <!-- row .// -->
                    </article>
                @empty
                    No Super Category Added
                @endforelse
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </section>
@endsection
