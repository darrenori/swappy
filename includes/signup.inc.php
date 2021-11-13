<?php

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors
    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../swapproj/signup?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../swapproj/signup?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../swapproj/signup?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../swapproj/signup?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($conn, $username, $email) !== false) {
        header("location: ../swapproj/signup?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd);

}
else{
    header("location: ../signup.php");
    exit();
}