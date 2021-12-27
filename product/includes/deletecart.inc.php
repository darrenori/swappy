<?php
## Originally delete


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


//take note
if (!isset($jwtarrayinformation["progresscheckout"])) {
    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart");
} elseif ($jwtarrayinformation["progresscheckout"] != 'A') {
    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart");
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

try {
    $query = $conn->prepare("DELETE FROM mydb.user_cart WHERE cart_id = $cartid");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(editcart.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=" . $cartid . "&error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (editcart.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=" . $cartid . "&error=badstatement"); //    echo mysqli_error($query);

    exit;
}

    echo "done";
    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart");
