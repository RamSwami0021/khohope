@extends('layouts.admin-app')

@section('admin-content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">THeme List</h2>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h5>Theme List</h5>
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
                            <div class="col-lg-2 col-sm-2 col-4 col-action text-end">
                                <form action="{{ route("theme.active", ['id' => $item->id]) }}
                                    " method="GET">
                                    @csrf
                                    <button class="btn btn-sm font-sm btn-light rounded" type="submit">
                                        <i class="material-icons md-delete_forever"></i> Active
                                    </button>
                                </form>

                            </div>
                        </div> <!-- row .// -->
                    </article>
                @empty
                    No Menu Category Added
                @endforelse
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </section>
@endsection
