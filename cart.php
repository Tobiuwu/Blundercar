<?php

ini_set('display_errors', 0);
session_start();

/** Information sent when adding/removing a vehicle in product-details.html or clearing the list in checkout. **/
if(isset($_GET['update_cart'])){
    /** Action to be taken. **/
    $action = $_GET['action']; 
    /** Page to redirect. **/
    $back_to = $_GET['back_to'];
    // Stores in the associative array the page to be redirected from the current product
    $_SESSION['back_to'] = $back_to;
    $item_id = "";
    /** $item_id = $_GET['item_id']: sets the id of the item sent by product_details.php. **/
    if(isset($_GET['item_id'])){
        $item_id = $_GET['item_id']; 
        /** $_SESSION['item_id']['item_id'] = $item_id: Save in the array for the feedback function in product_details.php to receive. **/
        $_SESSION['item_id']['item_id'] = $item_id;   
    }
    
    /** switch($action): Decides what will be done from the action sent. **/
    switch($action) { 
        /** case "add": add a product to the cart and enable the "Remove Product" button in product_details. **/
        case "add":
            /** $_SESSION['cart_items'][$item_id]++: Adds one for the item with the defined id. **/
            $_SESSION['cart_items'][$item_id]++;
            /** $_SESSION['products_items'] = "add": Sets a value for products items to confirm that a product has been added. **/
            $_SESSION['products_items'] = "add";    
            /** $_SESSION['feedback']['feedback']: Sets the feedback to be given after the item is added to the cart(Function under Feedback in product-details.html). **/
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Product Added to Cart!</h4><br/>
                            <a href='checkout.php'>
                            <input class='btn-style cr-btn' value='View Cart' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            /** $_SESSION['enable_remove_items'][$item_id]: Enables the button to remove an item from the cart as soon as one has been added. **/
            $_SESSION['enable_remove_items'][$item_id] = "<form method='get' action='cart.php'>
                        <input type='hidden' id='item_id' name='item_id' value='$item_id'>
                        <input type='hidden' id='action' name='action' value='remove'>
                        <input type='hidden' id='back_to' name='back_to' value='$back_to'>
                        <input class='btn-style cr-btn' name='update_cart' value='remove from cart' type='submit' style='cursor: pointer'></input>
        </form>";
            header("Location: updateCart.php");
            die();            
       /** case "remove": Removes an item from the cart. **/
        case "remove":
            /** $_SESSION['cart_items'][$item_id]--: Removes one for the vehicle with the id set above. **/
            $_SESSION['cart_items'][$item_id]--;
            /** $_SESSION['products_items'] = "remove": Sets a value for vehicle products to confirm in checkout.php that a product has been removed. **/
            $_SESSION['products_items'] = "remove";
            $_SESSION['feedback']['feedback'] = "<div style='text-align: center'>
                            <h4>Product Removed from cart!</h4><br/>
                            <a href='checkout.php'>
                            <input class='btn-style cr-btn' value='View cart' type='button' style='cursor: pointer;'></input>
                            </a>
                        </div>";
            // If the number is zero (0 items with that id in the cart), remove the variable, so if it continued it would show values like -1,-2 in the cart,
            // and disable the remove button, as soon as the number of vehicles in the cart is zero
            /** if($_SESSION['cart_items'][$item_id] == 0: Disable the remove button and remove the product from the cart if it is zero. **/
            if($_SESSION['cart_items'][$item_id] == 0) {
                unset($_SESSION['cart_items'][$item_id]);
                unset($_SESSION['enable_remove_items'][$item_id]);
            }
            header("Location: updateCart.php");
            die();
        /** case "clear": Clears the cart and destroys the session. **/
        case "clear":
            // Clears all variables so that the cart is without any items/vehicles
            unset($_SESSION['products']['products']);
            unset($_SESSION['cart_vehicles']);
            unset($_SESSION['cart_items']);
            unset($_SESSION['prod_vehicles_old']);
            unset($_SESSION['vehicle_id']['vehicle_id']);
            unset($_SESSION['item_id']['item_id']);
            unset($_SESSION['enable_remove_vehicles']);
            unset($_SESSION['enable_remove_items']);
            unset($_SESSION['products_vehicles']);
            unset($_SESSION['products_items']);
            unset($_SESSION['feedback']['feedback']);
            header('Location: '.$back_to);
            die();

    }       
} else if (isset($_GET['getAllCartItems'])) {
    $html = "";
    $shipping = 10; 
    $currency = "€";
    if(isset($_SESSION['products']['products'])){     
        $products = $_SESSION['products']['products'];
        $product_name = 0; 
        $product_amount = 1;
        $product_price = 2;
        // Divide by 4 so each product takes up 4 positions in the array: 12 positions / 4 = 4 products
        $num_products_total = count($products) / 4;
        $price_pos = 2;                                                                   
        // Calculates the total amount of the purchase 
        for($item_price = 0; $num_products_total > $item_price; $item_price++){
            $total_value_products += $products[$price_pos];
            // Add three because each product price is three positions ahead of the other
            $price_pos += 4;
        }
        // cycle that presents all products to the client
        for($num_lines = 0; $num_products_total > $num_lines; $num_lines++) {
            $html .= <<<HTML
            <thead>
                <tr class="cart_item">
                    <td id="test" class="product-name">
                    <label>Name:</label>
                        $products[$product_name]
                    </td>
                    <td>             
                    <label>Quantity:</label>
                        <strong>X$products[$product_amount]</strong>
                    </td>
                    <td class="product-total">
                        <label>Price:</label>
                        <span class="amount">$products[$product_price]€</span>
                    </td>
                </tr>
            </thead>
HTML;
            //array_push($product_name, $products[$product_name]); ??????
            // Adds three more at the end of each cycle so that the correct product positions are displayed,
            // e.g.: product name 1 is in position 0, while product name 2 is in position 3
            $product_name += 4; 
            $product_amount += 4;
            $product_price += 4;
        }
        
        if($total_value_products > 99){
            $shipping = 5; 
        }
        if($total_value_products > 999){
            // If the total value of the products is greater than 999, the shipping is free
            $shipping = "Free";
            $currency = "";
        }
        if($shipping != "Free"){
            $total_value_products = $total_value_products + $shipping;
        }
        // add shipping and total value of order to session variables
        $_SESSION['shipping'] = $shipping;
        $_SESSION['total_value_products'] = $total_value_products;

        // add the rest of table html 
        $html .= <<<HTML
            <tr class="cart_item">
                <th>shipping</th>
                <td>
                    <strong><span id="shippingPrice" class="amount">$shipping $currency</span></strong>
                </td>
            </tr>
        
            <tfoot>
                <tr class="order-total">
                    <th>Total</th>
                    <td><strong><span id="orderTotalPrice" class="amount">$total_value_products €</span></strong>
                    </td>
                </tr>								
            </tfoot>
HTML;
        } else { 
            $html = "<h4>There is no product in the cart</h4>";
        }
        echo json_encode(array("html" => $html));
} else {
    /** Goes back if not action is defined **/
    header('Location: '.$back_to);
    die();
}

?>