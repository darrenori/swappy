<?php
session_start();

//resend email otp
if (isset($_POST["resend"])) {
    require 'phpmailer/verification2fa.php';
    require 'functions.inc.php';
    $vc = new VerificationCode($_SESSION['useremail']);
    $vc->sendMail();
    echo "resending OTP";
    header("location: ../swapproj/emailverification?resend=resend");
    exit();
}

if (isset($_POST["submit"]) &&  $_SESSION['loginstate'] === "A") {

    // gets the username password and captcha input
    $userinput = (int)$_POST["emailotp"];
    $useremailotp = $_SESSION["emailotp"];
    // echo "original password". $useremailotp.gettype($useremailotp);
    // echo "user input password". $userinput.gettype($userinput);

    require_once 'functions.inc.php';
    #####the verification2fa.php file is only required if we plan to implement resending of email and code. 
    //there is a phenomenon that when the page is refreshed, a new code is generated into the session storage
    //however an email is not sent, this is interesting and will require more looking into. 
    //this is also a problem because if the user refreshes/fills in a bad otp, they will have no idea what the otp is.
    // require_once 'phpmailer/verification2fa.php';

    ////Checks if inputs are not identical
    $failedverification = pwdMatch($userinput, $useremailotp);
    echo $failedverification;
    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    if ($failedverification !== false) {
        echo "badotp";
        header("location: ../swapproj/emailverification?error=badotp");
        exit();
    } else {
        echo "goodotp";
        $_SESSION['loginstate'] = "B";
        header("location: ../swapproj/googleauthentication");
        exit();
    }

    // // if there are no errors, the user is logged in
    // loginUser($conn, $username, $pwd);

} elseif ($_SESSION['loginstate'] === "B") {
    header("location: ../swapproj/googleauthentication");
    exit();
} elseif ($_SESSION['loginstate'] === "OK") {
    header("location: ../swapproj/campus");
    exit();
} else {
    header("location: ../swapproj/login");
    exit();
}
