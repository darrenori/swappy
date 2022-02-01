<?php
// var_dump($_POST);exit;



// !!!!!!!  SESSION forgetpassskey AND POST key are not the same !!!!!!
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';



require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';

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
$whitelist = ['newpass','key', 'email'];
$_POST = XSSPrevention($_POST, $whitelist);
$_POST = escapeString($conn, $_POST);
$requiredfields = $whitelist;
// declares variable length in chars for each item. 
$maxlengtharray['newpass'] = 60;
$maxlengtharray['email'] = 60;
$maxlengtharray['key'] = 32;

// $bufferflag will return false (undesired) if any of the fields exceed the buffer length
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
// emptyflag will return false (undesired) if any of the required fields are not filled
$emptyflag = empty(checkEmpty($_POST, $requiredfields));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/forgetpasswords"); //purposely wrong url, so return 404 error
    exit;
}

$key=$_POST['key'];
$email=$_POST['email'];




$newpass = htmlspecialchars($_POST["newpass"]);
if (strongPassword($newpass)===false) {
    header("location: https://www.swapamc.com/swapproj/forgetpassword/resetpassword?key=$key&email=$email&action=reset&error=weakpass");
    exit;
}
$pepper = "AWiokdfnkFNKKHHDBJXLL28838jkuiu54859dnkkmid93E1928485";
$hashedPwd = hash_hmac("sha256", $newpass, $pepper);
$hashedPwd = hash("sha256", hash("sha256", $hashedPwd));
$hashedPwd = password_hash($hashedPwd, PASSWORD_DEFAULT);


//get uid
session_start();
session_regenerate_id();

$email = $_SESSION['forgetpassemail'];
$randomsecret = generateRandomString();
$_SESSION['newsecret'] = $randomsecret;





try {
    $query = $conn->prepare("UPDATE mydb.users SET user_password = ? WHERE username_email = ?;");
    $query->bind_param("ss", $hashedPwd,$email);
    unset($_SESSION["forgetpasskey"]);

    if ($query === false) {
        throw new Exception("Statement Preparation failed (resetpass)");
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
    if ($query->execute()) {
        echo "Password reset success";
        header("location: https://www.swapamc.com/swapproj/forgetpassword/googleauth");    
    }
    elseif ($query->execute() === false) {
        throw new Exception("Statement Execution failed (resetpass)");
        exit();
    }
} catch (Exception $e) {
    error_log("TPAMC:FORGETPASS:0:$ip:Error(badstatement)", 0);
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=badstatement");
    exit;
}
$query -> close();





if($query->execute()){
} else {
    echo mysqli_error($query);
}

$query->close();

?>