<?php
if (isset($_POST["submit"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/checkoutpage/verification.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


    session_start();

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
    $ccnum =  substr ($number, -4);

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
        
        addCreditCard($conn, $cname, $expmonth, $expyear, $cardtype,$ccnum);
        cartpurchased($conn);
        addIntoPastPurchase($conn);
        
        header("location: https://www.swapamc.com/swapproj/checkout/success");
        echo 'successfully added';
        unset($_SESSION['cart']);
        exit();
    }
}



?>