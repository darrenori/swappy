<?php
print "<h3>Your Cart</h3>";
session_start();
$selectedcarts = [];
if (isset($_POST["submit"])) {
    unset($_SESSION['cart']);
    foreach ($_POST as $key => $val)
        if ($key !== "submit") {
            array_push($selectedcarts, $key);
        }

    $_SESSION['cart'] = $selectedcarts;
}

if (empty($selectedcarts)) {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $val)
            if ($key !== "submit") {
                array_push($selectedcarts, $val);
            }
    } else {
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=emptycart");
        exit();
    }
}


// print_r("these are your selected carts:");
// var_dump($selectedcarts);
include 'product/viewcart.php';
require_once 'includes/functions.inc.php';
include 'checkoutpage/verification.php';
echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/viewcart'>Back To View Cart</a>";

// showCart($conn);
?>

<html>

<h2>Checkout Form</h2>
<form method="POST" action="/swapproj/checkout/viewshippingaddress">
    <h3>Shipping Information</h3>
    <br><label for="shipping">Select Shipping</label>
    <input type="submit" name="shipping" value="select">
    <?php

    $shippingaddress = viewDefaultShippingAdd($conn);

    
    if (!empty($shippingaddress)) {
        echo "<form>";
        echo "<br><br>";
        echo "Default Shipping Address:";
        echo "<br>";
        echo "Name:" . "&nbsp" . $shippingaddress['user_shipping_name'];
        echo "&nbsp" . "Number:" . "&nbsp" . $shippingaddress["user_shipping_number"];
        echo "&nbsp" . "Email:" . "&nbsp" . $shippingaddress["user_shipping_email"];
        echo "&nbsp" . "Address:" . "&nbsp" . $shippingaddress["user_shipping_address"];
        echo "&nbsp" . "Zip:" . "&nbsp" . $shippingaddress["user_shipping_postalcode"];
        echo "&nbsp" . "Unit:" . "&nbsp" . $shippingaddress["user_shipping_unitnumber"];
        echo "</form>";

        $_SESSION['defaultshippingid'] = $shippingaddress['user_shipping_id'];
        // var_dump($_SESSION);
        //changes the shipping address variable to 1 (signifies that default address exists)
        // $shippingaddress = $shippingaddress['user_shipping_default'];
        $_SESSION['shippingaddress'] = $shippingaddress['user_shipping_default'];
        echo "<br>";
    } else {
        $_SESSION['shippingaddress'] = 0;
        echo "<br>";
        echo "No default shipping address";
    }
    $sa = $_SESSION['shippingaddress'];

    ?>
</form>

<form action="/swapproj/checkoutinc" method="POST">
    <!-- Payment -->
    <h3>Payment</h3>
    <label>Accepted Cards</label>
    <br>
    <i class="fa fa-cc-visa" style="color:navy;"></i>
    <i class="fa fa-cc-amex" style="color:blue;"></i>
    <i class="fa fa-cc-mastercard" style="color:red;"></i>
    <i class="fa fa-cc-discover" style="color:orange;"></i>
    <br>
    <br><label for="cname">Name on Card</label>
    <br><input type="text" id="cname" name="cname" placeholder="John More Doe">
    <br><label for="ccnum">Credit card number</label>
    <br><input type="text" pattern="\d*" maxlength="16" id="ccnum" name="ccnum" placeholder="1111222233334444"  class="creditcardnumber">
    <div class="ccvalue"></div>
    <br><label for="expmonth">Exp Month</label>
    <br><input type="text" pattern="\d*" maxlength="2" id="expmonth" name="expmonth" placeholder="12" min="1" max="12">
    <br><label for="expyear">Exp Year</label>
    <br><input type="text" pattern="\d*" maxlength="4" id="expyear" name="expyear" placeholder="2018">
    <br> <label for="cvc">CVV</label>
    <br><input type="text" pattern="\d*" id="cvc" name="cvc" placeholder="352" maxlength="3">
    <br>
    <input type="submit" name="submit" value="Pay" class="btn">


</form>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type='text/javascript'>
    

    function creditCardTypeAction() {
        $('.creditcardnumber').on('keyup', function() {
            if ($(this).val().length >= 4) {
                cardType = creditCardTypeFromNumber($(this).val());
            }
        });
    }

    creditCardTypeAction();

    

    function creditCardTypeFromNumber(ccnum) {

        // first, sanitize the number by removing all non-digit characters.
        ccnum = ccnum.replace(/[^\d]/g, '');
        // MasterCard
        if (ccnum.match(/^5[1-5][0-9]{14}$/)) {
            $('.cardsacceptedicon').removeClass('active');
            $('.cardsacceptedicon.mastercard').addClass('active');
            
            $('div.ccvalue').html('MasterCard');
            return 'MasterCard';

            // Visa
        } else if (ccnum.match(/^4[0-9]{12}(?:[0-9]{3})?$/)) {
            $('.cardsacceptedicon').removeClass('active');
            $('.cardsacceptedicon.visa').addClass('active');

            $('div.ccvalue').html('Visa');
            return 'Visa';

            /* AMEX */
        } else if (ccnum.match(/^3[47][0-9]{13}$/)) {
            $('.cardsacceptedicon').removeClass('active');
            $('.cardsacceptedicon.amex').addClass('active');

            $('div.ccvalue').html('AMEX');
            return 'AMEX';

            // Discover
        } else if (ccnum.match(/^6(?:011|5[0-9]{2})[0-9]{12}$/)) {
            $('.cardsacceptedicon').removeClass('active');
            $('.cardsacceptedicon.discover').addClass('active');

            $('div.ccvalue').html('Discover');
            return 'Discover';

        }
        $('div.ccvalue').html('UNKNOWN');
        return 'UNKNOWN';
    }
</script>
<html>

<?php
// print_r("these are your selected carts:");
// var_dump($selectedcarts);
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptycart") {
        echo "<p>Add Items in Cart!</p>";
    } else if ($_GET["error"] == "emptydefaultshipping") {
        echo "<p>Add Default Shipping Address!</p>";
    } else if ($_GET["error"] == "paymentemptyinput") {
        echo "<p>Fill in Credit Card fields!</p>";
        exit();
    }  else if ($_GET["error"] == "invalidcardtype") {
        echo "<p>Invalid card number</p>";
        exit();
    } else if ($_GET["error"] == "paymentbadnumb") {
        echo "<p>Invalid card number</p>";
        exit();
    } else if ($_GET["error"] == "invalidexpmonth") {
        echo "<p>Invalid card month</p>";
        exit();
    } else if ($_GET["error"] == "invalidexpyear") {
        echo "<p>Invalid card year</p>";
        exit();
    } else if ($_GET["error"] == "invalidcvc") {
        echo "<p>Invalid CVC</p>";
        exit();
    } else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong, try again!</p>";
    } else if ($_GET["error"] == "none") {
        echo "<p>Payment Success</p>";
        header("location: https://www.swapamc.com/swapproj/checkout/success");
    }
}

?>