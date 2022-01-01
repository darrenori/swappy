<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
echo "hi";
session_start();
$userid = $_SESSION["userid"];
$shipping_id = (int)$_GET['shippingid'];
$query = ("UPDATE mydb.user_shippinginformation SET  user_shipping_default  = 0
                    WHERE user_shipping_userid = " . $userid);

if (mysqli_query($conn, $query)) {
    $query = ("UPDATE mydb.user_shippinginformation SET  user_shipping_default  = 1
                    WHERE user_shipping_id = " . $shipping_id);


    if (mysqli_query($conn, $query)) {
        header("location: https://www.swapamc.com/swapproj/checkout?default=success");
        echo "Default Address set.";
    } else {
        echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }

    exit();


    mysqli_close($conn);
} else {
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}

exit();
mysqli_close($conn);
