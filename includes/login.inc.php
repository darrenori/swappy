<?php

if (isset($_POST["submit"])) {


    $username = $_POST["uid"];
    echo $username;
    $pwd = $_POST["pwd"];
    echo $pwd;
    $captchaa = $_POST['g-recaptcha-response'];
    echo $captchaa;
    $captchaa = $_POST['g-recaptcha-response'];
    echo $captchaa;
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once 'index.php';



    ////Checks CAPTCHA/////
    $loginempty = emptyInputLogin($username, $pwd);
    echo $loginempty;
    $failedCaptcha = failedCaptcha($captchaa);
    echo $failedCaptcha;
    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors
    if ($loginempty !== false) {
        header("location: ../swapproj/login?error=emptyinput");
        exit();
    } else {
        echo "got problem uh";
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


    loginUser($conn, $username, $pwd);
} else {
    header("location: ../swapproj/login");
    exit();
}
