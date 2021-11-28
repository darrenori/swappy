<?php
session_start();

if (isset($_POST['submit'])) {
    require_once 'googleauth/vendor/autoload.php';

    $secret = $_SESSION['usersecret'];
    $code = $_POST['googleauthotp'];
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

    echo $secret;
    echo 'Current Code is: ';
    echo $g->getCode($secret);

    echo "\n";

    echo "Check if $code is valid: ";

    if ($g->checkCode($secret, $code)) {
        $_SESSION['loginstate'] = "OK";
        header("location: ../swapproj/campus");
        exit();
    } else {
        header("location: ../swapproj/googleauthentication?error=badotp");
        exit();
    }
}
