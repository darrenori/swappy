<?php

if (isset($_POST["submit"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $primaryschool = $_POST["primaryschool"];
    $favouritefood = $_POST["favouritefood"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors
    if (emptyInputSignup($firstname, $email, $username, $pwd, $pwdRepeat) !== false) {
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

    createUser($conn, $firstname, $lastname, $email, $username, $pwd, $phonenumber, $primaryschool, $favouritefood);

}
else{
    header("location: ../swapproj/signup");
    exit();
}