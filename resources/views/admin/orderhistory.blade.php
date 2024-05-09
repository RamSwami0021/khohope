@extends('layouts.admin-app')

@section('admin-content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">History Order List</h2>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <h5>History Order List</h5>
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
                                                        <?php if($order->menu->type == 'non-veg'): ?>
                                                            <span class="badge rounded-pill alert-danger">{{ $order->menu->type }}</span>
                                                        <?php else: ?>
                                                            <span class="badge rounded-pill alert-success">{{ $order->menu->type }}</span>
                                                        <?php endif; ?>
                                                    </div>

                                                <div class="col-lg-2 col-sm-2 col-4 col-status">
                                                    {{ $order->menu->created_at }}
                                                </div>
                                                <div class="col-lg-1 col-sm-2 col-4 col-date">
                                                    <span>{{ $order->menu->category }}</span>
                                                </div>
                                            </div>
                                    @endforeach
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
