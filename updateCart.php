<?php
 
// Disables error logging, so that there is no possibility of errors appearing to the end user
ini_set('display_errors', 0);
require_once("database/util.php");
session_start();
$total_value_products = 0;
$total_number_products = 0;
$vehicle_name = "";
$line_cost = 0;
$total_vehicles = 0; 
$total_items = 0;
$product_type = "";
$item_null = FALSE;
$vehicle_null = FALSE;
$back_to = $_SESSION['back_to'];

/** Only starts the process if a vehicle/article has been added to the cart via the store. **/
if(isset($_SESSION['products_items'])){
    $item_id = $_SESSION['item_id']['item_id'][0];
    $name = "";
    $item_price = 0;
    /** $products: Array of products in the cart. **/
    $products = array();
    /** $prod_vehicles_old: Array of the products already added to the cart previously. **/
    $prod_vehicles_antigos = array();
    // Condition that does not allow products to be defined that have not been added in cart.php(or that have been removed)
    if(isset($_SESSION['cart_items'][$item_id])){
        // Quantity is defined in cart_items.php
        $item_quantity = $_SESSION['cart_items'][$item_id];
        // Get products details from database 
        $item = Util::GetItemById($item_id);
        // Loop for extracting result
        if($item) {
            $name = $item['name'];
            $item_price = $item['price'];  
        }
        // Sets the price per item
        $line_cost = $item_price * $item_quantity; 
        // Adds to the total value
        $total_items = $total_items + $line_cost; 
        $no_products = TRUE;
        // If products already exist in the cart, if the new product is the same as an existing product, it resets the product positions to the new product
        if(isset($_SESSION['products']['products'])){
            $products = $_SESSION['products']['products'];
            $num_products = count($products);
            // Loop for comparing the products
            for($products_repeated = 0; $num_products > $products_repeated; $products_repeated++){
                // If the product already exists, it resets the product positions to the new product
                if($name == $products[$products_repeated]){
                    // Removes the product from the products array
                    $products[$products_repeated] = $name;
                    $products[$products_repeated + 1] = $item_quantity;
                    $products[$products_repeated + 2] = $total_items;
                    $products[$products_repeated + 3] = $item_id;
                    $no_products = FALSE;
                    break;
                }
            }
        }
        // If there are no products, pushes the values into the products array
        if($no_products == TRUE){
            array_push($products, $name, $item_quantity, $total_items, $item_id);   
        }
    } else {
        $item_null = TRUE;
    }

    // If the product is null, it removes it from the products array
    if($item_null == TRUE){
        // get product name from database
        $products = $_SESSION['products']['products'];
        // call static method from util.php
        $item = Util::GetItemById($item_id);
        $name = $item['name'];
        $num_products = count($products);
        // Cycle that removes the null product from the products array
        for($remove_null_products = 0; $num_products > $remove_null_products; $remove_null_products++){
            
            if($name == $products[$remove_null_products]){
                unset($products[$remove_null_products]);
                unset($products[$remove_null_products + 1]);
                unset($products[$remove_null_products + 2]);
                unset($products[$remove_null_products + 3]);
                $products = array_values($products);
                break;        
            }
        }
    }
    // Removes the session associative array from all products so that the above process is not repeated just by reloading the page
    unset($_SESSION['vehicle_products']);
    unset($_SESSION['item_product']);
   // Stores all products in the associative array
    if(isset($products)){
        /** $_SESSION['products']['products']: Associative array that holds all the products in the cart. */
        $_SESSION['products']['products'] = $products;
    }
   /** if(count($products) == 0): If the number of products equals zero, it means there are no products, so remove the associative array of products. **/
    if(count($products) == 0){
        unset($_SESSION['products']['products']);
    } 
}
// Redirects to the page from which the script was called
header('Location: '.$back_to);
die();
?>