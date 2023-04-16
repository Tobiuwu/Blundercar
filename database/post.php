<?php
ini_set('display_errors', 0);
session_start();
ob_start();

if (!empty($_POST['Register'])) {
    require_once('Authenticate.php');
    require_once('Util.php');
    $DB = new Authenticate();
    //set variables
    $name = trim(strip_tags($_POST['name']));
    $email = trim(strip_tags($_POST['email']));
    $password = trim(strip_tags($_POST['pwd']));
    $address = trim(strip_tags($_POST['address']));
    $postal_code = trim(strip_tags($_POST['postal_code']));
    $city = trim(strip_tags($_POST['city']));
    $country = trim(strip_tags($_POST['country']));
    $phone_number = trim(strip_tags($_POST['phone_number']));

    // test for null/empty inputs, which can't exist
    $FormData = array($name, $email, $phone_number, $country, $address, $postal_code, $city);
    // Test for empty inputs
    if ($DB->IsEmpty($FormData)) {
        // exception
        echo json_encode(array("ErrorCode" => "10005", 'Message' => 'Missing or empty data'));
        http_response_code(400);
        die();
    }
    $DB->type = 'CreateClient';
    $DB->param = $FormData;
    if ($DB->Insert()) {
        // get client id from email and verify client actually exists in database
        $client = Util::GetClientByEmail($email);
        if ($client) {
            // client exists, create login
            $DB->type = 'CreateClientLogin';
            $FormData = array($client['IDClient'], $password);
            // test for empty input 
            if ($DB->IsEmpty($FormData)) {
                // exception
                echo json_encode(array("ErrorCode" => "10005", 'Message' => 'Missing or empty data'));
                http_response_code(400);
                die();
            }
            $DB->param = $FormData;
            if (!$DB->Insert()) {
                // failed to create login, delete client
                $DB->type = 'DeleteClient';
                $DB->param = array($client['IDClient']);
                $DB->Delete();
                if (!$DB->Delete()) {
                    // failed to delete client
                    echo json_encode(array("ErrorCode" => "10009", 'Message' => 'Failed to create client login, Failed to delete client'));
                    http_response_code(500);
                    die();
                }
                echo json_encode(array("ErrorCode" => "10008", 'Message' => 'Failed to create client login, client info deleted'));
                http_response_code(500);
                die();
            }
            // success on creating login and client
            echo json_encode(array('Registration' => 'Success'));
            http_response_code(200);
            die();
        } else {
            // client doesn't exist
            echo json_encode(array("ErrorCode" => "10007", 'Message' => 'Client does not exist'));
            http_response_code(400);
            die();
        }
        
    } else {
        echo json_encode(array("ErrorCode" => "10006", 'Message' => 'Failed to create client'));
        http_response_code(500);
        die();
    }
} else if (!empty($_POST['Login']) && isset($_POST['email'], $_POST['pw'])) {
    require_once('Authenticate.php');
    $DB = new Authenticate();
    $email = trim(strip_tags($_POST['email']));
    $password = trim(strip_tags($_POST['pw']));
    $FormData = array($email, $password);
    // Test for empty inputs
    if ($DB->IsEmpty($FormData)) {
        // exception
        echo json_encode(array("ErrorCode" => "10005", 'Message' => 'Missing or empty data'));
        http_response_code(400);
        die();
    }
    $DB->type = 'LoginUser';
	$DB->param = $FormData;
    $result = $DB->Fetch();
    if ($result && count($result) == 1) {
        $_SESSION['name'] = $result[0]["Name"];
        $_SESSION['email'] = $result[0]["Email"];
        $_SESSION['user_id'] = $result[0]["IDClient"];
        $_SESSION['role'] = "Client";
        echo json_encode(array("login"=>"success"));
        die();
    } else {
        // check for intern login
        $DB->type = 'LoginIntern';
        $result = $DB->Fetch();
        if ($result && count($result) == 1) {
            $_SESSION['name'] = $result[0]["Name"];
            $_SESSION['email'] = $result[0]["Email"];
            $_SESSION['user_id'] = $result[0]["IDUsers"];
            $_SESSION['role'] = $result[0]["Role"];
            echo json_encode(array("login"=>"success"));
        } else {
            http_response_code(401);
            die();
        }
	}
} else if (!empty($_POST['Checkout']) && isset($_POST['email'], $_POST['country'], $_POST['name'], $_POST['address'], 
$_POST['city'], $_POST['postal_code'], $_POST['phone_number'])) {
    require_once('Authenticate.php');
    require_once('Util.php');
    $DB = new Authenticate();
    // set variables
    $email = trim(strip_tags($_POST['email']));
    $country = trim(strip_tags($_POST['country']));
    $name = trim(strip_tags($_POST['name']));
    $address = trim(strip_tags($_POST['address']));
    if(isset($_POST['address_number'])){
        $address_number = trim(strip_tags($_POST['address_number']));
        $address = $address." ".$address_number;
    }
    $city = trim(strip_tags($_POST['city']));
    $postal_code = trim(strip_tags($_POST['postal_code']));
    $phone_number = trim(strip_tags($_POST['phone_number']));
    $more_information = trim(strip_tags($_POST['more_information']));
    // clear post array to prevent double insert
    $_POST = array();
    unset($_POST);
    $userId = Util::IsUserLoggedIn();
    // check if products are in session and user is logged in
    if(isset($_SESSION['products']['products']) && $userId){
        // gets all products and total order price from session
        $FormData = array($name, $email, $phone_number, $country, $address, $postal_code, $city, $userId);
        // test for null/empty inputs, which can't exist
        if ($DB->IsEmpty($FormData)) {
            // exception
            echo json_encode(array("ErrorCode" => "10005", 'Message' => 'Missing or empty data'));
            http_response_code(400);
            die();
        }
        $DB->type = "UpdateClientInfo";
        $DB->param = $FormData;
        // update customer information
        if ($DB->Update()) {
            // get the products into variable
            $products = $_SESSION['products']['products'];
            // get the total number of products
            $num_products_total = count($products) / 4;
            $DB->type = "InsertOrder";
            // create unique order id
            $order_id = uniqid();
            $product_amount = 1;
            $product_price = 2;
            $product_id = 3;
            // Cycle on all products and insert the orders into the database
            for($items = 0; $num_products_total > $items; $items++){
                $DB->param = array($order_id, $userId, $products[$product_id], $products[$product_amount], $products[$product_price], $more_information);
                // insert order
                if(!$DB->Insert()){
                    echo json_encode(array("ErrorCode" => "10004", 'Message' => 'Failed to insert order'));
                    http_response_code(500);                  
                    die();
                }
                // Adds three more at the end of each cycle so that the correct product positions are displayed,
                // e.g.: product name 1 is in position 0, while product name 2 is in position 3
                $product_amount += 4;
                $product_price += 4;
                $product_id += 4;
            }

            // after inserting the order, send email to the customer

            // get the client information
            $clientDetails = Util::GetClientById($userId);
            $clientOrder = array();
            if (!$clientDetails) {
                echo json_encode(array("ErrorCode" => "10010", 'Message' => 'Failed to get client information'));
                http_response_code(400);
                die();
            }
            array_push($clientOrder, $order_id, $userId, $_SESSION['total_value_products'], date("Y-m-d H:i:s"), $_SESSION['shipping']);
            // client address array, reorganize the array to match the email template
            $sentAddress = array($clientDetails['Name'], $clientDetails['Email'], $clientDetails['Address'], $clientDetails['Postal_code'], 
            $clientDetails['City'], $clientDetails['Country'], $clientDetails['Phone_number']);
            // Defines array with all data to send email to client
            $_SESSION['purchase_success'] = array("1", $more_information, $clientOrder, $sentAddress);
            // checkout is successful
            echo json_encode(array("checkout"=>"success"));
            die();
        } else {
            echo json_encode(array("ErrorCode" => "10003", 'Message' => 'Failed to udpate client information'));
            http_response_code(500);
            die();
        }
    } else {
        echo json_encode(array("ErrorCode" => "10001", 'Message' => 'User is not logged in'));
        http_response_code(400);
        die();
    }
} else {
    http_response_code(500);
    die();
}