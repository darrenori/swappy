<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';


//take note
if (!isset($jwtarrayinformation["progresscheckout"])) {
    header("location: ../product/viewcart");
} elseif ($jwtarrayinformation["progresscheckout"] != 'A') {
    header("location: ../product/viewcart");
}

foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";

    if ($key != "quantity") {
        $postinformation[$key] = $value;
    }
}

$cart = $jwtarrayinformation['cart'];
$cartarray = $jwtarrayinformation['cartarray'];

$cartid = $cartarray[$cart];

$query = $conn->prepare("DELETE FROM mydb.user_cart WHERE cart_id = $cartid");

if ($query->execute()) {

    echo "done";
    header("location: ../product/viewcart");
} else {
    header("location: ../swapproj/allproducts/product/delete?error=stmtfailed");
    exit();
}
