<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Checkout</title>
        <meta name="description" content="Product Checkout Page">
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
        <script src="assets/js/showSelection.js"></script>
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
                                                            <li class="active"><a href="checkout.php">Checkout</a></li>                                                         
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
            <div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
                <div class="container-fluid">
                    <div class="breadcrumb-content text-center">
                        <h2>Checkout Page</h2>
                        <ul>
                            <li>
                                <a href="#">Home Page</a>
                            </li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Start of the checkout area -->
            <div class="checkout-area pt-130 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12" >
                        <h5 id="notLoggedInText">Already have an account?<a style="color: #17a2b8" href="login.php"> Login now <a>to automatically load your data!</h5>
                        
                            <form id="delivery_data" name="delivery_data" action="" method="post">
                                <div class="checkbox-form">						
                                    <h3>DELIVERY INFORMATION</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="country-select">
                                                <label>Country<span class="required">*</span></label>
                                                <select id="country" name="country" required>
                                                    <option value="">Select an option</option>
                                                    <option value="Czech republic">Czech republic</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="France">France</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="China">China</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Japan">Japan</option>                                            
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Portugal">Portugal</option>
                                                </select> 										
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Name <span class="required">*</span></label>										
                                                <input id="name" name="name" type="text" placeholder="" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email <span class="required">*</span></label>										
                                                <input id="email" name="email" type="text" placeholder="" required/>
                                            </div>
                                        </div>
                                        <div id="password_field" class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label> Password<span class="required">*</span></label>										
                                                <input name="Password_checkout" type="password" placeholder="Enter a Password" minlength="6" maxlength="15" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input id="address" name="address" type="text" placeholder="Street" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">									
                                                <input id="address_number" name="address_number" type="text" placeholder="Apartment, house, unit, etc. (optional)" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>City <span class="required">*</span></label>										
                                                <input id="city" name="location" type="text" placeholder="" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postal Code <span class="required">*</span></label>										
                                                <input id="postal_code" name="postal_code" type="text" maxlength="10"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone number <span class="required">*</span></label>										
                                                <input id="phone_number" name="phone_number" type="text"  maxlength="12"/>
                                            </div>
                                        </div>
                                    <div id="cart"></div> 							
                                    </div>
                                        <div class="order-notes">
                                            <div class="checkout-form-list mrg-nn">
                                                <label>Additional Information</label>
                                                <textarea id="more_information" name="more_information" cols="30" rows="10" placeholder="Enter here other important information related to your order." ></textarea>
                                            </div>									
                                        </div>
                                    <div class="order-button-payment">
                                        <input id="order" name="order" type="submit" value="Order" />
                                        <br/>
                                        
                                        <br/>
                                        <div id="CheckoutErrors"></div>
                                    </div>  
                                    </div>													
                                </div>
                            </form>
                            <div class="col-lg-6 col-md-12 col-12" style="text-align: center;">
                            <div class="your-order">
                                <h3>YOUR ORDER</h3>
                                <div id="" class="your-order-table table-responsive" >
                                    <table id ="cartTable">
                                        <div id="cartErrors"></div>
                                    </table>
                                    
                                    <div class="order-button-payment">
                                        <form method="get" action="cart.php">
                                            <input type="hidden" id="action" name="action" value="clear">
                                            <input type="hidden" id="back_to" name="back_to" value="checkout.php">
                                            <input style="color:red;" name="update_cart" value="Clear cart" type="submit"></input>
                                        </form>
                                    <div>
                                     
                                </div>                      
                                        <div class="order-button-payment">
                                            <a href="product-details.html">
                                            <input class='btn-style cr-btn' value='Back to the Store' type='button' style='cursor: pointer;'></input>
                                            </a>
                                        </div>								
                                    </div>
                                </div>
                                <br/>
                            </div>
                        </div>
                        </div>
                        
                        <br/>
                        <!-- Order Review !-->
                        
                    </div>
                </div>
            </div>
            <!-- End of the checkout area -->
            <!-- Subscribe to customers -->
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
        <script src="assets/js/form.js"></script>
        <script src="assets/js/products.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>