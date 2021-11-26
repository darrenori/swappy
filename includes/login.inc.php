<?php
declare(strict_types=1);
// THIS CODE RUNS WHEN LOGIN BUTTON IS CLICKED 


session_start();

if (isset($_POST["submit"])) {

    // gets the username password and captcha input
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $captchaa = $_POST['g-recaptcha-response'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    //imports the verification code class that will be used in login user functions.inc.php
    require_once 'phpmailer/verification2fa.php';


    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors
    ////Checks if inputs are empty, invalid


    $loginempty = emptyInputLogin($username, $pwd);
    $failedCaptcha = failedCaptcha($captchaa);
    if ($loginempty !== false) {
        header("location: ../swapproj/login?error=emptyinput");
        exit();
    } 

    // returns failedcaptcha if failed captcha
    if ($failedCaptcha === "empty captcha") {
        header("location: ../swapproj/login?error=emptycaptcha");
        exit();
    } else if ($failedCaptcha === "bad captcha") {
        header("location: ../swapproj/login?error=badcaptcha");
        exit();
    } else if ($failedCaptcha === "good captcha") {
        header("location: ../swapproj/login?error=goodcaptcha");
        exit();
    }


        //remember me codes
        if(!empty($_POST["remember"]))
        {
            setcookie("user_login",$_POST["uid"],time()+ (10 * 365 * 24 * 60 * 60));
            setcookie("user_pwd",$_POST["pwd"],time()+ (10 * 365 * 24 * 60 * 60));
        }
        else
        {
            if(isset($_COOKIE["user_login"]))
            {
                setcookie("user_login","");
            }
            if(isset($_COOKIE["user_pwd"]))
            {
                setcookie("user_pwd","");
            }
        }
        //end of remember me codes
    


    // if there are no errors, the user is logged in
    loginUser($conn, $username, $pwd);
} else {
    header("location: ../swapproj/login");
    exit();
}
