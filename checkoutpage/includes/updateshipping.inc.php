<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

session_start();
session_regenerate_id();




// var_dump( $_POST);
// var_dump( $_SESSION);
// var_dump($u=validateCSRF());exit;
### CSRF ####
if (validateCSRF() == false) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


    if ($actual_link == "http://www.swapamc.com/swapproj/checkout/addshippingaddress?error=badcsrf") {
        echo 'bad csrf';
        //dont redirect if on the same page

    } else {
        header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?error=badcsrf");
        exit;
    }
}
### CSRF ####

// removes any other GET and POST names and does html specialchars
$whitelist = ['name', 'phone', 'email', 'address', 'zip', 'unit'];
$_POST = XSSPrevention($_POST, $whitelist);
// runs all variables thru sqlescape string
$_POST = escapeString($conn, $_POST);
// declares variable length in chars for each item. 
$maxlengtharray['name'] = 45;
$maxlengtharray['phone'] = 45;
$maxlengtharray['email'] = 45;
$maxlengtharray['address'] = 45;
$maxlengtharray['zip'] = 45; // number should be 8 chars long only (SQL allows 45)
$maxlengtharray['unit'] = 45; // Inactive is 8 chars long

// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
$emptyflag = empty(checkEmpty($_POST, $whitelist));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?error=invalidinput");
    exit;
}







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

    try {
        $query = $conn->prepare("UPDATE mydb.user_shippinginformation SET user_shipping_name = ?,
        user_shipping_number = ?, user_shipping_email  = ?, user_shipping_address=  ?, user_shipping_postalcode = ?, user_shipping_unitnumber  = ? 
       WHERE user_shipping_id = ?");
        $query->bind_param('sssssss', $name, $phonenumber, $email, $address, $zip, $unit, $_SESSION['shippingid']);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(updateshipping.inc)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (UPDATE)", 0);
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/checkout/viewshippinaddress?error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (updateshipping.inc)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (UPDATE)", 0);
        header("location: https://www.swapamc.com/swapproj/checkout/viewshippinaddress?error=badstatement"); //    echo mysqli_error($query);

        exit;
    }


    header("location: https://www.swapamc.com/swapproj/checkout/viewshippingaddress?type=success");
}
mysqli_close($conn);
