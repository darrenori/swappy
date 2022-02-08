<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
$csrf=generateCSRF();
$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

}



// user set default shipping = 0 / 1
$userid = $jwtarrayinformation['userid'];
$shipping_id = (int)$_GET['shippingid'];
$query = ("UPDATE mydb.user_shippinginformation SET  user_shipping_default  = 0
                    WHERE user_shipping_userid = " . $userid);

if (mysqli_query($conn, $query)) {
    $query = ("UPDATE mydb.user_shippinginformation SET  user_shipping_default  = 1
                    WHERE user_shipping_id = " . $shipping_id);


    if (mysqli_query($conn, $query)) {
        echo "Default Address set.";
    } else {
        echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
} else {
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}

mysqli_close($conn);
header("location: https://www.swapamc.com/swapproj/checkout?default=success");
