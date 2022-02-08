<?php


if (isset($_POST["submit"])) {




    require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


    ### CSRF ####
    if (validateCSRF() == false) {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


        if ($actual_link == "http://www.swapamc.com/swapproj/campus?error=badcsrf") {
            echo 'bad csrf';
            //dont redirect if on the same page

        } else {
            header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
            exit;
        }
    }
    ### CSRF ####

    $whitelist = ['firstname', 'lastname', 'email', 'phonenumber', 'uid', 'pwd', 'pwdrepeat', 'primaryschool', 'favouritefood', 'g-recaptcha-response', 'error'];
    $_POST = XSSPrevention($_POST, $whitelist);
    // runs all variables thru sqlescape string
    $_POST = escapeString($conn, $_POST);

    // declares variable length in chars for each item. 
    $maxlengtharray['uid'] = 60;
    $maxlengtharray['pwd'] = 60;
    $maxlengtharray['pwdrepeat'] = 60;
    $maxlengtharray['firstname'] = 60;
    $maxlengtharray['lastname'] = 60;
    $maxlengtharray['email'] = 200; // number should be 8 chars long only (SQL allows 45)
    $maxlengtharray['phonenumber'] = 11; // Inactive is 8 chars long
    $maxlengtharray['primaryschool'] = 45; //1,2,3,4, or 5
    $maxlengtharray['favouritefood'] = 45;
    $maxlengtharray['g-recaptcha-response'] = 50000;

    // bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
    $bufferflag = empty(checkLength($_POST, $maxlengtharray));
    $emptyflag = empty(checkEmpty($_POST, ['firstname', 'lastname', 'email', 'phonenumber', 'uid', 'pwd', 'pwdrepeat', 'primaryschool', 'favouritefood', 'g-recaptcha-response']));

    // phoneflag will return false (undesired) if the phone number is not valid (a number and 8 characters in length)
    $phonenumber = $_POST["phonenumber"];
    $phoneflag = empty(phoneNumRegEx($phonenumber));

    var_dump($maxlengtharray);

    if (!($bufferflag && $emptyflag)) {
        header("location: https://www.swapamc.com/swapproj/signup?error=invalidinput");
        exit;
    } elseif ($phoneflag === false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=invalidphonenumber");
        exit();
    }
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://
    checkForURL($_POST, $filename, $ipadd);




    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $primaryschool = $_POST["primaryschool"];
    $favouritefood = $_POST["favouritefood"];
    $captcha = $_POST['g-recaptcha-response'];
    // echo ($firstname . $lastname . $email . $phonenumber . $username . $pwd . $pwdRepeat . $primaryschool . $favouritefood . $captcha);



    $failedCaptcha = failedCaptcha($captcha);
    // exit;
    $inkey = badInput($_POST);

    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors

    if ($inkey !== false) {
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
    } elseif (duplicateEmail($conn, $email) == 1) {
        header("location: https://www.swapamc.com/swapproj/signup?error=duplicateemail");
        exit();
    } elseif (strongPassword($pwd) === false) {
        header("location: https://www.swapamc.com/swapproj/signup?error=weakpass");
        exit;
    } else {
        createUser($conn, $firstname, $lastname, $email, $username, $pwd, $phonenumber, $primaryschool, $favouritefood);
    }
} else {
    header("location: https://www.swapamc.com/swapproj/signup");
    exit();
}
