<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

session_start();
session_regenerate_id();
echo $_SESSION["shippingid"];
// $_SESSION["shippingid"] = $shippingid;
$name = $_POST['name'];
$phonenumber = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$unit = $_POST['unit'];





if (emptyInputShippingAdd($name, $email, $phonenumber, $address, $unit, $zip) !== false) {
    header("location:https://www.swapamc.com/swapproj/checkout/checkout/editshippingaddress?error=shippingaddressemptyinput");
    exit();
}

if (invalidEmail($email) !== false) {
    header("location: https://www.swapamc.com/swapproj/checkout/checkout/editshippingaddress?error=invalidemail");
    exit();
}
if (invalidPostalCode($zip) !== false) {
    echo "<p>Invalid PostalCode</p>";
    header("location: https://www.swapamc.com/swapproj/checkout/checkout/editshippingaddress?error=invalidpostalcode");
    exit();
} else {

    $query = ("UPDATE mydb.user_shippinginformation SET user_shipping_name = '$name',
                     user_shipping_number = '$phonenumber', user_shipping_email  = '$email', user_shipping_address=  '$address', user_shipping_postalcode = '$zip', user_shipping_unitnumber  = '$unit' 
                    WHERE user_shipping_id = " . $_SESSION['shippingid']);


    if (mysqli_query($conn, $query)) {
        header("location: https://www.swapamc.com/swapproj/checkout/viewshippingaddress?type=success");
        echo "Records were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }

    exit();
}
mysqli_close($conn);
