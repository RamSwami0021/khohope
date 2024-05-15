@extends('layouts.admin-app')

@section('admin-content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Serve Order List</h2>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h5>Serve Order List</h5>
                    </div>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                @forelse ($customersWithOrders as $customerId => $customerData)
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            {{-- @if ($customerData['orders']->isNotEmpty()) --}}
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{ $customerData['customer']->mobile_number }}"
                                    aria-expanded="false"
                                    aria-controls="flush-collapse{{ $customerData['customer']->mobile_number }}">
                                    {{ $customerData['customer']->name }} || {{ $customerData['customer']->mobile_number }}
                                </button>
                            </h2>
                            {{-- @endif --}}

                            <div id="flush-collapse{{ $customerData['customer']->mobile_number }}"
                                class="accordion-collapse collapse"
                                aria-labelledby="flush-heading{{ $customerData['customer']->mobile_number }}"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    @foreach ($customerData['orders'] as $order)
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-sm-4 col-8 flex-grow-1 col-name">
                                                    <a class="itemside" href="#">
                                                        <div class="left">
                                                            <img src="{{ asset('public/'.$order->menu->image_url) }}"
                                                                class="img-sm img-thumbnail" alt="Item">
                                                        </div>
                                                        <div class="info">
                                                            <h6 class="mb-0">{{ $order->menu->name }}</h6>
                                                        </div>
                                                        <div class="info">
                                                            <h6 class="mb-0">Quantity: {{ $order->quantity }}</h6>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-lg-2 col-sm-2 col-4 col-price">
                                                    <span>Rs{{ $order->menu->price * $order->quantity }}</span> </div>
                                                <div class="col-lg-2 col-sm-2 col-4 col-status">
                                                    <span
                                                        class="badge rounded-pill alert-success">{{ $order->menu->type }}</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-2 col-4 col-date">
                                                    <span>{{ $order->menu->category }}</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-2 col-4 col-action text-end">
                                                    <a href="{{ asset('/order/storeComplete/' . $order->id) }}"
                                                        class="btn btn-sm font-sm rounded btn-brand">
                                                        <i class="material-icons md-add"></i> Complete
                                                    </a>
                                                    <form action="{{ url("order/destroy/{$order->id}") }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm font-sm btn-light rounded">
                                                            <i class="material-icons md-delete_forever"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                    @endforeach
                                    <div
                                            class="card-body d-flex justify-content-between align-items-center">
                                            <form action="{{ route('completeAll') }}" method="POST">
                                                @csrf
                                                <input type="text" name="customer"
                                                    value="{{ $customerData['customer']->id }}" hidden>
                                                <button type="submit"
                                                    class="btn btn-warning btn-block btn-lg">Proceed Next</button>
                                            </form>
                                            </h5>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No customers yet</p>
                @endforelse

            </div>
        </div>
    </section>
@endsection
