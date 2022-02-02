<?php
if (isset($_POST["submit"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/checkoutpage/verification.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


    // session_start();
    session_regenerate_id();
    $jwtarray = jwtdecrypt();
    $jwtarrayinformation = $jwtarray['array'];





    


    $cname = htmlspecialchars($_POST["cname"]);
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
        exit();
    }
    if (emptyDefaultShipping($sa) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=emptydefaultshipping");
        exit();
    }
    if (emptyInputPayment($cname, $number, $expmonth, $expyear, $cvc) !== false) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=paymentemptyinput");
        exit();
    }
    if (validatecard($number) === false) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidcardtype");
        exit();
    }
    if (luhn_check($number) === false) {
        echo "<p>Credit Card Number Invalid</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=paymentbadnumb");
        exit();
    }
    if (invalidExpMonth($expmonth) !== false) {
        echo "<p>Invalid Exp Month</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidexpmonth");
        exit();
    }
    if (invalidExpYear($expyear) !== false) {
        echo "<p>Invalid Exp Year</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidexpyear");
        exit();
    }
    if (invalidCVC($cvc) !== false) {
        echo "<p>Invalid CVC</p>";
        header("location: https://www.swapamc.com/swapproj/checkout?error=invalidcvc");
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
