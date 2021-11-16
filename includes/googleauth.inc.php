<?php

if (isset($_POST['submit'])) {

    require_once 'googleauth/vendor/autoload.php';

    session_start();
    $secret = $_SESSION['usersecret'];
    $code =$_POST['googleauthotp'];
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

}