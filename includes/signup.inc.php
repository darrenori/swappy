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
    $captcha = $_POST['g-recaptcha-response'];

    require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

    $failedCaptcha = failedCaptcha($captcha);
    // exit;
    $inkey = badInput($_POST);

    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors


    if (emptyInputSignup($firstname, $lastname, $email, $phonenumber, $username, $pwd, $pwdRepeat, $primaryschool, $favouritefood) !== false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=emptyinput");
        exit();
    } else if ($inkey !== false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=" . $inkey);
        exit();
    } else if (invalidUid($username) !== false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=invaliduid");
        exit();
    } else if (invalidEmail($email) !== false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=invalidemail");
        exit();
    } else if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=passwordsdontmatch");
        exit();
    } else if (uidExists($conn, $username, $email) !== false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=usernametaken");
        exit();
    } else if ($failedCaptcha === "empty captcha") {
        header("location: https://www.swapamc.com/swapproj/signup?error=emptycaptcha");
        exit();
    } else if ($failedCaptcha === "bad captcha") {
        header("location: https://www.swapamc.com/swapproj/signup?error=badcaptcha");
        exit();
    } else if ($failedCaptcha === "good captcha") {
        header("location: https://www.swapamc.com/swapproj/signup?error=goodcaptcha");
        exit();
    } elseif(duplicateEmail($conn,$email) == 1) {
        header("location: https://www.swapamc.com/swapproj/signup?error=duplicateemail");
        exit();


    } else {
        createUser($conn, $firstname, $lastname, $email, $username, $pwd, $phonenumber, $primaryschool, $favouritefood);
    }
} else {
    header("location: https://www.swapamc.com/swapproj/signup");
    exit();
}
