<?php 
require_once("Authenticate.php");
session_start();
ob_start();

class Util
{
    public static function GetItemById($itemID){
        /** Returns the item information from the database, based on the ID sent to the function
            *@param int $itemID ID of the item
            *@return array $result Returns the item information, return false if no item is found
            *@version 1.0
        **/
        $DB = new Authenticate();
        $DB->type = 'GetItemById';
        $DB->param = array($itemID);
        $result = $DB->Fetch();
        if ($result && count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }    
    }

    public static function GetClientById($clientId){
        /** Returns the client information from the database, based on the ID sent to the function
            *@param int $clientId ID of the client
            *@return array $result Returns the client information, return false if no client is found
            *@version 1.0	
        **/
        $DB = new Authenticate();
        $DB->type = 'GetClientById';
        $DB->param = array($clientId);
        $result = $DB->Fetch();
        if ($result && count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }    
    }

    public static function GetClientByEmail($email){
        /** Returns the client information from the database, based on the email sent to the function
            *@param string $email Email of the client
            *@return array $result Returns the client information, return false if no client is found
            *@version 1.0	
        **/
        $DB = new Authenticate();
        $DB->type = 'GetClientByEmail';
        $DB->param = array($email);
        $result = $DB->Fetch();
        if ($result && count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }    
    }

    public static function GetOrderById($orderId){
        /** Returns the order information from the database, based on the ID sent to the function
            *@param int $orderId ID of the order
            *@return array $result Returns the order information, return false if no order is found
            *@version 1.0	
        **/
        $DB = new Authenticate();
        $DB->type = 'GetOrderById';
        $DB->param = array($orderId);
        $result = $DB->Fetch();
        if ($result && count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }    
    }
    
    public static function ItemCartStatus($id, $feedback="", $remove_item_button="", $verification=array()){
        /** Feedback function that returns a message when a item is added/removed from the cart and creates a button to allow
             ** the redirection to the page containing the cart
            *@author BlunderCar - Tobi
            *@param int $id ID number of the product/vehicle, used to show the message only on that product/article
            *@param string $feedback Contains the html feedback when a product is added or removed from the cart
            *@param string $remove_item_button Button for removing items, in html
            *@return array $verification Returns the variables id, feedback, and the buttons (Defined or not)
            *@version 1.3                                                                                                                                                                                                                                                                               
    
        **/
        $back_to = $_SESSION['back_to'];
    
        /** $_SESSION['item_id']['item_id']: Associative array with all item ID's. **/
        if(isset($_SESSION['item_id']['item_id'])){
            if ($_SESSION['item_id']['item_id'] == $id){
                $feedback = $_SESSION['feedback']['feedback'];
                
            }
        }
    
        /** if(isset($_SESSION['enable_remove_items'][$id])): Checks if the associative array in the id sent to the function exists, if so, sets the button. **/
        if(isset($_SESSION['enable_remove_items'][$id])){
            $remove_item_button = $_SESSION['enable_remove_items'][$id];
        }
    
        return array($feedback, $remove_item_button);
    }

    public static function IsUserLoggedIn(){
        /** Checks if the user is logged in
            *@return bool Returns the userId if the user is logged in, false if not
            *@version 1.1
        **/
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id']: 0;
        if ($userId > 0) {
            return $userId;
        } else {
            return false;
        }
    }

}


?>