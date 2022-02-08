<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example

if (!isset($_GET['dt'])) {
    header("location: https://www.swapamc.com/swapproj/checkout/viewshippingaddress?error=unknown");
    exit;
}




$_GET['csrf'] = $_GET['dt'];

// var_dump( $_GET);
// var_dump( $_SESSION);
// var_dump($u=validateCSRF());exit;
### CSRF ####
if (validateCSRFGet() == false) {
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
$whitelist = ['shippingid'];
$_GET = XSSPrevention($_GET, $whitelist);
// runs all variables thru sqlescape string
$_GET = escapeString($conn, $_GET);
// declares variable length in chars for each item. 
$maxlengtharray['shippingid'] = 11;

// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_GET, $maxlengtharray));
$emptyflag = empty(checkEmpty($_GET, $whitelist));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/checkout/viewshippingaddress?error=invalidinput");
    exit;
}

//removes any nondigit characters.
$storeid = preg_replace('/[^\d]/', '', $_GET['shippingid']);
$shippingid = $_GET['shippingid'];


try {
    $query = $conn->prepare("UPDATE mydb.user_shippinginformation SET deleted = '1' WHERE user_shipping_id = ?");
    $query->bind_param('s', $shippingid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(deleteshipping.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (DELETE)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/checkout/viewshippinaddress?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (deleteshipping.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (DELETE)", 0);
    header("location: https://www.swapamc.com/swapproj/checkout/viewshippinaddress?error=badstatement"); //    echo mysqli_error($query);
    exit;
}


header("location: https://www.swapamc.com/swapproj/checkout/viewshippingaddress");
