/** ----------- Event Listeners ----------- */

// Call the function when the document is ready
$(document).ready(function() {
    // Make sure its checkout page
    var currentPageName = window.location.pathname.split('/').pop();
    if (currentPageName == "checkout.php") {
        getAllCartItems();
        checkLoginAndLoadCheckout();
    } else if (currentPageName == "product-details.html"){
        // Make sure its products page and get all products
        getShopItems();
    }
});

$("#delivery_data").submit(function(e) {
    e.preventDefault();
});


/** ----------- Functions ----------- */

function reloadProductCarousel(){
    var $easyzoom = $('.easyzoom').easyZoom();
    /* product-dec-slider active */
    $('.product-dec-slider').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 5000,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        nav: true,
        item: 4,
        margin: 12,
        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 4
            },
            1000: {
                items: 4
            }
        }
    })
    $('.view-mode li a').on('click', function() {
        var $proStyle = $(this).data('view');
        $('.view-mode li').removeClass('active');
        $(this).parent('li').addClass('active');
        $('.product-view').removeClass('product-grid product-list').addClass($proStyle);
    })
    
    /*--------------------------
    tab active
    ---------------------------- */
    var ProductDetailsSmall = $('.product-details-small a');
    
    ProductDetailsSmall.on('click', function(e) {
        e.preventDefault();
        
        var $href = $(this).attr('href');
        
        ProductDetailsSmall.removeClass('active');
        $(this).addClass('active');
        
        $('.product-details-large .tab-pane').removeClass('active');
        $('.product-details-large ' + $href).addClass('active');
    })
}   


function getShopItems(){
    // Get all products
    $.ajax({
        url: "database/fetch.php",
        method: "GET",
        data: {
            getAllProducts: true
        },
        success: function (result) {
            // Successful submition (Http 200), clear previous errors
            $('#errors').addClass("hidden");
            // parse result
            htmlObject = JSON.parse(result);
            $("#items").html(htmlObject.html);
            reloadProductCarousel();
            
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            $('#errors').removeClass("hidden");
            failed_submit('#errors', "There are no products available.");
        }
    })
}

function getAllCartItems() {
    // Get all cart items
    $.ajax({
        url: "cart.php",
        method: "GET",
        data: {
            getAllCartItems: true
        },
        success: function (result) {
            // Successful submition (Http 200), clear previous errors
            $('#cartErrors').addClass("hidden");
            // parse result
            htmlObject = JSON.parse(result);
            $("#cartTable").html(htmlObject.html);
            
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            $('#cartErrors').removeClass("hidden");
            failed_submit('#cartErrors', "Failed to load cart items. Please try again.");
        }
    })
}

function checkLoginAndLoadCheckout(){
    // Check if user is logged in
    $.ajax({
        url: "database/fetch.php",
        method: "GET",
        data: {
            loadCheckout: true
        },
        success: function (result) {
            // parse result and load client details on checkout page
            clientDetails = JSON.parse(result);
            $("#name").val(clientDetails.name);
            $("#email").val(clientDetails.email);
            $("#address").val(clientDetails.address);
            $("#city").val(clientDetails.city);
            $("#postal_code").val(clientDetails.postal_code);
            $("#phone_number").val(clientDetails.phone_number);
            $("#country").val(clientDetails.country);
            $("#password_field").addClass("hidden");
            $("#notLoggedInText").addClass("hidden");
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            $("#notLoggedInText").removeClass("hidden");
        }
    })
}

$('#order').click(function () {
    // Get all order details
    var name = $("#name").val();
    var email = $("#email").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var postal_code = $("#postal_code").val();
    var phone_number = $("#phone_number").val();
    var country = $("#country").val();
    var more_information = $("#more_information").val();
    var address_number = $("#address_number").val();
    
    $.ajax({
        url: "database/post.php",
        method: "POST",
        data: {
            Checkout: true,
            name: name,
            email: email,
            address: address,
            city: city,
            postal_code: postal_code,
            phone_number: phone_number,
            country: country,
            more_information: more_information,
            address_number: address_number

        },
        success: function (result) {
            // Successful submition (Http 200), clear previous errors
            $('#CheckoutErrors').addClass("hidden");
            // parse result
            $(location).attr('href','checkoutSuccess.php')
            
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            $('#CheckoutErrors').removeClass("hidden");
            failed_submit('#CheckoutErrors', "Failed to place order. Please try again.");
        }
    })
});