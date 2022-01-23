<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
$newpass = htmlspecialchars($_POST["newpass"]);
$pepper = "AWiokdfnkFNKKHHDBJXLL28838jkuiu54859dnkkmid93E1928485";
$hashedPwd = hash_hmac("sha256", $newpass, $pepper);
$hashedPwd = hash("sha256", hash("sha256", $hashedPwd));
$hashedPwd = password_hash($hashedPwd, PASSWORD_DEFAULT);


//get uid
session_start();

$email = $_SESSION['forgetpassemail'];


$query = $conn->prepare("UPDATE mydb.users SET user_password = '$hashedPwd' WHERE username_email = '$email';");
if(!$query){
    echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
}

if($query->execute()){
    echo "Password reset success";
    header("location: https://www.swapamc.com/swapproj/login?reset=success ");
} else {
    echo mysqli_error($query);
}

$query->close();

?>