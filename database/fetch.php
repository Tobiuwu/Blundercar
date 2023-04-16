<?php
ini_set('display_errors', 0);

if (isset($_GET['getAllGenres'])) {
	require_once('Authenticate.php');
	$DB = new Authenticate();
	$html = "";
	$DB->type = 'GetGenres';
	$DB->param = array();
	$result = $DB->Fetch();
	if ($result) {
		foreach	($result as $genre){
			$html .= <<<HTML
			<label class="check">
				<input type="checkbox" class="check__input" value="$genre[ID]" onclick="UpdateBooksByGenre(this)">
				<span class="check__checkbox">
					<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M20 6.5L9 17.5L4 12.5" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</span>
				<p class="check__text">$genre[genre_name]</p>
			</label>
HTML;
		}
		
		echo json_encode(array("html" => $html));
		die();
	} else {
		http_response_code(500);
		die();
	}

} else if (isset($_GET['getAllProducts'])) {
	require_once('Authenticate.php');
	require_once('Util.php');
	$DB = new Authenticate();
	$html = "";
	$DB->type = 'GetItems';
	$result = $DB->Fetch();
	if ($result) {
		foreach	($result as $item){
            // get item status from cart (may not exist)
            $item_status = Util::ItemCartStatus($item['IDItem']);
			$html .= <<<HTML
			<!-- Vehicle Details 1-->
			<div id="$item[IDItem]" class="product-details-area fluid-padding-3 ptb-130"> <div class="container-fluid"> <div class="row"> <div class="col-lg-6"> <div class="product-details-img-content"> <div class="product-details-tab mr-40"> <div class="product-details-large tab-content"> <div class="tab-pane active" id="pro-details1"> <div class="easyzoom easyzoom--overlay"> <a href="assets/img/product-details/$item[photo]1.jpg"> <img src="assets/img/product-details/$item[photo]1.jpg" alt=""> </a> </div></div><div class="tab-pane" id="pro-details2"> <div class="easyzoom easyzoom--overlay"> <a href="assets/img/product-details/$item[photo]2.jpg"> <img src="assets/img/product-details/$item[photo]2.jpg" alt=""> </a> </div></div><div class="tab-pane" id="pro-details3"> <div class="easyzoom easyzoom--overlay"> <a href="assets/img/product-details/$item[photo]3.jpg"> <img src="assets/img/product-details/$item[photo]3.jpg" alt=""> </a> </div></div><div class="tab-pane" id="pro-details4"> <div class="easyzoom easyzoom--overlay"> <a href="assets/img/product-details/$item[photo]4.jpg"> <img src="assets/img/product-details/$item[photo]4.jpg" alt=""> </a> </div></div></div><div class="product-details-small nav mt-12 product-dec-slider owl-carousel"> <a class="active" href="#pro-details1"> <img src="assets/img/product-details/$item[photo]1.jpg" alt=""> </a> <a href="#pro-details2"> <img src="assets/img/product-details/$item[photo]2.jpg" alt=""> </a> <a href="#pro-details3"> <img src="assets/img/product-details/$item[photo]3.jpg" alt=""> </a> <a href="#pro-details4"> <img src="assets/img/product-details/$item[photo]4.jpg" alt=""> </a> </div></div></div></div><div class="col-lg-6"> <div class="product-details-content"> <h2 class="left-text ">$item[name]</h2> <div class="quick-view-rating"> <i class="fa fa-star reting-color"></i> <i class="fa fa-star reting-color"></i> <i class="fa fa-star reting-color"></i> <i class="fa fa-star reting-color"></i> <i class="fa fa-star-half-empty"></i> <span> ( 1 Customer Review )</span> </div><div class="product-price"> <span>$item[price] €</span> </div><div class="product-overview"> <h5 class="pd-sub-title left-text ">Product Description</h5> <p> $item[description]</p></div><div class="quickview-btn-cart"> <form method="get" action="cart.php"> <input type="hidden" id="item_id" name="item_id" value="$item[IDItem]"> <input type="hidden" id="action" name="action" value="add"> <input type="hidden" id="back_to" name="back_to" value="product-details.html#$item[IDItem]"> <input class="btn-style cr-btn" name="update_cart" value="add to Cart" type="submit" style="cursor: pointer"/> </form> $item_status[1] <br/> $item_status[0] </div><div class="product-share"> <h5 class="pd-sub-title left-text ">Share</h5> <ul><li class="facebook"><a href="#"><i class="icofont icofont-social-facebook"></i></a></li><li class="twitter"><a href="#"><i class="icofont icofont-social-twitter"></i></a></li></ul> </div></div></div></div></div></div>
HTML;
		}
		
		echo json_encode(array("html" => $html));
		die();
	} else {
		http_response_code(500);
		die();
	}
} else if (isset($_GET['getCommentsByBook']) && $_GET['bookId'] > 0) {
	require_once('Authenticate.php');
	$DB = new Authenticate();
	$html = "";
	$DB->type = 'GetCommentByBook';
	$DB->param = array($_GET['bookId']);
	$result = $DB->Fetch();
	if ($result) {
		foreach	($result as $comment){
			$html .= <<<HTML
			<details open class="comment" id="$comment[ID]">
                    <summary>
                        <div class="comment-heading">
                            <div class="comment-info">
                                <a href="#" class="comment-author">$comment[first_name]</a>
                            </div>
                        </div>
                    </summary>
            
                    <div class="comment-body">
                        <p>
							$comment[contents]
                        </p>
                    </div>
                    
                </details>
HTML;
		}
		
		echo json_encode(array("html"=>$html, "num"=>count($result)));
		die();
	} else {
		http_response_code(500);
		die();
	}
} else if (isset($_GET['getWebhook'], $_GET['id'])) {
	$config = parse_ini_file("config.ini");
	$webhook = $config['webhook'];
	echo json_encode(array("webhookLink"=>$webhook));
	die();
	
} else if (isset($_GET['check_email'], $_GET['email'])) {
	require_once('Authenticate.php');
	$email = trim(strip_tags($_GET['email']));
	$DB = new Authenticate();
	if ($DB->isDuplicateOrInvalidEmail($email)) {
		echo json_encode(array("ErrorCode" => "10000", 'Message' => 'User already exists'));
		http_response_code(400);
		die();
	} else {
		echo json_encode(array("ErrorCode" => "0", 'Message' => 'User does not exist'));
		die();
	}
} else if (isset($_GET['loadCheckout'])){
	require_once('Util.php');
	$userId = Util::IsUserLoggedIn();
	// check if user is logged in
	if (!$userId) {
		// not logged in
		echo json_encode(array("ErrorCode" => "10001", 'Message' => 'User is not logged in'));
		http_response_code(400);
		die();
	}
	// try to load checkout data by getting the user id from the session
	$result = Util::GetClientById($userId);
	if ($result) {
		// success
		$userDataArray = array("name"=> $result["Name"], "email"=> $result["Email"], "phone_number"=> $result["Phone_number"], "country"=> $result["Country"], 
		"address"=> $result["Address"], "postal_code"=> $result["Postal_code"], "city" => $result["City"]);
		echo json_encode($userDataArray);
		die();
	} else {
		// error
		echo json_encode(array("ErrorCode" => "10002", 'Message' => 'Error loading checkout data'));
		http_response_code(400);
		die();
	}

} else {
	http_response_code(401);
	die();
}

	
?>