<?php

if (isset($_POST['submit'])) {

    require_once 'googleauth/vendor/autoload.php';

    session_start();
    $secret = $_SESSION['usersecret'];
    $code =$_POST['googleauthotp'];
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();


    echo $secret;
    echo 'Current Code is: ';
    echo $g->getCode($secret);
    
    echo "\n";
    
    echo "Check if $code is valid: ";
    
    if ($g->checkCode($secret, $code)) {
        echo "YES \n";
    } else {
        echo "NO \n";
    }


}