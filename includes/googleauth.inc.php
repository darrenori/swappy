<?php

if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/googleauth/vendor/autoload.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

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

    // removes any other GET and POST names and does html specialchars
    $whitelist = ['googleauthotp'];
    $_POST = XSSPrevention($_POST, $whitelist);
    // declares variable length in chars for each item. 
    $maxlengtharray['googleauthotp'] = 8;//should be six, 
    //removes any nondigit characters.
    // $storeid = preg_replace('/[^\d]/', '', $_POST['googleauthotp']);


    $jwtarray = jwtdecrypt();
    if (isset($jwtarray) && $jwtarray == true) {

        ## use $jwtinformation["key"] to retrieve the values 
        ## keys and values can be viewed on campus.php page
        $jwtarrayinformation = $jwtarray['array'];
        // bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
        $bufferflag = empty(checkLength($_POST, $maxlengtharray));
        $emptyflag = empty(checkEmpty($_POST, ['googleauthotp']));

        if (!($bufferflag && $emptyflag)) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $jwtarrayinformation['loginstate'] === "A";
            jwtupdate($jwtarrayinformation);
            header("location: https://www.swapamc.com/swapproj/googleauthentication?error=invalidid");
            exit;
        }


        if (!isset($_SESSION)) {
            session_start();
        }
        $secret = $_SESSION['usersecret'];

        session_regenerate_id();




        //removing our session as soon as we won't need it anymore reduces the attack surface.
        // unset($jwtarrayinformation['usersecret']);
        $code = $_POST['googleauthotp'];
        $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

        // echo $secret;
        // echo 'Current Code is: ';

        // echo "\n";

        // echo "Check if $code is valid: ";

        if ($g->checkCode($secret, $code)) {
            if ($jwtarrayinformation['loginstate'] === "B") {
                $jwtarrayinformation['loginstate'] = "OK";
                jwtupdate($jwtarrayinformation);
                header("location: https://www.swapamc.com/swapproj/campus");
                exit();
            } elseif ($jwtarrayinformation['loginstate'] === "Z") {
                //destroys any jwt 'sessions' that might exist
                if (isset($_COOKIE['jwt'])) {
                    setCookieSameSite('jwt', '', time() - 36000);
                }
                header("location: https://www.swapamc.com/swapproj/login");
                exit();
            }
        } else {
            header("location: https://www.swapamc.com/swapproj/googleauthentication?error=badotp");
            exit();
        }
    } else {

        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }
} else {
    header("location: https://www.swapamc.com/swapproj/googleauthentication?error=badotp");
    exit();
}
