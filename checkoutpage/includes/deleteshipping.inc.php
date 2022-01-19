<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
session_start();

$query = ("UPDATE mydb.user_shippinginformation SET deleted = '1' WHERE user_shipping_id = ".$_SESSION['shippingid']);


if (mysqli_query($conn, $query)) {
    header("location: ../checkout");

} else {
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
?>