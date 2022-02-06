<?php
// var_dump($_POST);exit;

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/googleauth/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
session_start();
session_regenerate_id();

### CSRF ####
if(validateCSRF()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        echo 'bad csrf';
        //dont redirect if on the same page
  
    } else {
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
}
### CSRF ####


// removes any other GET and POST names and does html specialchars
$whitelist =['googleauthotp'];
$_POST = XSSPrevention($_POST, $whitelist);

//removes any nondigit characters.
$storeid = preg_replace('/[^\d]/', '', $_POST['googleauthotp']);




$email = $_SESSION['forgetpassemail'];
$randomsecret = $_SESSION['newsecret'];
$code = $_POST['googleauthotp'];




//validate output
$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();

// echo $randomsecret;

// echo ($code."<br>");
// var_dump($g->checkCode($randomsecret, $code));
// echo $g->getCode($randomsecret); var_dump($g->checkCode($randomsecret, $code)); 

// echo 'Current Code is: ';
// echo $g->getCode($randomsecret);
// echo "\n";
// echo "Check if $code is valid: ";



if ($g->checkCode($randomsecret, $code)) {

    //update secret code for the user
    try {
        $query = $conn->prepare("UPDATE mydb.users SET user_secret = ? WHERE username_email = ? ");
        $query->bind_param("ss", $randomsecret, $email);
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
    $query->close();

    header("location: https://www.swapamc.com/swapproj/login?reset=success");

    //unset session after finish
    session_unset();

    exit();
} else {
    header("location: https://www.swapamc.com/swapproj/forgetpassword/googleauth?error=badotp");
    //unset session after finish
    session_unset();
    exit();
}
