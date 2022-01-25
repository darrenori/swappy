<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/googleauth/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';

session_start();
session_regenerate_id();

$email = $_SESSION['forgetpassemail'];
$randomsecret = $_SESSION['newsecret'];
$code = htmlspecialchars($_POST['googleauthotp']);




//validate output
$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

echo $randomsecret;
echo 'Current Code is: ';
echo $g->getCode($randomsecret);
echo "\n";
echo "Check if $code is valid: ";

if ($g->checkCode($randomsecret, $code)) {
    header("location: https://www.swapamc.com/swapproj/login?reset=success");
    exit();
} else {
    header("location: https://www.swapamc.com/swapproj/forgetpassword/googleauth?error=badotp");
    exit();
}






//update secret code for the user
try {
    $query = $conn->prepare("UPDATE mydb.users SET user_secret = ?  WHERE username_email = ?");
    $query->bind_param("ss", $randomsecret,$email);
    if ($query === false) {
        throw new Exception("Statement Preparation failed (forgetpassgoogleauth)");
        error_log("TPAMC:FORGETPASS:2:$ip:failed statement", 0);
        exit();
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=stmtallerror");
    error_log("TPAMC:FORGETPASS:0:$ip:Error(stmtallerror)", 0);
    exit;
}

try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (forgetpassgoogleauth)");
        error_log("TPAMC:FORGETPASS:2:$ip:failed statement", 0);
        exit();
    }
} catch (Exception $e) {
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=badstatement");
    error_log("TPAMC:FORGETPASS:0:$ip:Error(badstatement)", 0);
    exit;
}
$query -> close();


//unset session after finish
session_unset();
