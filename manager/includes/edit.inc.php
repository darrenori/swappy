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
$fname = $postinformation['fname'];
$lname = $postinformation['lname'];
$role = $postinformation['role'];
$number = $postinformation['number'];
$address = $postinformation['address'];


if(badInput([$fname,$lname,$role,$number,$address])==0){
    $_SESSION['employeeid'] = $employeeid;
    
} else {
    //kick them out
}



$query = $conn->prepare("UPDATE mydb.working_employees SET working_fname = '$fname', working_lname = '$lname', 
working_role  = '$role', working_number = '$number',working_address = '$address'
WHERE working_id = $employeeid;");

if(!$query){
    echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
}

if($query->execute()){
    echo "deed done";

}

header("location: https://www.swapamc.com/swapproj/employeemanager");

?>