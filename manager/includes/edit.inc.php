<?php
session_start();

if (!isset($_SESSION['loginstate'])) {
    header("location: https://www.swapamc.com/swapproj/login");
    exit();
} elseif ($_SESSION['loginstate'] === "A") {
    header("location: https://www.swapamc.com/swapproj/emailverification");
    exit();
} elseif ($_SESSION['loginstate'] === "B") {
    header("location: https://www.swapamc.com/swapproj/googleauthentication");
    exit();
} elseif (!$_SESSION['loginstate'] === "OK") {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}


require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';

if(isset($_SESSION['employeeid'])){
    $employeeid = $_SESSION['employeeid'];
}


foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";
    
    if($key!="quantity"){
        $postinformation[$key] = $value;
    }
}

$role = $postinformation['role'];
$number = $postinformation['number'];
$department = $postinformation['department'];
$perhourpay = $postinformation['pay'];


if(badInput([$role,$number,$department,$perhourpay])!==false){
    header("location: ../employeemanager?error=badinput");
    exit();
}

$_SESSION['employeeid'] = $employeeid;



$query = $conn->prepare("UPDATE mydb.working_employees SET working_role = '$role', working_number = '$number', 
working_department  = '$department', working_perhourpay = '$perhourpay'
WHERE working_id = $employeeid;");

if(!$query->execute()){
    echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
    header("location: ../employeemanager/edit?error=stmtfailed");
    exit();
}

if($query->execute()){
    echo "deed done";

}

header("location: https://www.swapamc.com/swapproj/employeemanager");

?>