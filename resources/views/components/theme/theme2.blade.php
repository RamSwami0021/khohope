<div class="theme">
    <style>
        .accordion-button{
            color: Black !important;
            background-color: white;
        }
    </style>

    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div id="foodItems" class="row g-4">
                    <div class="col-lg-6">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading{{ $category->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $category->id }}" aria-expanded="false"
                                        aria-controls="flush-collapse{{ $category->id }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $category->id }}" class="accordion-collapse collapse "
                                    aria-labelledby="flush-heading{{ $category->id }}"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @foreach ($category->menus as $menu)
                                            <div class="d-flex align-items-center py-3 border-bottom">
                                                <img class="flex-shrink-0 img-fluid rounded"
                                                    src="{{ asset('/' . $menu->image_url) }}" alt=""
                                                    style="width: 80px;">
                                                <div class="w-100 d-flex flex-column text-start ps-4">
                                                    <h5 class="d-flex justify-content-between" style="margin: auto 0">
                                                        <span>{{ $menu->name }}</span>
                                                        @if ($menu->type == 'veg')
                                                            <img width="10%" src="{{ asset('/veg.png') }}"
                                                                alt="hi">
                                                        @else
                                                            <img width="10%" src="{{ asset('/nonveg.png') }}"
                                                                alt="">
                                                        @endif
                                                    </h5>
                                                    <h6 class="d-flex justify-content-between">
                                                        <span class="text-primary">Rs {{ $menu->price }}</span>
                                                    </h6>
                                                    <div class="d-flex justify-content-between pb-2">
                                                        <small class="fst-italic">{{ $menu->description }}</small>
                                                    </div>
                                                    <div>
                                                        <form class="d-flex justify-content-between" method="POST"
                                                            action="{{ route('addToCart') }}">
                                                            @csrf
                                                            <input type="hidden" name="menu_id"
                                                                value="{{ $menu->id }}">
                                                            <input type="hidden" name="customer_id"
                                                                value="{{ session('customer') ? session('customer')->id : '' }}">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $user->id }}">
                                                            <input type="hidden" name="price"
                                                                value="{{ $menu->price }}">

                                                            <div class="d-flex quantity-box">
                                                                <button class="btn btn-link px-2"
                                                                    onclick="event.preventDefault(); changeQuantity({{ $menu->id }}, -1)">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <input id="quantityInput{{ $menu->id }}"
                                                                    min="1" placeholder="1" value="1"
                                                                    name="quantity" type="number"
                                                                    class="form-control form-control-sm quantity"
                                                                    style="width: 25%; height:10%" >
                                                                <button class="btn btn-link px-2"
                                                                    onclick="event.preventDefault(); changeQuantity({{ $menu->id }}, 1)">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                                <style>

                                                                </style>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn-sm btn-primary text-white">Add to
                                                                Order</button>
                                                        </form>


                                                        <script>
                                                            function changeQuantity(menuId, step) {
                                                                        const quantityInput = document.getElementById('quantityInput' + menuId);
                                                                        quantityInput.removeAttribute('disabled');
                                                                        let quantity = parseInt(quantityInput.value) || 1;
                                                                        quantity += step;
                                                                        if (quantity < 0) {
                                                                            quantity = 0;
                                                                        }
                                                                        quantityInput.value = quantity;
                                                                    }
                                                        </script>



                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal --}}
    @if (session('showModal'))
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ asset('customer') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Welcome</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="menu_id" value="{{ old('menu_id') }}">
                            <input type="hidden" name="customer_id" value="{{ old('customer_id') }}">
                            <input type="hidden" name="user_id" value="{{ old('user_id') }}">
                            <input type="hidden" name="price" value="{{ old('price') }}">
                            <input type="hidden" name="quantity" value="{{ old('quantity') }}">
                            <input type="text" class="form-control my-2" id="numberInput" name="name"
                                placeholder="Enter you name">
                            <input type="tel" class="form-control" id="numberInput" name="mobile_number"
                                placeholder="Enter you mobile number">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeModalBtn" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif
    {{-- modal --}}
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">
                        Success!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your order has been successfully added to the
                    cart.
                </div>
            </div>
        </div>
    </div>

    <!-- Failure Modal -->
    <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="failureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="failureModalLabel">Failure!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    There was an error adding your order to the
                    cart. Please try again later.
                </div>
            </div>
        </div>
    </div>
</div>
