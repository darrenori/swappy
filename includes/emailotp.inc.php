<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

// var_dump($_POST['csrf']);
// var_dump($_SESSION['csrf']); exit;

### CSRF ####
if(validateCSRF()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/emailverification?error=badcsrf"){
        echo 'bad csrf';
        //dont redirect if on the same page
  
    } else {
        header("location: https://www.swapamc.com/swapproj/emailverification?error=badcsrf");
        exit;
    }
}
### CSRF ####
// removes any other POST names and does html specialchars
$whitelist =['resend','submit','emailotp','csrf'];
$_POST = XSSPrevention($_POST, $whitelist);

// declares variable length in chars for each item. 
$maxlengtharray['resend'] = 0;
$maxlengtharray['submit'] = 0;
$maxlengtharray['csrf'] = 32;
$maxlengtharray['emailotp'] = 6;

// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
$emptyflag = empty(checkEmpty($_POST, ['csrf']));
// var_dump($bufferflag);
// var_dump($emptyflag);
// var_dump($_POST);exit;
if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/emailverification?error=badotp");
    exit();
}



$jwtarray = jwtdecrypt();
if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];

    //resend email otp
    if (isset($_POST["resend"])) {
        require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/phpmailer/verification2fa.php';
        $vc = new VerificationCode($jwtarrayinformation['useremail']);
        $vc->sendMail();
        echo "resending OTP";
        header("location: https://www.swapamc.com/swapproj/emailverification?resend=resend");
        exit();
    }

    if (isset($_POST["submit"]) &&  $jwtarrayinformation['loginstate'] === "A") {

        // gets the username password and captcha input
        $userinput = (int)$_POST["emailotp"];
        $useremailotp = $jwtarrayinformation["emailotp"];
        if (gettype($useremailotp) !== "integer") {
            $useremailotp = (int)$useremailotp;
        }

        ////Checks if inputs are not identical
        $failedverification = pwdMatch($userinput, $useremailotp);
        // var_dump( $failedverification);exit;
        $currentrequestime = $_SERVER["REQUEST_TIME"];
        if ($currentrequestime - $jwtarrayinformation["emailotptime"] > 100) {
            echo "session has expired";
            echo "Please Click the resend button";
            header("location: https://www.swapamc.com/swapproj/emailverification?error=expiredotp");
            exit();
        } else {
            // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
            if ($failedverification !== false) {
                jwtupdate($jwtarrayinformation); // updates the JWT session without 'emailotp'
                header("location: https://www.swapamc.com/swapproj/emailverification?error=badotp");
                exit();
            } else {
                $jwtarrayinformation['loginstate'] = "B";
                //removes 'emailotp' from the array
                unset($jwtarrayinformation["emailotp"]);
                // echo ("this is jwtarrayinfo");
                // echo "<p><br><br>";
                // var_dump($jwtarrayinformation);
                // echo "</p><br><br>";

                jwtupdate($jwtarrayinformation); // updates the JWT session without 'emailotp'

                // $jwtarray = jwtdecrypt();
                // echo "<p>";
                // var_dump($jwtarray);
                // echo "</p>";

                header("location: https://www.swapamc.com/swapproj/googleauthentication");
                exit();
            }
        }
    } elseif ($jwtarrayinformation['loginstate'] === "B") {
        header("location: https://www.swapamc.com/swapproj/googleauthentication");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "OK" and isset($jwtarrayinformation['username'])) {
        header("location: https://www.swapamc.com/swapproj/campus");
        exit();
    } else {
        header("location: https://www.swapamc.com/swapproj/login");
        exit();
    }
} else {

    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}
