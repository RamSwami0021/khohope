(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });


    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function () {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Modal Video
    $(document).ready(function () {
        var $videoSrc;
        $('.btn-play').click(function () {
            $videoSrc = $(this).data("src");
        });
        console.log($videoSrc);

        $('#videoModal').on('shown.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        })

        $('#videoModal').on('hide.bs.modal', function (e) {
            $("#video").attr('src', $videoSrc);
        })
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

})(jQuery);

// ==================================================================

$(document).ready(function () {
    $('#openModalBtn').click(function () {
        $('#exampleModal').modal('show');
    });
    $('#openModalBtn1').click(function () {
        $('#exampleModal').modal('show');
    });
    $('#closeModalBtn').click(function () {
        $('#exampleModal').modal('hide');
    });
});

function addtocart() {

}

fetch('data.json')
    .then(response => response.json())
    .then(data => {
        const foodItemsContainer = document.getElementById('foodItems');

        data.foods.forEach(food => {
            const foodItemDiv = document.createElement('div');
            foodItemDiv.classList.add('col-lg-6');

            const foodItemContent = `
        <div class="d-flex align-items-center">
          <img class="flex-shrink-0 img-fluid rounded" src="img/menu-8.jpg" alt="" style="width: 80px;">
          <div class="w-100 d-flex flex-column text-start ps-4">
            <h5 class="d-flex justify-content-between border-bottom pb-2">
              <span>${food.food_name}</span>
              <span class="text-primary">$${food.price}</span>
            </h5>
            <div class="d-flex justify-content-between">
                <small class="fst-italic">${food.description}</small>
                <button id="orderPlace" data-food-id="${food.food_id}" onclick="addToOrder(this.getAttribute('data-food-id'))" class="btn-sm btn-primary text-white">Add to order</button>
            </div>
          </div>
        </div>
      `;
            foodItemDiv.innerHTML = foodItemContent;

            foodItemsContainer.appendChild(foodItemDiv);
        });
    })
    .catch(error => console.error('Error fetching data:', error));


function addToOrder(foodId) {
    let mobileNumber = sessionStorage.getItem('mobileNumber');

    // if (!mobileNumber) {
    //   document.getElementById('openModalBtn').click();
    //   return; // Exit function
    // }

    let orderItems = JSON.parse(sessionStorage.getItem('orderItems')) || [];
    orderItems.push(foodId);
    sessionStorage.setItem('orderItems', JSON.stringify(orderItems));
    console.log('Food added to order:', foodId);
  }



function getAllSessionData() {
    let sessionData = {};
    sessionData.mobileNumber = sessionStorage.getItem('mobileNumber');
    sessionData.orderItems = JSON.parse(sessionStorage.getItem('orderItems')) || [];

    return sessionData;
  }
async function fetchDataAndPopulate() {
    try {
      const response = await fetch('data.json');
      const jsonData = await response.json();
      const container = document.getElementById('foodItemsContainer');
      const orderItems = JSON.parse(sessionStorage.getItem('orderItems')) || [];
      const filteredData = jsonData.foods.filter(food => orderItems.includes(food.food_id));
      filteredData.forEach(food => {
        const cardDiv = document.createElement('div');
        cardDiv.classList.add('card', 'rounded-3', 'mb-4');
        const cardBodyDiv = document.createElement('div');
        cardBodyDiv.classList.add('card-body', 'p-4');
        const rowDiv = document.createElement('div');
        rowDiv.classList.add('row', 'd-flex', 'justify-content-between', 'align-items-center');

        const imageColDiv = document.createElement('div');
        imageColDiv.classList.add('col-md-2', 'col-lg-2', 'col-xl-2');
        const img = document.createElement('img');
        img.src = 'img/menu-8.jpg';
        img.classList.add('img-fluid', 'rounded-3');
        img.width = '50%';
        img.alt = food.food_name;
        imageColDiv.appendChild(img);
        rowDiv.appendChild(imageColDiv);

        // Create food details column
        const detailsColDiv = document.createElement('div');
        detailsColDiv.classList.add('col-md-3', 'col-lg-3', 'col-xl-3');
        const foodNameP = document.createElement('p');
        foodNameP.classList.add('lead', 'fw-normal', 'mb-2');
        foodNameP.textContent = food.food_name; // Assuming 'food_name' property in your JSON data
        const typeP = document.createElement('p');
        typeP.innerHTML = `<span class="text-muted">Type: </span>${food.type}`; // Assuming 'type' property in your JSON data
        detailsColDiv.appendChild(foodNameP);
        detailsColDiv.appendChild(typeP);
        rowDiv.appendChild(detailsColDiv);

        // Create quantity column with buttons
        const quantityColDiv = document.createElement('div');
        quantityColDiv.classList.add('col-md-3', 'col-lg-3', 'col-xl-2', 'd-flex');
        const minusButton = document.createElement('button');
        minusButton.classList.add('btn', 'btn-link', 'px-2');
        minusButton.innerHTML = '<i class="fas fa-minus"></i>';
        minusButton.onclick = () => decreaseQuantity(); // Define decreaseQuantity function as needed
        const quantityInput = document.createElement('input');
        quantityInput.id = 'form1'; // You may need to set a unique ID dynamically
        quantityInput.min = '0';
        quantityInput.name = 'quantity';
        quantityInput.value = '2'; // Default value, you may set it dynamically
        quantityInput.type = 'number';
        quantityInput.classList.add('form-control', 'form-control-sm');
        const plusButton = document.createElement('button');
        plusButton.classList.add('btn', 'btn-link', 'px-2');
        plusButton.innerHTML = '<i class="fas fa-plus"></i>';
        plusButton.onclick = () => increaseQuantity(); // Define increaseQuantity function as needed
        quantityColDiv.appendChild(minusButton);
        quantityColDiv.appendChild(quantityInput);
        quantityColDiv.appendChild(plusButton);
        rowDiv.appendChild(quantityColDiv);

        // Create price column
        const priceColDiv = document.createElement('div');
        priceColDiv.classList.add('col-md-3', 'col-lg-2', 'col-xl-2', 'offset-lg-1');
        const priceH5 = document.createElement('h5');
        priceH5.classList.add('mb-0');
        priceH5.textContent = `$${food.price}`; // Assuming 'price' property in your JSON data
        priceColDiv.appendChild(priceH5);
        rowDiv.appendChild(priceColDiv);

        // Create delete column
        const deleteColDiv = document.createElement('div');
        deleteColDiv.classList.add('col-md-1', 'col-lg-1', 'col-xl-1', 'text-end');
        const deleteLink = document.createElement('a');
        deleteLink.href = '#!';
        deleteLink.classList.add('text-danger');
        const trashIcon = document.createElement('i');
        trashIcon.classList.add('fas', 'fa-trash', 'fa-lg');
        deleteLink.appendChild(trashIcon);
        deleteColDiv.appendChild(deleteLink);
        rowDiv.appendChild(deleteColDiv);

        // Append row to card body
        cardBodyDiv.appendChild(rowDiv);
        cardDiv.appendChild(cardBodyDiv);
        container.appendChild(cardDiv);
      });
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

  // Call the function to fetch data and populate HTML
  fetchDataAndPopulate();



