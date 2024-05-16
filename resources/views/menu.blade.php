@extends('layouts.web-app')

@section('web-content')
    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container text-center pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Food Menu</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ asset('/' . ($user->username ?? '#')) }}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
                </ol>
            </nav>
        </div>
    </div>
    </div>
    <!-- Navbar & Hero End -->


    <style>
        #searchInput {
            border: 3px solid #FEA116;
            border-radius: 25px;
            padding: 10px 20px;
            width: 600px;
            background-color: transparent;
            text-decoration: none;
        }

        #searchInput:hover,
        #searchInput:focus {
            text-decoration: none;
            outline: none;
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) {
            #searchInput {
                width: 580px;
            }
        }

        @media only screen and (max-width: 768px) {
            #searchInput {
                width: 130%;
                margin-left: -14%;
            }
        }

        #dropdownContent {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 600px;
            left: 30%;
            top: 88%;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
            color: #FEA116;
            cursor: pointer;
            overflow: scroll;
            max-height: 500px;
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) {
            #dropdownContent {
                min-width: 580px;
                /* top: 61.5%; */
                top: 54.5%;
                left: 18%;
            }
        }

        @media only screen and (max-width: 768px) {
            #dropdownContent {
                position: relative;
                min-width: 300px;
                top: 82.5%;
                left: 1%;
            }

        }

        .fixedButton {
            position: fixed;
            bottom: 8%;
            right: 100px;
            padding: 10px;
            border-radius: 10px;
            width:8%;
            z-index: 3;
        }

        @media only screen and (max-width: 768px) {
            .fixedButton {
                width: 24%;
                right: -5px;
                border-radius: 10px;
                margin-left: -28%;
            }
        }

        .icon img {
            position: absolute;
            top: 70.5%;
            transform: translateY(-50%);
            left: 68%;
            color: #aaa;
        }

        .icon input,
        input::placeholder {
            color: #FEA116
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) {
            .icon img {
                position: absolute;
                top: 59%;
                transform: translateY(-50%);
                left: 80%;
                color: #aaa;
            }
        }

        @media only screen and (max-width: 768px) {
            .icon img {
                position: relative;
                top: 65.5%;
                transform: translateY(-50%);
                left: 97%;
                color: #aaa;
            }
        }

        #typewriter {
            font-family: monospace;
            font-size: 18px;
            overflow: hidden;
            border-right: .15em solid orange;
            white-space: nowrap;
            animation: typing 3s steps(40, end), blink-caret .75s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: orange;
            }
        }
    </style>
    <!-- Menu Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                <h1 class="mb-5">Most Popular Items</h1>
            </div>
            <div class="d-flex justify-content-around wow fadeInUp" data-wow-delay="0.1s" style="padding-bottom: 10px">
                <div class="icon">
                    <img width="25px" src="{{ asset('assets/fonts/magnifying-glass-solid.svg') }}" class="img-fluid"
                        alt="">
                    <input type="text" id="searchInput" onclick="toggleDropdown()" placeholder="">
                </div>
            </div>
            <div id="dropdownContent"></div>
            <a class="btn btn-primary fixedButton wow fadeInUp d-flex justify-content-center ml-auto" data-bs-toggle="modal" data-bs-target="#catModal"
                data-wow-delay="0.1s">
                <img src="{{asset('public/cutlery.png')}}" alt="" style="width: 40%; padding-right: 10px;"> <h6 style="margin: auto 0;">Menu</h6>
            </a>

            <div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Browser Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @forelse($categories as $category)
                                @if (!$category->menus->isEmpty())
                                    <div class="col-lg-12">
                                        <div onclick="redirectMenuAndScroll('{{ $category->id }}')"
                                            style="text-align: start;
                                                padding: 5px;
                                                margin: 5px;
                                                background: aliceblue; cursor: pointer;">
                                            {{ $category->name }}
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p>No Menu Added</p>
                            @endforelse
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-5 wow fadeInUp">
                <div class="col-md-6">
                    <form id="filterForm" action="{{ url('menu/' . $user->username . '/' . $id) }}" method="POST">
                        @csrf <!-- Add CSRF token for Laravel -->
                        <input type="hidden" name="username" value="{{ $user->username }}">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                name="vegOnly" @if ($isChecked === 'on') checked @endif>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Veg Only</label>
                        </div>
                    </form>


                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#flexSwitchCheckDefault').change(function() {
                        $('#filterForm').submit();
                    });
                });
            </script>
            {{-- <script>
                $(document).ready(function() {
                    $('#flexSwitchCheckDefault').change(function() {
                        var isChecked = $(this).prop('checked');
                        var data = {
                            vegOnly: isChecked
                        };


                        var csrfToken = $('#csrf_token').val();

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('updateFilter') }}",
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: data,
                            success: function(response) {
                                console.log('Request sent successfully');
                            },
                        });
                    });
                });
            </script> --}}

            {{-- @forelse($categories as $category)
                @php
                    $themeComponent = 'components.theme.theme' . $user->theme_id;
                @endphp

                @component($themeComponent, ['category' => $category, 'user' => $user])
                @endcomponent

            @empty
                <p>No Menu Added</p>
            @endforelse --}}
            @forelse($categories as $category)
                @if (!$category->menus->isEmpty())
                    @php
                        $themeComponent = 'components.theme.theme' . $user->theme_id;
                    @endphp
                    @component($themeComponent, ['category' => $category, 'user' => $user])
                    @endcomponent
                @endif
            @empty
                <p>No Menu Added</p>
            @endforelse

        </div>
    </div>

    <!-- Menu End -->
    <script>
        document.getElementById("searchInput").addEventListener("input", function() {
            var inputText = this.value.trim();
            var dropdown = document.getElementById("dropdownContent");
            if (inputText !== "") {
                dropdown.style.display = "block";
            } else {
                dropdown.style.display = "none";
            }
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function redirectMenuAndScroll(categoryId) {
            var modal = document.getElementById('catModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
            var accordionHeader = document.getElementById("flush-heading" + categoryId);
            if (accordionHeader) {
                accordionHeader.scrollIntoView({
                    behavior: 'smooth'
                });
            }
            var accordionBody = document.getElementById("flush-collapse" + categoryId);
            if (accordionBody) {
                accordionBody.classList.add("show");
            }
        }
    </script>
    <script>
        function handleInput(event) {
            const inputValue = event.target.value.toLowerCase();
            const categories = <?php echo json_encode($categories); ?>;

            const matchingMenuItems = [];

            categories.forEach(category => {
                if (Array.isArray(category.menus)) {
                    category.menus.forEach(menu => {
                        if (menu.name.toLowerCase().includes(inputValue)) {
                            matchingMenuItems.push({
                                categoryId: category.id,
                                menuName: menu.name
                            });
                        }
                    });
                }
            });

            console.log('matchingMenuItems', matchingMenuItems);

            document.getElementById('dropdownContent').innerHTML = '';

            matchingMenuItems.forEach(item => {
                console.log('item', item)
                const menuNameParagraph = document.createElement('p');
                menuNameParagraph.textContent = item.menuName;
                menuNameParagraph.setAttribute('data-category-id', item
                    .catId);
                menuNameParagraph.addEventListener('click', function() {
                    redirectMenuAndScrollSearch(item.categoryId);

                });
                document.getElementById('dropdownContent').appendChild(menuNameParagraph);
                const hrLine = document.createElement('hr');
                document.getElementById('dropdownContent').appendChild(hrLine);
            });

        }


        const searchInput = document.getElementById("searchInput");
        searchInput.addEventListener("input", handleInput);
    </script>
    <script>
        function redirectMenuAndScroll(categoryId) {

            var modal = document.getElementById('catModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
            var accordionHeader = document.getElementById("flush-heading" + categoryId);
            if (accordionHeader) {
                accordionHeader.scrollIntoView({
                    behavior: 'smooth'
                });
            }
            var accordionBody = document.getElementById("flush-collapse" + categoryId);
            if (accordionBody) {
                accordionBody.classList.add("show");
            }
        }

        function redirectMenuAndScrollSearch(categoryId) {
            var accordionHeader = document.getElementById("flush-heading" + categoryId);
            if (accordionHeader) {
                accordionHeader.scrollIntoView({
                    behavior: 'smooth'
                });
            }
            var accordionBody = document.getElementById("flush-collapse" + categoryId);
            if (accordionBody) {
                accordionBody.classList.add("show");
            }
            var dropdown = document.getElementById("dropdownContent");
            dropdown.style.display = "none";
            const searchInput = document.getElementById('searchInput');

            const inputValue = searchInput.value;

            searchInput.value = "";
        }
    </script>
    <script>
        function animatePlaceholder() {
            const placeholderTexts = ["Search... Chole Bhature", "Search... Lassi Sweet & Salted", "Search... Pav Bhaji"];
            const input = document.getElementById("searchInput");
            let index = 0;
            let textIndex = 0;
            let isTyping = true;
            let eraseDelay = 1000; // Delay before erasing text
            let repeatDelay = 1000; // Delay before repeating typing

            function typeWriter() {
                if (isTyping && index < placeholderTexts[textIndex].length) {
                    input.placeholder += placeholderTexts[textIndex].charAt(index);
                    index++;
                    setTimeout(typeWriter, 100); // Adjust typing speed here (milliseconds)
                } else if (isTyping && index === placeholderTexts[textIndex].length) {
                    isTyping = false;
                    setTimeout(eraseText, eraseDelay);
                }
            }

            function eraseText() {
                if (!isTyping && input.placeholder.length > 0) {
                    input.placeholder = input.placeholder.slice(0, -1);
                    setTimeout(eraseText, 100); // Adjust erasing speed here (milliseconds)
                } else {
                    index = 0;
                    isTyping = true;
                    textIndex = (textIndex + 1) % placeholderTexts.length; // Cycle through the texts
                    setTimeout(typeWriter, repeatDelay);
                }
            }

            typeWriter();
        }

        // Call the function to animate placeholder text
        animatePlaceholder();
    </script>
@endsection
