<?php

// logout and delete all session variables
session_start();
ob_start();

ini_set('display_errors', 0);
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
@session_destroy();
header("Location: login.php");
die();
?>