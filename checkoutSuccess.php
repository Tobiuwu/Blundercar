<?php

// Disable error display, so that there is no possibility of errors appearing to the end user
ini_set('display_errors', 0);
// Starts the session
session_start();
/** include("send_email.php"): Includes the script that contains the function to send emails */
require_once("send_email.php");

// Declare the Variables
$order_id = "";
$customer_id = "";
$total_sale_value = "";
$order_date = "";
$customer_purchase = "";
$customer_address = "";

/** $verify_purchase: Array containing information about whether a purchase has been made, and information about further information about the order */
$verify_purchase = array("No", "no_info");
if(isset($_SESSION['purchase_success'])){
    $verify_purchase[0] = $_SESSION['purchase_success'][0];
    $verify_purchase[1] = $_SESSION['purchase_success'][1];
    $customer_purchase = $_SESSION['purchase_success'][2];
    $customer_address = $_SESSION['purchase_success'][3];
    // Cleans the whole cart
    unset($_SESSION['products']['products']);
    unset($_SESSION['cart_vehicles']);
    unset($_SESSION['cart_items']);
    unset($_SESSION['prod_vehicles_old']);
    unset($_SESSION['id_vehicle']['id_vehicle']);
    unset($_SESSION['id_item']['id_item']);
    unset($_SESSION['enable_remove_vehicles']);
    unset($_SESSION['enable_remove_items']);
    unset($_SESSION['products_vehicles']);
    unset($_SESSION['products_items']);
    unset($_SESSION['feedback']['feedback']);
}
/** if ($verify_purchase[0] == "0" ): checks if a purchase has been made, otherwise redirects the customer back to checkout.php */
if ($verify_purchase[0] == "0" ){	    
    header("Location: checkout.php");
    die();
} else {
    /** $order_id: Number of the order placed (If the customer has ordered several products, the last order id takes precedence) */
    $order_id = $customer_purchase[0];
    /** $customer_id: Customer ID */
    $customer_id = $customer_purchase[1];
    /** $total_sale_value: Total order value */
    $total_sale_value = $customer_purchase[2];
    /** $order_date: Exact complete date the order was placed */
    $order_date = $customer_purchase[3];
    // Variables for the SendMail function
    /** $email: Email of the customer */
    $email = $customer_address[1];
    /** $subject: Subject of the email */
    $subject = "Thank You for Your Purchase!";
    /** $message: Message/email body */
    $message = "email_sale";
   /** SendMail($email, $subject, $message, $customer_address, $customer_purchase, $verify_purchase): Calls the function that sends email with the order data to the customer */
    SendMail($email, $subject, $message, $customer_address, $customer_purchase, $verify_purchase);
    $_SESSION['purchase_success'] = array();
    /** Clears the associative array in purchase_success, so that if the customer reloads the page, it doesn't send another email, but redirects him back to checkout */
    unset($_SESSION['purchase_success']);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Checkout successful </title>
        <meta name="description" content="Succes">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- css -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/chosen.min.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/icofont.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bundle.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <div class="wrapper">
             <header>
                <div class="header-area transparent-bar ptb-55">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-4 logo_car">
                                <div class="logo-small-device">
                                    <a href="index.html"><img alt="" src="assets/img/logo/logo.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-8">
                                <div class="header-contact-menu-wrapper pl-45">
                                    <div class="header-contact">
                                    </div>
                                    <div class="menu-wrapper text-center menu">
                                        <button class="menu-toggle">
                                            <img class="s-open" alt="" src="assets/img/icon-img/menu.png">
                                            <img class="s-close" alt="" src="assets/img/icon-img/menu-close.png">
                                        </button>
                                        <div class="main-menu">
                                            <nav>
                                                <ul>
                                                    <li><a href="index.html">MAIN PAGE</a></li>
                                                    <li><a href="about-us.html">ABOUT US</a></li>
                                                    <li><a href="#">SHOP</a>
                                                        <ul>
                                                            <li><a href="product-details.html">SHOP</a></li>                                                       
                                                            <li><a href="checkout.php">Checkout</a></li>                                                         
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Access</a>
                                                        <ul>
                                                            <li><a href="login.php">Reserved Access</a></li>
                                                        </ul>
                                                    </li>              
                                                    <li><a href="contact.html">Contacts</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </header>
            <div class="breadcrumb-area pt-255 pb-170" >
                <div class="container-fluid">
                    <div style="text-align: center">
                        <h1>Successful purchase!</h1>
                        <h3>Thank you very much for choosing BlunderCar!<br/>Your order number is <b><?php echo $order_id; ?></b>, we will send you an email with the summary of your order.</h3>
                    </div>
                </div>
            </div>
            
            </header>
            <div>
            </div>
            <div id="markenting-emails" class="newsletter-area">
                <div class="container">
                    <div class="newsletter-wrapper-all theme-bg-2">
                        <div class="row">
                           
                                <div class="newsletter-wrapper text-center">
                                    <div class="newsletter-title">
                                        <h3>Subscribe to newsletter</h3>
                                    </div>
                                    <div id="mc_embed_signup" class="subscribe-form">
                                        <form action="send_email.php" method="post" id="markenting-emails" name="mc-embedded-subscribe-form" class="validate"> 
                                            <div id="mc_embed_signup_scroll" class="mc-form">
                                                <input type="email" id="email" name="email" class="email" placeholder="Write your email here.." required>
                                                <input type="hidden" id="go_back" name="go_back" value="index.html#markenting-emails">
                                                <div class="clear"><input type="submit" value="Subscribe" name="email-markenting" id="mc-embedded-subscribe" class="button"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <div class="footer-top pt-210 pb-98 theme-bg">
                    <div class="container">
                       <div class="row">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-logo">
                                        <a href="index.html">
                                            <img src="assets/img/logo/logo.png" alt="">
                                        </a>
                                    </div>
                                    <div class="footer-about">
                                        <p><span>Blunder car </span>Best cars</p>
                                        <div class="footer-support">
                                            <h5>Technical support</h5>
                                            <span>+11 111 111 111 (Free)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30 pl-60">
                                    <div class="footer-widget-title">
                                        <h3>Links</h3>
                                    </div>
                                    <div class="quick-links">
                                        <ul>
                                            <li><a href="about-us.html">About us</a></li>
                                            <li><a href="shop.html">Shop</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-widget-title">
                                        <h3>Social media</h3>
                                    </div>
                                    <div class="food-widget-content pr-30">
                                        <div class="single-tweet">
                                            <p><a href="#">@Blundercar,</a> Twitter</p>
                                        </div>
                                        <div class="single-tweet">
                                            <p><a href="#">@Blundercar,</a> Instagram</p>
                                        </div>
                                        <div class="single-tweet">
                                            <p><a href="#">@Blundercar</a> Facebook</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="footer-widget mb-30">
                                    <div class="footer-widget-title">
                                        <h3>Contact information</h3>
                                    </div>
                                    <div class="food-info-wrapper">
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Address</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>Ječná 30, 120 00, Praha 2</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Telephone</span>
                                            </div>
                                            <div class="food-info-content">
                                                <p>+11 111 111 111</p>
                                            </div>
                                        </div>
                                        <div class="food-address">
                                            <div class="food-info-title">
                                                <span>Email</span>
                                            </div>
                                            <div class="food-info-content">
                                                <a href="#">blundercarofficial@gmail.com</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom ptb-35 black-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <div class="copyright">
                                    <p>©Copyright, 2023 All Rights Reserved </p>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="footer-payment-method">
                                    <a href="#"><img alt="" src="assets/img/icon-img/payment.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>	
		<!-- javascripts -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/vendor/popper.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
        <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/vendor/jquery.counterup.min.js"></script>
        <script src="assets/js/vendor/waypoints.min.js"></script>
        
        <script src="assets/js/vendor/owl.carousel.min.js"></script>
        <script src="assets/js/vendor/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
