<div class='nav-bar'>
    <div class='nav-logo'>
        <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
        
    </div>
    <div class='nav-links' id='nav-links'>
        <i class="fas fa-arrow-circle-left" onclick="closeMenu()" style="color:white"></i>
        <ul>
            <a href="#"><li>HOME</li></a>
            <a href="https://www.swapamc.com/swapproj/faq/"><li>FAQs</li></a>
            <a href="#"><li>PRODUCTS</li></a>
            
            
        </ul>
        <button type="button" class="btn">SIGN UP</button>
    </div>
    <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>
    
</div>

<?php
//show cart
session_start();
// user press submit from view cart
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

include 'product/viewcart.php';
require_once 'includes/functions.inc.php';
include 'checkoutpage/verification.php';

?>

<html>
<div class='container5'>
    <!-- user shipping information box -->
    <div class='header1'>
    <div class='logo'>
    <div class="w3-xlarge"><i class="fa fa-home"></i></div>
    </div>
    <div class='static1'>Delivery Address</div>
    <div class='button-container'>
                <button  type='submit' form='shipping_btn' class='edit-btn'>
                    Edit
                </button>
    </div></div>
    <div class='shipping-information'>
<form class='shipping-information' method="POST" id ='shipping_btn' action="/swapproj/checkout/viewshippingaddress">
    <!-- <h3>Shipping Information</h3> -->
    <!-- <br><label for="shipping">Select Shipping</label> -->
    <?php

    $shippingaddress = viewDefaultShippingAdd($conn);

    
    if (!empty($shippingaddress)) {
        // echo "<form>";
        // echo "</form>";

        $_SESSION['defaultshippingid'] = $shippingaddress['user_shipping_id'];
        // var_dump($_SESSION);
        //changes the shipping address variable to 1 (signifies that default address exists)
        // $shippingaddress = $shippingaddress['user_shipping_default'];
        $_SESSION['shippingaddress'] = $shippingaddress['user_shipping_default'];
       
        echo "
            <div class='shipping-user-info'>" .$shippingaddress['user_shipping_name'] . "&nbsp" . "(+65) " . $shippingaddress["user_shipping_number"];
        echo "</div>";
        echo"
            <div class='shipping-address'>". $shippingaddress["user_shipping_address"] . "&nbsp" . $shippingaddress["user_shipping_postalcode"]
            . "&nbsp" . $shippingaddress["user_shipping_unitnumber"];
        echo"</div>";
        echo "</div>";


    } else {
        $_SESSION['shippingaddress'] = 0;
        
        echo "No default shipping address";
        echo "</div>";
    }
    $sa = $_SESSION['shippingaddress'];
    ?>
</form>

<div class='header1'>
<div class='logo'><div class="w3-xlarge"><i class="fa fa-home"></i></div></div>
<div class='static1'>Payment Method</div>
<div class='button-container'><button class='edit-btn'>Edit</button></div>
</div>
<form class='testing5' action="/swapproj/checkoutinc" method="POST">
    <!-- Payment -->
    <div class='creditcard-icon' style='margin-left:3%'>
    <label style='background-color:white'>Accepted Cards</label>
        <i class="fa fa-cc-visa" style="color:navy;"></i>
        <i class="fa fa-cc-amex" style="color:blue;"></i>
        <i class="fa fa-cc-mastercard" style="color:red;"></i>
        <i class="fa fa-cc-discover" style="color:orange;"></i>
    </div>
    <div class='card-container'>
        <label class='static4' for="ccnum">Credit card number</label>
        <div class='break'></div>
        <input class='credit-input-box' type="text" pattern="\d*" maxlength="16" id="ccnum" name="ccnum" placeholder="1111222233334444"  class="creditcardnumber">
        <div class="ccvalue"></div>
    </div>
    <div class='pairing-box'>
                        <div class='pairing'>
                            <label class='static4' for="expmonth">Exp Month</label>
                            <div class='break2'></div>
                            <input class='expiry-input-box' type="text" pattern="\d*" maxlength="2" id="expmonth" name="expmonth" placeholder="12" min="1" max="12">
                        </div>
                        <div class='pairing'>
                            <label class='static4' for="expyear">Exp Year</label>
                            <div class='break2'></div>
                            <input class='expiry-input-box' type="text" pattern="\d*" maxlength="4" id="expyear" name="expyear" placeholder="2018">
                        </div>
                        <div class='pairing'>
                            <label class='static4' for="cvc">CVV</label>
                            <div class='break2'></div>
                            <input class='expiry-input-box' type="text" pattern="\d*" id="cvc" name="cvc" placeholder="352" maxlength="3">
                        </div>
                        <div class='pairing'>
                            <label class='static4' for="cname">Name on Card</label>
                                <div class='break2'></div>
                            <input  class='expiry-input-box' type="text" id="cname" name="cname" placeholder="John More Doe">
                        </div>
                    </div>
                    <div class='submit-container'>
                        <input class='submit-btn' type="submit" name="submit" value="Pay">
                    </div>
    <!-- <label class='static4' for="cname">Name on Card</label>
    <div class='break2'></div>
    <input  class='expiry-input-box' type="text" id="cname" name="cname" placeholder="John More Doe"> -->

    <!-- <br><label class='static4' for="ccnum">Credit card number</label>
    <div class='break'></div>
    <br><input class='credit-input-box' type="text" pattern="\d*" maxlength="16" id="ccnum" name="ccnum" placeholder="1111222233334444"  class="creditcardnumber"> -->
    

    <div class="ccvalue"></div>
    <!-- <br><label class='static4' for="expmonth">Exp Month</label>
    <div class='break2'></div>
    <br><input class='expiry-input-box' type="text" pattern="\d*" maxlength="2" id="expmonth" name="expmonth" placeholder="12" min="1" max="12"> -->

    <!-- <br><label class='static4' for="expyear">Exp Year</label>
    <div class='break2'></div>
    <br><input class='expiry-input-box' type="text" pattern="\d*" maxlength="4" id="expyear" name="expyear" placeholder="2018"> -->
    <!-- <br> <label class='static4' for="cvc">CVV</label>
    <div class='break2'></div>
    <br><input class='expiry-input-box' type="text" pattern="\d*" id="cvc" name="cvc" placeholder="352" maxlength="3">
    <br> -->
    <!-- <input class='submit-btn' type="submit" name="submit" value="Pay" class="btn"> -->


</form>
</div>
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
echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/viewcart'>Back To View Cart</a>";
?>
<div class="footer">
            <div class="footer-row">
                <div class="firstfooter">
                    <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
                    <h4>NOTHING MUCH. JUST. THE. BEST.</h4>
                    <h5>&#169; 2021 TPAMC Inc.<br>
                        All Rights Reserved.
                    </h5>
                </div>
                <div class="secondfooter">
                    <h1>Nothing much.
                    Just the BEST website
                    <br>
                    for the BEST AMC  
                    </h1>
                    <div class="links">
                        <div class="linkcol">
                            
                            <h3>Reach Us</h3>
                            <a><h4>+65 9123 1923</h4></a>
                            <a href="mailto:tp@tp.com"><h4>tp@tp.com</h4></a>
                            
                        </div>
                        <div class="linkcol">
                            <h3>Make us Famous</h3>
                            <a href="https://www.facebook.com/iu.loen"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/dlwlrma/"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/_iuofficial?lang=en"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.pinterest.com/search/pins/?q=iu&rs=typed&term_meta[]=iu%7Ctyped"><i class="fab fa-pinterest"></i></a>
                            
                            
                        </div>
                        <div class="linkcol">
                            <a href="#"><p>SUBSCRIBE</p></a>
                            <a href="#"><p>OUR TEAM</p></a>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
<style>
<?php include 'checkoutpage/css/checkout.css'; ?>
</style>
<!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"> -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">