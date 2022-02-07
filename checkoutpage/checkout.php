<html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</html>


<?php
    //show cart
    // ob_start();
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/navbar.php';
    if (!isset($_SESSION)) {
        session_start();
    }
    session_regenerate_id();
    // user press submit from view cart
    $selectedcarts = [];
?>
<style>
    <?php
        ob_start();
        
        include 'checkoutpage/css/checkout.css';

    ?>
    
    
</style>



    <form method="POST" action="/swapproj/checkout/viewshippingaddress" class="shippinginfo">
    <div style="float:left; clear:both;">
    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="32.5" viewBox="0 0 64 64">
        <g id="Group_415" data-name="Group 415" transform="translate(-18542 100)">
            <rect id="Rectangle_490" data-name="Rectangle 490" width="64" height="64" transform="translate(18542 -100)" fill="#8d1d25"/>
            <path id="iconmonstr-home-6" d="M21.848,13.485v10.4H15.606V17.646H9.364v6.242H3.121v-10.4H0L12.485,1,24.97,13.485Zm-1.04-6.146V2.04H17.687V4.218Z" transform="translate(18562 -80)" fill="#fff"/>
        </g>
        </svg>
    </div>
        <h2 style=" background-color: white; color: #8D1D25; border-bottom:2px solid black; padding-bottom:4px; font-weight:300; ">
        &nbsp;Delivery Address
        <input type="submit" name="shipping" value="Select/Edit Address" style=" cursor:pointer; background-color: #8D1D25; border-radius:5px; font-weight:bold; border:#272727; height:30px; width:150px; ">        
        </h2>
        <?php

        $shippingaddress = viewDefaultShippingAdd($conn);


        if (!empty($shippingaddress)) {
            echo "<form method='POST'><br>";
            echo "<span class='span'>". $shippingaddress['user_shipping_name'];
            echo "&nbsp" . "(+65)" . "&nbsp" . $shippingaddress["user_shipping_number"] ."</span>";
            echo "&nbsp&nbsp&nbsp&nbsp&nbsp" . $shippingaddress["user_shipping_address"];
            echo ",&nbsp#" . $shippingaddress["user_shipping_unitnumber"];
            echo "&nbsp&nbsp&nbsp&nbsp&nbsp". "<span class=default>Default</span>";
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

<div class="cart">
<div style="float:left; clear:both;">
<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 64 64">
  <g id="Group_416" data-name="Group 416" transform="translate(-18661 100)">
    <rect id="Rectangle_491" data-name="Rectangle 491" width="64" height="64" transform="translate(18661 -100)" fill="#8d1d25"/>
    <path id="iconmonstr-shopping-bag-7" d="M7.055,32.078,3,29.209v-19.2l4.055,1.837ZM9.759,12V32.443L27.332,29.8V9.462ZM17.82,1.352a5.747,5.747,0,0,0-5.356,5.767V9.394a.676.676,0,0,0,1.352,0V7.121A4.4,4.4,0,0,1,17.82,2.7a2.585,2.585,0,0,1,1.871.762A3.249,3.249,0,0,1,20.573,5.8V8.162a.675.675,0,0,0,1.349,0l0-2.364A4.181,4.181,0,0,0,17.82,1.352Zm-8.638,8.1a.678.678,0,0,0,.577-.669V5.769a4.4,4.4,0,0,1,4.005-4.418l.219.02A6.727,6.727,0,0,1,15.589.449,3.981,3.981,0,0,0,13.764,0,5.748,5.748,0,0,0,8.408,5.767V8.788a.675.675,0,0,0,.773.668Z" transform="translate(18677.832 -84.221)" fill="#fff"/>
  </g>
</svg>
    </div>
<h2 style=" background-color: white; color: #8D1D25; border-bottom:2px solid black; font-weight:300; margin-top:0.8vh;"> &nbsp;Bag</h2><br>
<?php


if (isset($_POST["submit"])) {
    unset($_SESSION['cart']); // unset the session for new updated values

    foreach ($_POST as $key => $value) {
        // hashes all values into htmlspecialchars versions
        $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);

        if ((!is_numeric($key) || strlen((string)$key) !== 8) && $key !=='csrf') {//only allows numeric keys with strings of length eight
            // removes any keys that are not 
            unset($_POST[$key]);
        }
    }
    //at this time all values have been cleaned to contain the IDs of selected carts
    foreach ($_POST as $key => $val)
    if (!in_array($key,['csrf','csrfspecial'])) {
        array_push($selectedcarts, $key);
    }

    $_SESSION['cart'] = $selectedcarts;
}elseif (isset($_POST)) {//remove all variables if any, because we don't want any items passed unnecessarily
    foreach ($_POST as $key => $value) {
            unset($_POST[$key]);
        }
}

if (empty($selectedcarts)) {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $val)
            if ($key !== "csrf") {
                array_push($selectedcarts, $val);
            }
    } else {

        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=emptycart");
        exit();
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
### CSRF ####
$csrfpass=false;
if (isset($_SESSION['csrfspecial'])) {
    if ($_SESSION['csrfspecial']==$_SESSION['csrf']) {
        $csrfpass=true;
    }
 }
//  var_dump($_SESSION);
//  var_dump($_POST);
//  var_dump($u=validateCSRF());exit;
// if(validateCSRF()==false && $csrfpass===false){
//     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
//     if($actual_link=="http://www.swapamc.com/swapproj/allproducts/product/viewcart?error=badcsrf"){
//         echo 'bad csrf';
//         //dont redirect if on the same page
  
//     } else {
//         header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=badcsrf");
//         exit;
//     }
// }

///commented out because this page is too diverse to contain csrf effeciently.
include $_SERVER['DOCUMENT_ROOT'] . '/swapproj/checkoutpage/verification.php';
include $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/viewcart.php';
$csrf = generateCSRF();

### CSRF ####
?>
</div>
<br>
<div class="payment">
<div style="float:left; clear:both;">
<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 64 64">
  <g id="Group_417" data-name="Group 417" transform="translate(-18760 100)">
    <rect id="Rectangle_492" data-name="Rectangle 492" width="64" height="64" transform="translate(18760 -100)" fill="#8d1d25"/>
    <path id="iconmonstr-credit-card-6" d="M34.086,4H3.1A3.1,3.1,0,0,0,0,7.1V25.691a3.1,3.1,0,0,0,3.1,3.1H34.086a3.1,3.1,0,0,0,3.1-3.1V7.1A3.1,3.1,0,0,0,34.086,4Zm0,20.916a.775.775,0,0,1-.775.775H3.873a.775.775,0,0,1-.775-.775V14.845H34.086Zm0-14.719H3.1V7.873A.775.775,0,0,1,3.873,7.1H33.311a.775.775,0,0,1,.775.775Zm-13.944,9.3H6.2V17.944H20.142Zm-4.648,3.1H6.2V21.043h9.3Zm15.494-3.1H26.339V17.944h4.648Z" transform="translate(18773.408 -84.395)" fill="#fff"/>
  </g>
</svg>
    </div>
<h2 style="background-color: white; color: #8D1D25; border-bottom:2px solid black; font-weight:300; margin-top:0.8vh;">&nbsp;Payment</h2>
    <form action="/swapproj/checkoutinc" method="POST" style="background-color: white; color: black;">
        <!-- Payment -->
        <label style="background-color: white; color: black;">Accepted Cards</label>
        <br>
        <!-- <i class="fa fa-cc-visa" ></i>
        <i class="fa fa-cc-amex" ></i>
        <i class="fa fa-cc-mastercard" ></i>
        <i class="fa fa-cc-discover" ></i> -->

        <i class="fab fa-cc-visa" style="font-size:1.55em;"></i>
        <i class="fab fa-cc-amex" style="font-size:1.55em;"></i>
        <i class="fab fa-cc-mastercard" style="font-size:1.55em;"></i>
        <i class="fab fa-cc-discover" style="font-size:1.55em;"></i>
        

        <br><label style="background-color: white; color: black;" for="cname">Name on Card</label>
        <br><input style="background-color: white; color: black; width:50%;" type="text" id="cname" name="cname" placeholder="John More Doe">
        <br><label style="background-color: white; color: black;" for="ccnum">Credit card number</label>
        <br><input style="background-color: white; color: black; width:50%;" type="text" pattern="\d*" maxlength="16" id="ccnum" name="ccnum" placeholder="1111222233334444" class="creditcardnumber">
        <div class="ccvalue"></div>
        <label style="background-color: white; color: black;" for="expmonth">Exp Month</label>
        <br><input style="background-color: white; color: black;" type="text" pattern="\d*" maxlength="2" id="expmonth" name="expmonth" placeholder="12" min="1" max="12">
        <br><label style="background-color: white; color: black;" for="expyear">Exp Year</label>
        <br><input style="background-color: white; color: black;" type="text" pattern="\d*" maxlength="4" id="expyear" name="expyear" placeholder="2018">
        <br> <label style="background-color: white; color: black;" for="cvc">CVV</label>
        <br><input style="background-color: white; color: black;"type="text" pattern="\d*" id="cvc" name="cvc" placeholder="352" maxlength="3">
        <br><br>
        <input type="submit" name="submit" value="Complete Payment" class="btn">
        <input type='hidden' name='csrf' value='<?php echo $csrf?>'>

    </form>
</div>


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
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
    } else if ($_GET["error"] == "invalidcardtype") {
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
    } else if ($_GET["error"] == "invalidstate") {
        echo "<p>Invalid State</p>";
    }
}
?>


<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>

</head>

</html>
<?php
ob_flush();
?>