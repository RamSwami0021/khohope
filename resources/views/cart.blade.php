@extends('layouts.web-app')

@section('web-content')

<style>
.placeorder{
    display:flex;
justify-content: space-between;
}
@media only screen and (max-width: 768px) {
    .minus-btn{
        padding-left: 8% !important;
    }
    .status{
        padding-top:4px;
    }
    .placeorder{
        display:block;
    }
    button{
        margin-bottom: 15px;
    }

}
</style>
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Food Cart</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ asset('/' . ($user->username ?? '#')) }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Menu Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Cart</h5>
                <h1 class="mb-5">Most Popular Items</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <section class="h-100">
                    <div class="accordion" id="accordionExample">
                        @if ($orderCartList->isNotEmpty())
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Your Cart Order
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container h-100 py-5">
                                            <div class="row d-flex justify-content-center align-items-center h-100">
                                                <div class="col-10" id="foodItemsContainer">
                                                    @forelse($orderCartList as $order)
                                                        <div class="card rounded-3 mb-4">
                                                            <div class="card-body p-4">
                                                                <div
                                                                    class="row d-flex justify-content-between align-items-center">
                                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                                        <img src="{{ asset('public/'.$order->menu->image_url) }}"
                                                                            class="img-fluid rounded-3" width="50%"
                                                                            alt="food">
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                                        <p class="lead fw-normal mb-2">
                                                                            {{ $order->menu->name }}</p>
                                                                        <p><span class="text-muted">Type: </span>
                                                                            {{ $order->menu->type }}</p>
                                                                    </div>
                                                                    {{-- <div class="col-md-3 col-lg-3 col-xl-3">
                                                                    <p><span class="text-muted">Quantity: </span>
                                                                        <div class="d-flex">
                                                                            <form action="{{ url('updateminus') }}" method="POST">
                                                                                @csrf
                                                                                <input type="text" name="orderId" value="{{ $order->id }}" hidden>
                                                                                <button type="submit" class="btn btn-link px-2">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </form>

                                                                            <input id="form1" min="1"
                                                                                name="quantity" value="{{ $order->quantity }}"
                                                                                type="number"
                                                                                class="form-control form-control-sm quantity-input"
                                                                                style="width: 50%; height:10%" />
                                                                                <form action="{{ url('updatePlus') }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="text" name="orderId" value="{{ $order->id }}" hidden>
                                                                            </button>
                                                                            <button type="submit" class="btn btn-link px-2">
                                                                                <i class="fas fa-plus"></i>
                                                                            </button>
                                                                        </form>
                                                                        </div>
                                                                    </p>
                                                                </div> --}}
                                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                                        <p><span class="text-muted">Quantity: </span>
                                                                            <div class="d-flex quantity-box">
                                                                                <button class="btn btn-link px-2" onclick="event.preventDefault(); changeQuantity({{ $order->id }}, -1)">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                                <input id="quantityInput{{ $order->id }}" min="1" placeholder="1" value="{{$order->quantity}}" name="quantity" type="number" class="form-control form-control-sm quantity" style="width: 25%; height:10%" disabled>
                                                                                <button class="btn btn-link px-2" onclick="event.preventDefault(); changeQuantity({{ $order->id }}, 1)">
                                                                                    <i class="fas fa-plus"></i>
                                                                                </button>
                                                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                                                <script>
                                                                                    function changeQuantity(orderId, step) {
                                                                                        const quantityInput = document.getElementById('quantityInput' + orderId);
                                                                                        let quantity = parseInt(quantityInput.value) || 1;
                                                                                        quantity += step;
                                                                                        if (quantity < 0) {
                                                                                            quantity = 0;
                                                                                        }
                                                                                        quantityInput.value = quantity;
                                                                                        updateQuantity(orderId, quantity);
                                                                                    }

                                                                                    function updateQuantity(orderId, newQuantity) {
                                                                                        console.log(newQuantity);
                                                                                        $.ajax({
                                                                                            url: "{{ route('updateQuantity') }}",
                                                                                            type: "POST",
                                                                                            data: {
                                                                                                _token: "{{ csrf_token() }}",
                                                                                                orderId: orderId,
                                                                                                quantity: newQuantity
                                                                                            },
                                                                                            success: function(response) {
                                                                                                if (response.success) {
                                                                                                    console.log("Quantity updated successfully.");
                                                                                                } else {
                                                                                                    console.error(response.message);
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                </script>


                                                                            </div>
                                                                        </p>
                                                                    </div>

                                                                    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('.minus-btn').click(function() {
                                                                                decreaseQuantity($(this).siblings('.quantity-input'));
                                                                            });

                                                                            $('.plus-btn').click(function() {
                                                                                increaseQuantity($(this).siblings('.quantity-input'));
                                                                            });

                                                                            function decreaseQuantity(inputField) {
                                                                                const orderId = inputField.siblings('[name="orderId"]').val();
                                                                                let currentQuantity = parseInt(inputField.val());
                                                                                if (currentQuantity > 1) {
                                                                                    updateQuantity(inputField, orderId, currentQuantity - 1);
                                                                                }
                                                                            }

                                                                            function increaseQuantity(inputField) {
                                                                                const orderId = inputField.siblings('[name="orderId"]').val();
                                                                                let currentQuantity = parseInt(inputField.val());
                                                                                updateQuantity(inputField, orderId, currentQuantity + 1);
                                                                            }

                                                                            function updateQuantity(inputField, orderId, newQuantity) {
                                                                                $.ajax({
                                                                                    url: "{{ route('updateQuantity') }}",
                                                                                    type: "POST",
                                                                                    data: {
                                                                                        _token: "{{ csrf_token() }}",
                                                                                        orderId: orderId,
                                                                                        quantity: newQuantity
                                                                                    },
                                                                                    success: function(response) {
                                                                                        if (response.success) {
                                                                                            inputField.val(newQuantity);
                                                                                        } else {
                                                                                            console.error(response.message);
                                                                                        }
                                                                                    },
                                                                                    error: function(xhr) {
                                                                                        console.error(xhr.responseText);
                                                                                    }
                                                                                });
                                                                            }
                                                                        });
                                                                    </script> --}}



                                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                                        <h5 class="mb-0">
                                                                            Rs{{ $order->price * $order->quantity }}
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">

                                                                        <form action="{{ url("/cart/{$order->id}") }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                style="background: transparent; border:none"
                                                                                class="text-danger"><i
                                                                                    class="fas fa-trash fa-lg"></i></button>
                                                                        </form>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="text" value="{{ $order->id }}" name="cart_id"
                                                            hidden>
                                                    @empty
                                                        <p>your cart is empty</p>
                                                    @endforelse
                                                    <div class="card">
                                                        <div
                                                            class="card-body placeorder align-items-center">
                                                            <form action="{{ route('placeOrder') }}" method="POST">
                                                                @csrf
                                                                <input type="text" name="customer"
                                                                    value="{{ session('customer')->id }}" hidden>
                                                                <input type="text" name="user"
                                                                    value="{{ $user->id }}" hidden>
                                                                <button type="submit"
                                                                    class="btn btn-warning btn-block btn-lg">Proceed to
                                                                    Place</button>
                                                            </form>
                                                            <h5 class="mb-0">Total Rs {{ $totalCartPlace ?? '' }}

                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($orderPlacedList->isNotEmpty())
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Placed Order
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="container h-100 py-5">
                                            <div class="row d-flex justify-content-center align-items-center h-100">
                                                <div class="col-10" id="foodItemsContainer">
                                                    @forelse($orderPlacedList as $order)
                                                        <div class="card rounded-3 mb-4">
                                                            <div class="card-body p-4">
                                                                <div
                                                                    class="row d-flex justify-content-between align-items-center">
                                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                                        <img src="{{ asset('public/'.$order->menu->image_url) }}"
                                                                            class="img-fluid rounded-3" width="50%"
                                                                            alt="food">
                                                                    </div>
                                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                                        <p class="lead fw-normal mb-2">
                                                                            {{ $order->menu->name }}</p>
                                                                        <p><span class="text-muted">Type: </span>
                                                                            {{ $order->menu->type }}</p>
                                                                    </div>
                                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                                        <p><span class="text-muted">Quantity: </span>
                                                                            {{ $order->quantity }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1">
                                                                        <h5 class="mb-0">
                                                                            Rs{{ $order->price * $order->quantity }}
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-md-2 col-lg-2 col-xl-2 text-end">
                                                                        <h5 class="mb-0">
                                                                            {{ $order->status }}
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="text" value="{{ $order->id }}"
                                                            name="order_id" hidden>
                                                    @empty
                                                        <p>your cart is empty</p>
                                                    @endforelse
                                                    <div class="card">
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center">
                                                            <h5></h5>
                                                            <h5 class="mb-0">Total Rs {{ $totalPlaced ?? '' }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
