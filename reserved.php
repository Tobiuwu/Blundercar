<?php
ini_set('display_errors', 0);
session_start();
ob_start();

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id']: 0;
$name_user = isset($_SESSION['name']) ? $_SESSION['name']: "";
$role = isset($_SESSION['role']) ? $_SESSION['role']: "";	
// non logged in users are redirected to login page
if ($userId == 0) {
    header("Location: login.php");
    die();
}
// if user is logged in, but not a seller, redirect to product details page
if ($role == "Seller"){
    header("Location: sellers.php");
    die();
} elseif ($role == "Client"){
    header("Location: checkout.php");
    die();
}
?>
<!DOCTYPE HTML>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BLUNDER CAR</title>
    <meta name="description" content="Welcome to Blunder Car! Our website specializes in the sale of cars and spare parts. With our simple and intuitive content management system, you can easily sell your vehicle or offer parts for sale. We offer a wide range of vehicles and parts to ensure you find exactly what you are looking for. So feel free to join our community of sellers and buyers at Blunder Car today!">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon - favorite icons -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- Calling all css -->

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600&display=swap" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/form.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bundle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="https://kit.fontawesome.com/a4b16492f8.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
    <div class="col-lg-4 col-md-4 col-4">
        <div class="logo-small-device">
            <a href="index.html"><img alt="" src="assets/img/logo/logo.png"></a>
        </div>
        </div>
        <div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h2>access from <?php echo $role;?></h2>
                    <ul>
                        <li>
                            <a href="index.html">home</a>
                        </li>
                        <li>restricted access</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div style="text-align: center">
        <h1>Hello, <?php echo $name_user;?>!</h1>
        <input id="goTo" value="Logout" class="btn-style cr-btn" onclick="location.href = 'logout.php';" readonly></input>
    </div>
    <label for="actions"><h2>Sales report</h2></label><br/>
    <select name="sellvehicles" id="sellvehicles" style="width:300px; margin:4px;" onchange="admSelectCheck(this, false);">
        <option selected name= "" value="">Select an option...</option>
        <option name="seeAll" value="seeAll">View Data - ALL</option>
        <option id="option" name="currentMonth" value="currentMonth">View Data - PER MONTH</option>
    </select>  
    <select id="element" name="element" style="width:300px; margin:4px; display: inline; display:none;">        
    </select>
    <input id="reportSubmit" value="Load Data" name="submit" class="btn-style cr-btn" readonly></input>
    <div id="result" class="hidden"></div>
    <div id="salesDataContainer" class="container hidden">
        <br/>
        <br/>
        <h2 style='color:black'>Sale of Vehicles/Items</h2>
        <br/>
        <table id="reportTable" class="table table-striped table-bordered"> 
            <tr> 
                <th>Sale Number</th>
                <th>Customer ID</th>
                <th>Vehicle Number</th>
                <th>Item Number</th>
                <th>Sale Total Price</th>
                <th>Date of Sale</th>
                <th>Employee Number</th>
            </tr>
            <tbody id="tableLine">
                <!---This is where the data will be displayed !-->
            </tbody>
        </table>
        <table>
        <tr>
            <th>Total sales</th>
        </tr>
        <tr>
            <td id="sales">

            </td>
        </table>
        <!---Calls the download.php file to download the selected data in excel format !-->
        <div id="downloadExcelButton" style="display: block;">
            <button id="tableDownload" name="downloadfile" value="Export to Excel" class="btn btn-success" style="cursor: pointer; width:300px; float:right; margin-top:-40px">Export To Excel</button>
        </div>
    </div>
    </div>
    <!-- Calling js !-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <!-- Modal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7"></script>
    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
    <!--scripts -->
    <script src="assets/js/showSelection.js"></script>
    <script src="assets/js/report.js"></script>
</body>
</html>