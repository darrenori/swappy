<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';

session_start();
session_regenerate_id();

$jwtarray = jwtdecrypt();
$jwtarrayinformation = $jwtarray['array'];
$cname = $jwtarrayinformation['cname'];
$expmonth = $jwtarrayinformation['expmonth'];
$expyear = $jwtarrayinformation['expyear'];
$cardtype = $jwtarrayinformation['cardtype'];
$ccnum = $jwtarrayinformation['ccnum'];
$encryptkey = $jwtarrayinformation['encryptkey'];
$iv =  $jwtarrayinformation['iv'];

$userinput = htmlspecialchars($_POST['emailotp']);
$useremailotp = $jwtarrayinformation["emailotp"];

if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page




    //resend email otp
    if (isset($_POST["resend"])) {
        require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/checkoutpage/sendemailotp.php';
        $vc = new VerificationCode($jwtarrayinformation['useremail']);
        $vc->sendMail();
        echo "resending OTP";
        header("location: https://www.swapamc.com/swapproj/checkout/emailotp?resend=resend");
        exit();
    }

    // 
    if (isset($_POST["submit"]) &&  $jwtarrayinformation['checkoutstate'] == "A") {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';


        
        ////Checks if inputs are not identical




        $currentrequestime = $_SERVER["REQUEST_TIME"];
        if ($currentrequestime - $jwtarrayinformation["emailotptime"] > 100) {
            echo "session has expired";
            echo "Please Click the resend button";
            header("location: https://www.swapamc.com/swapproj/checkout/emailotp?error=expiredotp");
            exit();
        } else {

            // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
            if ($useremailotp != $userinput) {
                echo "badotp";
                jwtupdate($jwtarrayinformation); // updates the JWT session without 'emailotp'
                header("location: https://www.swapamc.com/swapproj/checkout/emailotp?error=badotp");
                exit();
            } else {
                echo "goodotp";
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
