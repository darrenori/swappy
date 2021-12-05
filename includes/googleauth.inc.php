<?php
session_start();

if (isset($_POST['submit'])) {
    echo "<h3> PHP List All Session Variables</h3>";
    foreach ($_SESSION as $key => $val)
        echo $key . " " . $val . "<br/>";

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
        if ($_SESSION['loginstate'] === "B") {
            $_SESSION['loginstate'] = "OK";
            header("location: ../swapproj/campus");
            exit();
        } elseif ($_SESSION['loginstate'] === "Z") {
            echo "You have successfully created an account.";
            unset($_SESSION['loginstate']);
            header("location: ../swapproj/login");
            exit();
        }
    } else {
        header("location: ../swapproj/googleauthentication?error=badotp");
        exit();
    }
}
