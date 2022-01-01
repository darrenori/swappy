<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
session_start();
echo $_SESSION["shippingid"];
var_dump($_SESSION);
$query = ("DELETE FROM mydb.user_shippinginformation WHERE user_shipping_id = ".$_SESSION['shippingid']);


// if($query){

//     echo "done";
//     header("location: ../swapproj/checkout/editshippingaddress?delete=success");
// }

if (mysqli_query($conn, $query)) {
    header("location: ../checkout");

} else {
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
?>