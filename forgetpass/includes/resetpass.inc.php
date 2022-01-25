<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';



require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
$newpass = htmlspecialchars($_POST["newpass"]);
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
        error_log("TPAMC:FORGETPASS:2:$ip:failed statement", 0);
        exit();
    }
} catch (Exception $e) {
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=badstatement");
    error_log("TPAMC:FORGETPASS:0:$ip:Error(badstatement)", 0);
    exit;
}
$query -> close();





if($query->execute()){
} else {
    echo mysqli_error($query);
}

$query->close();

?>