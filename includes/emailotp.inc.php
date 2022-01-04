<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

$jwtarray = jwtdecrypt();
if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];

    //resend email otp
    if (isset($_POST["resend"])) {
        require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/phpmailer/verification2fa.php';
        $vc = new VerificationCode($jwtarrayinformation['useremail']);
        $vc->sendMail();
        echo "resending OTP";
        header("location: https://www.swapamc.com/swapproj/emailverification?resend=resend");
        exit();
    }

    if (isset($_POST["submit"]) &&  $jwtarrayinformation['loginstate'] === "A") {

        // gets the username password and captcha input
        $userinput = (int)$_POST["emailotp"];
        $useremailotp = $jwtarrayinformation["emailotp"];
        if (gettype($useremailotp) !== "integer") {
            $useremailotp = (int)$useremailotp;
        }

        require_once 'functions.inc.php';
        #####the verification2fa.php file is only required if we plan to implement resending of email and code. 
        //there is a phenomenon that when the page is refreshed, a new code is generated into the session storage
        //however an email is not sent, this is interesting and will require more looking into. 
        //this is also a problem because if the user refreshes/fills in a bad otp, they will have no idea what the otp is.
        // require_once 'phpmailer/verification2fa.php';

        ////Checks if inputs are not identical
        $failedverification = pwdMatch($userinput, $useremailotp);
        echo $failedverification;
        $currentrequestime = $_SERVER["REQUEST_TIME"];
        if ($currentrequestime - $jwtarrayinformation["emailotptime"] > 10) {
            echo "session has expired";
            echo "Please Click the resend button";
            header("location: https://www.swapamc.com/swapproj/emailverification?error=expiredotp");
            exit();
        } else {
            // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
            if ($failedverification !== false) {
                echo "badotp";
                jwtupdate($jwtarrayinformation); // updates the JWT session without 'emailotp'
                header("location: https://www.swapamc.com/swapproj/emailverification?error=badotp");
                exit();
            } else {
                echo "goodotp";
                $jwtarrayinformation['loginstate'] = "B";
                //removes 'emailotp' from the array
                unset($jwtarrayinformation["emailotp"]);
                // echo ("this is jwtarrayinfo");
                // echo "<p><br><br>";
                // var_dump($jwtarrayinformation);
                // echo "</p><br><br>";

                jwtupdate($jwtarrayinformation); // updates the JWT session without 'emailotp'

                // $jwtarray = jwtdecrypt();
                // echo "<p>";
                // var_dump($jwtarray);
                // echo "</p>";

                header("location: https://www.swapamc.com/swapproj/googleauthentication");
                exit();
            }
        }
    } elseif ($jwtarrayinformation['loginstate'] === "B") {
        header("location: https://www.swapamc.com/swapproj/googleauthentication");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "OK" and isset($jwtarrayinformation['username'])) {
        header("location: https://www.swapamc.com/swapproj/campus");
        exit();
    } else {
        header("location: https://www.swapamc.com/swapproj/login");
        exit();
    }
} else {

    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}
