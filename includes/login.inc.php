<?php

declare(strict_types=1);
// THIS CODE RUNS WHEN LOGIN BUTTON IS CLICKED 
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
//imports the verification code class that will be used in login user functions.inc.php



if (isset($_POST["submit"])) {

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


    $whitelist = ['uid', 'pwd', 'g-recaptcha-response', 'remember'];
    ### XSS DONE
    $_POST = XSSPrevention($_POST, $whitelist);
    $_POST = escapeString($conn, $_POST);


    $maxlengtharray['uid'] = 60;
    $maxlengtharray['pwd'] = 60;
    $maxlengtharray['g-recaptcha-response'] = 500;
    $maxlengtharray['remember'] = 3;
    
    // gets the username password and captcha input
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $captchaa = $_POST['g-recaptcha-response'];
    if (isset($_POST['remember'])) {
    $remember =  $_POST['remember'];
    }


        // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
        // the ?error=emptyinput will be used later to identify errors
        ////Checks if inputs are empty, invalid



    $loginempty = emptyInputLogin($username, $pwd);
    $failedCaptcha = failedCaptcha($captchaa);
    if ($loginempty !== false) {
        header("location: https://www.swapamc.com/swapproj/login?error=emptyinput");
        exit();
    } elseif (bufferOverflow([$username], 200) === true) {
        header("location: https://www.swapamc.com/swapproj/login?error=longinputu");
        exit();
    } elseif (bufferOverflow([$pwd], 60) === true) {
        header("location: https://www.swapamc.com/swapproj/login?error=longinputp");
        exit();
    } elseif ((invalidUid($username) && invalidEmail($username))) {
        header("location: https://www.swapamc.com/swapproj/login?error=baduser");
        exit();
    }
    // returns failedcaptcha if failed captcha
    //commented out cos no wifi
    if ($failedCaptcha === "empty captcha") {
        header("location: https://www.swapamc.com/swapproj/login?error=emptycaptcha");
        exit();
    } else if ($failedCaptcha === "bad captcha") {
        header("location: https://www.swapamc.com/swapproj/login?error=badcaptcha");
        exit();
    } else if ($failedCaptcha === "good captcha") {
        header("location: https://www.swapamc.com/swapproj/login?error=goodcaptcha");
        exit();
    }


    $remember = false;
    if (isset($_POST["remember"])) { //if checked
        if ($_POST['remember'] == true) {
            if (bufferOverflow([$_POST['remember']], 2) === true) {
                header("location: https://www.swapamc.com/swapproj/login?error=longinputr");
                exit();
            }

            echo "checked fr sure";
            $remember = true;
        } else {
            $remember = false;
        }
    }


    // if there are no errors, the user is logged in
    loginUser($conn, $username, $pwd, $remember);
} else {
    header("location: https://www.swapamc.com/swapproj/login?error=notsubmit");
    exit();
}
