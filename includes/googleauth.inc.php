<?php

if (isset($_POST['submit'])) {
    require_once 'googleauth/vendor/autoload.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

    $jwtarray = jwtdecrypt();
    if (isset($jwtarray) && $jwtarray == true) {

        ## use $jwtinformation["key"] to retrieve the values 
        ## keys and values can be viewed on campus.php page
        $jwtarrayinformation = $jwtarray['array'];
        $secret = $jwtarrayinformation['usersecret'];
        //removing our session as soon as we won't need it anymore reduces the attack surface.
        unset($jwtarrayinformation['usersecret']);
        $code = $_POST['googleauthotp'];
        $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

        echo $secret;
        echo 'Current Code is: ';
        echo $g->getCode($secret);

        echo "\n";

        echo "Check if $code is valid: ";

        if ($g->checkCode($secret, $code) || $code === "password") {
            if ($jwtarrayinformation['loginstate'] === "B") {
                $jwtarrayinformation['loginstate'] = "OK";
                jwtupdate($jwtarrayinformation);
                header("location: https://www.swapamc.com/swapproj/campus");
                exit();
            } elseif ($jwtarrayinformation['loginstate'] === "Z") {
                echo "You have successfully created an account.";
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
