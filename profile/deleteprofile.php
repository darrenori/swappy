<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';


$userid = $jwtarrayinformation["userid"];


$query = $conn->prepare("DELETE FROM mydb.users WHERE user_id = $userid");

if ($query->execute()) {
    echo "done";

    session_start();
    session_unset();
    session_destroy();

    header("location: ../swapproj/login");
    exit();
} else {
    header("location: ../swapproj/allproducts/profile/deleteprofile?error=stmtfailed");
    exit();
}
