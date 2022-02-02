<?php
if (isset($_POST["addAdr"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/checkoutpage/verification.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
    session_start();
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


    $name = $_POST["name"];
    $phonenumber = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $zip = $_POST["zip"];
    $unit = $_POST["unit"];


    if (emptyInputShippingAdd($name, $email, $phonenumber, $address, $unit, $zip) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?error=shippingaddressemptyinput");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?error=invalidemail");
        exit();
    }
    if (invalidPostalCode($zip) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?error=invalidpostalcode");
        exit();
    }
    addShippingAdd($conn, $name, $phonenumber, $email, $address, $zip, $unit);
    header("location: https://www.swapamc.com/swapproj/checkout");
    exit();
} else {
    header("location: https://www.swapamc.com/swapproj/checkout");
    exit();
}
