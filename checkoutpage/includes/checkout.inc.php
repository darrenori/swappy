<?php
if (isset($_POST["submit"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/checkoutpage/verification.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    var_dump($_POST['csrf']);
    session_start();

    ### CSRF ####
    if (validateCSRF() == false) {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


        if ($actual_link == "http://www.swapamc.com/swapproj/home?error=badcsrf") {
            echo 'bad csrf';
            //dont redirect if on the same page

        } else {
            header("location: https://www.swapamc.com/swapproj/home?error=badcsrf");
            error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(badcsrf)", 0);

            exit;
        }
    }
    ### CSRF ####

    session_regenerate_id();
 
   

    $whitelist = ['cname', 'ccnum', 'expmonth', 'expyear', 'cvc'];
    $_POST = XSSPrevention($_POST, $whitelist);
    // declares variable length in chars for each item. 
    $maxlengtharray['cname'] = 45;
    $maxlengtharray['ccnum'] = 45;
    $maxlengtharray['expmonth'] = 45;
    $maxlengtharray['expyear'] = 45;
    $maxlengtharray['cvc'] = 4;

    //removes any nondigit characters.
    $_POST['cvc'] = preg_replace('/[^\d]/', '', $_POST['cvc']);
    $_POST['ccnum'] = preg_replace('/[^\d]/', '', $_POST['ccnum']);
    // bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
    $bufferflag = empty(checkLength($_POST, $maxlengtharray));
    $emptyflag = empty(checkEmpty($_POST, $whitelist));


    if (!($bufferflag && $emptyflag)) {
        header("location: https://www.swapamc.com/swapproj/checkout/checkout?error=invalidinput");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(invalidinput)", 0);
        exit;
    }



    $cname = $_POST["cname"];
    $number = $_POST["ccnum"];
    $expmonth = $_POST["expmonth"];
    $expyear = $_POST["expyear"];
    $cvc = $_POST["cvc"];
    $cardtype = validatecard($number);
    $emptycarts = $_SESSION['cart'];
    $sa = $_SESSION['shippingaddress'];
    $bundledidrandom = floatval(rand(pow(10, 8 - 1), pow(10, 8) - 1));
    $_SESSION['bundledid'] = $bundledidrandom;
    $ccnumber = substr($number, -4);


    //Encrypt
    //Define cipher 
    $cipher = "aes-192-cbc";


    //Generate a 192-bit encryption key 
    $encryption_key = openssl_random_pseudo_bytes(24);


    // Generate an initialization vector 
    $iv_size = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_size);


    //Data to encrypt 
    $ccnum = openssl_encrypt($ccnumber, $cipher, $encryption_key, 0, $iv);
    $hexkey = bin2hex($encryption_key);
    $hexiv = bin2hex($iv);






    if (emptyCart($emptycarts) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=emptycart");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(emptycart)", 0);
        exit();
    }
    if (emptyDefaultShipping($sa) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=emptydefaultshipping");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(emptydefaultshipping)", 0);
        exit();
    }
    if (emptyInputPayment($cname, $number, $expmonth, $expyear, $cvc) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=paymentemptyinput");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(paymentemptyinput)", 0);
        exit();
    }
    if (validatecard($number) === false) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidcardtype");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(invalidcardtype)", 0);
        exit();
    }
    if (luhn_check($number) === false) {
        echo "<p>Credit Card Number Invalid</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=paymentbadnumb");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(paymentbadnumb)", 0);
        exit();
    }
    if (invalidExpMonth($expmonth) !== false) {
        echo "<p>Invalid Exp Month</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidexpmonth");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(invalidexpmonth)", 0);
        exit();
    }
    if (invalidExpYear($expyear) !== false) {
        echo "<p>Invalid Exp Year</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidexpyear");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(invalidexpyear)", 0);
        exit();
    }
    if (invalidCVC($cvc) !== false) {
        echo "<p>Invalid CVC</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidcvc");
        error_log("TPAMC:CHECKOUT(checkoutinc):0:$ip:Error(invalidcvc)", 0);
        exit();
    } else {

        //bring credit card data to after email validation
        $jwtarrayinformation['cname'] = $cname;
        $jwtarrayinformation['expmonth'] = $expmonth;
        $jwtarrayinformation['expyear'] = $expyear;
        $jwtarrayinformation['cardtype'] = $cardtype;
        $jwtarrayinformation['ccnum'] = $ccnum;
        $jwtarrayinformation['checkoutstate'] = "A";
        $jwtarrayinformation['encryptkey'] = $hexkey;
        $jwtarrayinformation['iv'] = $hexiv;
        jwtupdate($jwtarrayinformation);

        $_SESSION['variable'] = "hi";

        header("location: https://www.swapamc.com/swapproj/checkout/emailotp");
        exit;
    }
}
