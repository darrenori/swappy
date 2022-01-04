<?php
if (isset($_POST["addAdr"])) {
    require_once 'checkoutpage/verification.php';
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $name = htmlspecialchars($_POST["name"]);
    $phonenumber = $_POST["phone"];
    $email = $_POST["email"];
    $address = htmlspecialchars($_POST["address"]);
    $zip = $_POST["zip"];
    $unit = htmlspecialchars($_POST["unit"]);


    if (emptyInputShippingAdd($name, $email, $phonenumber, $address, $unit, $zip) !== false) {
        header("location: ../swapproj/checkout/addshippingaddress?error=shippingaddressemptyinput");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../swapproj/checkout/addshippingaddress?error=invalidemail");
        exit();
    }
    if (invalidPostalCode($zip) !== false) {
        echo "<p>Invalid PostalCode</p>";
        header("location: ../swapproj/checkout/addshippingaddress?error=invalidpostalcode");
        exit();
    } else {
        echo "<p>Successfully Add Shipping Address</p>";
        addShippingAdd($conn, $name, $phonenumber, $email, $address, $zip, $unit);
        header("location: https://www.swapamc.com/swapproj/checkout");
        exit();
    }
} else {
    header("location: ../swapproj/checkout");
    exit();
}
