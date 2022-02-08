<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';

session_start();
session_regenerate_id();

### CSRF ####
if (validateCSRF() == false) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


    if ($actual_link == "http://www.swapamc.com/swapproj/campus?error=badcsrf") {
        echo 'bad csrf';
        //dont redirect if on the same page

    } else {
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
}
### CSRF ####


$jwtarray = jwtdecrypt();
$jwtarrayinformation = $jwtarray['array'];
$cname = $jwtarrayinformation['cname'];
$expmonth = $jwtarrayinformation['expmonth'];
$expyear = $jwtarrayinformation['expyear'];
$cardtype = $jwtarrayinformation['cardtype'];
$ccnum = $jwtarrayinformation['ccnum'];
$encryptkey = $jwtarrayinformation['encryptkey'];
$iv =  $jwtarrayinformation['iv'];



if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page




    //resend email otp
    if (isset($_POST["resend"])) {
        require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/checkoutpage/sendemailotp.php';
        $vc = new VerificationCode($jwtarrayinformation['useremail']);
        $vc->sendMail();
        header("location: https://www.swapamc.com/swapproj/checkout/emailotp?resend=resend");
        exit();
    }

    // 
    if (isset($_POST["submit"]) &&  $jwtarrayinformation['checkoutstate'] == "A") {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';

        $whitelist = ['emailotp', 'reset', 'submit'];
        $_POST = XSSPrevention($_POST, $whitelist);
        // declares variable length in chars for each item. 
        $maxlengtharray['emailotp'] = 6;

        //removes any nondigit characters.
        $_POST['emailotp'] = preg_replace('/[^\d]/', '', $_POST['emailotp']);
        // bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
        $bufferflag = empty(checkLength($_POST, $maxlengtharray));
        $emptyflag = empty(checkEmpty($_POST, ['emailotp']));
        $userinput = (int)($_POST['emailotp']);
        $useremailotp = $jwtarrayinformation["emailotp"];


        if (!($bufferflag && $emptyflag)) {
            header("location: https://www.swapamc.com/swapproj/checkout/emailotp?error=invalidotp");
            exit;
        }


        ////Checks if inputs are not identical




        $currentrequestime = $_SERVER["REQUEST_TIME"];
        if ($currentrequestime - $jwtarrayinformation["emailotptime"] > 100) {
            header("location: https://www.swapamc.com/swapproj/checkout/emailotp?error=expiredotp");
            exit();
        } else {

            // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
            if ($useremailotp !== $userinput) {
                jwtupdate($jwtarrayinformation); // updates the JWT session without 'emailotp'
                header("location: https://www.swapamc.com/swapproj/checkout/emailotp?error=badotp");
                exit();
            } else {
                //B is success
                reduceInventory($conn);
                addCreditCard($conn, $cname, $expmonth, $expyear, $cardtype, $ccnum, $encryptkey, $iv);
                cartpurchased($conn);
                addIntoPastPurchase($conn);

                $jwtarrayinformation['checkoutstate'] = "B";
                //removes 'emailotp' from the array
                unset($jwtarrayinformation["emailotp"]);
                jwtupdate($jwtarrayinformation); // updates the JWT session without 'emailotp'


                // echo 'successfully added';
                unset($_SESSION['cart']);
                header("location: https://www.swapamc.com/swapproj/checkout/success");
                exit();
            }
        }
    } else {
        header("location: https://www.swapamc.com/swapproj/checkout");
        exit();
    }
} else {
    header("location: https://www.swapamc.com/swapproj/checkout");
    exit();
}
