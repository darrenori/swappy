<?php



//echo "edit";
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/profile/includes/profile.inc.php';
session_start();



// deals with url stuff
if (!isset($_SESSION['loginstate'])) {
    header("location: ../swapproj/login");
    exit();
} elseif ($_SESSION['loginstate'] === "A") {
    header("location: ../swapproj/emailverification");
    exit();
} elseif ($_SESSION['loginstate'] === "B") {
    header("location: ../swapproj/googleauthentication");
    exit();
} elseif (!$_SESSION['loginstate'] === "OK") {
    header("location: ../swapproj/logout");
    exit();
}


$userid = $_SESSION["userid"];


foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";

    if ($key != "submit") {
        $postinformation[$key] = $value;
    }
}


//print_r($postinformation);

$username = $postinformation['username'];
$fname = $postinformation['fname'];
$lname = $postinformation['lname'];
$email = $postinformation['email'];
$number = $postinformation['number'];



$informationarray = [$username, $fname, $lname, $email, $number];

if (badInput([$username, $fname, $lname, $number])) {
    echo "stop trying to hack the website please!";
    //header
}





if (notEmpty($informationarray) == 1) {

    if (invalidEmail($email) == 0) {

        if (emailExists($conn, $email, $userid) == 0) {
            if (usernameExists($conn, $username, $userid) == 0) {

                $query = $conn->prepare("UPDATE mydb.users SET user_username = '$username',
                    user_fname = '$fname',user_lname  = '$lname',user_number=  '$number',username_email = '$email' 
                    WHERE user_id =$userid;");

                if ($query->execute()) {
                    header("location: ../swapproj/userprofile?type=success");
                } else {
                    header("location: ../swapproj/allproducts/product/updateprofile?error=stmtfailed");
                    exit();
                }
            }
        }
    }
}
