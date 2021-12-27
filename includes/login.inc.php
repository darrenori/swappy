<?php

declare(strict_types=1);
// THIS CODE RUNS WHEN LOGIN BUTTON IS CLICKED 



if (isset($_POST["submit"])) {
    foreach ($_POST as $key => $val)
    echo $key . ":    " . $val . "<br/>";


    // gets the username password and captcha input
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $captchaa = $_POST['g-recaptcha-response'];
    // echo "here are your items".$username.$pwd.$captchaa;

    


    // foreach ($_SESSION as $key => $val)
    //     echo $key . " " . $val . "<br/>";

   

    require_once 'dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
    //imports the verification code class that will be used in login user functions.inc.php


    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors
    ////Checks if inputs are empty, invalid


    $loginempty = emptyInputLogin($username, $pwd);
    $failedCaptcha = failedCaptcha($captchaa);
   if ($loginempty !== false) {
        header("location: https://www.swapamc.com/swapproj/login?error=emptyinput");
        exit();
    }
    // returns failedcaptcha if failed captcha
    //commented out cos no wifi
    // if ($failedCaptcha === "empty captcha") {
    //     header("location: https://www.swapamc.com/swapproj/login?error=emptycaptcha");
    //     exit();
    // } else if ($failedCaptcha === "bad captcha") {
    //     header("location: https://www.swapamc.com/swapproj/login?error=badcaptcha");
    //     exit();
    // } else if ($failedCaptcha === "good captcha") {
    //     header("location: https://www.swapamc.com/swapproj/login?error=goodcaptcha");
    //     exit();
    // }


    //remember me codes
    // if(empty($_POST["remember"]))
    // {
    //     // setcookie("user_login",$_POST["uid"],time()+ (10 * 365 * 24 * 60 * 60));
    //     // setcookie("user_pwd",$_POST["pwd"],time()+ (10 * 365 * 24 * 60 * 60));
    // }
    // else
    // {
    //     if(isset($_COOKIE["user_login"]))
    //     {
    //         //setcookie("user_login","");
    //     }

    // }
    // //end of remember me codes
    $remember = false;
    if (isset($_POST["remember"])) { //if checked
        if ($_POST['remember'] == true) {

            echo "checked fr sure";
            $remember = true;
        } else {
            $remember = false;
        }
    }



    // if there are no errors, the user is logged in
    loginUser($conn, $username, $pwd,$remember);


    } else {
        header("location: https://www.swapamc.com/swapproj/login?error=notsubmit");
        exit();
}
