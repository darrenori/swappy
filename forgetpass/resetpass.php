<?php

// !!!!!!!  SESSION forgetpassskey AND POST key are not the same !!!!!!

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
session_start();
session_regenerate_id();
$csrf = generateCSRF();

// removes any other GET and POST names and does html specialchars
$whitelist = ['key', 'email', 'action','error'];
$_GET = XSSPrevention($_GET, $whitelist);
$_GET = escapeString($conn, $_GET);
$requiredfields = ['key', 'email', 'action'];
// declares variable length in chars for each item. 
$maxlengtharray['key'] = 32;
$maxlengtharray['email'] = 60;
$maxlengtharray['action'] = 10;
$maxlengtharray['error'] = 10;


$whitelistvalues = ['reset','weakpass'];
$exemptkeys = ['key', 'email']; // no exemptkeys are specified.
cleanValues($_GET, $whitelistvalues, $exemptkeys); //cleans action item ONLY

// $bufferflag will return false (undesired) if any of the fields exceed the buffer length
$bufferflag = empty(checkLength($_GET, $maxlengtharray));
// emptyflag will return false (undesired) if any of the required fields are not filled
$emptyflag = empty(checkEmpty($_GET, $requiredfields));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/forgetpasswords"); //purposely wrong url, so return 404 error
    exit;
}

$key=$_GET['key'];
$email=$_GET['email'];


print_r($_GET);
echo "<br><br><br><br>";
print_r($_SESSION);



// exit;
if (!isset($_SESSION["forgetpasskey"])) {
    header("location: https://www.swapamc.com/swapproj/forgetpassword?email=expired");
    exit();
} else {
    var_dump($_GET);
    var_dump($_SESSION);

    //THIS CONDITION DOES NOT SATISFY AND THUS CANNOT ADVANCE
    if ($_GET["key"] ===  $_SESSION["forgetpasskey"]) {
        // unset($_SESSION["forgetpasskey"]);
        if ($_GET["email"] === $_SESSION["forgetpassemail"]) {
            $currenttime = $_SERVER["REQUEST_TIME"];        

            if ($currenttime -  $_SESSION["forgetpassexpiry"] > 300) {
                header("location: https://www.swapamc.com/swapproj/forgetpassword?email=expired");
                exit();
            } else {
                echo "<form method='post' action='resetpasswordinc'>";
                echo "<label><strong>Enter New Password:</strong></label><br>";
                echo "<input type='password' name='newpass'  required>";
                echo "<input type='submit' value='Reset Password' onclick='this.disabled=true; this.value='Sending, please wait...'; this.form.submit(); >";
                echo "<input type='hidden' name='csrf' value='$csrf'>";
                echo "<input type='hidden' name='key' value='$key'>";
                echo "<input type='hidden' name='email' value='$email'>";
                echo "</form>";
                if (isset($_GET['error']) && $_GET['error']==="weakpass") {
                    echo ("Password should contain 1 capital letter, 1 lower case letter, 1 number, and 1 special character and be at least 8 characters long.");
                }
            }
        } else {
            header("location: https://www.swapamc.com/swapproj/forgetpassword?error=invalidurl");
        }
    }
}
