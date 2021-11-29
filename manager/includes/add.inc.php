<?php
session_start();


echo "wasusp";


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
    
    
} else {
    //kick them out
}


$query=$conn->prepare("INSERT INTO mydb.working_employees (working_fname,working_lname,working_role,working_number,working_address) VALUES ('$fname','$lname','$role','$number','$address');");
if($query->execute()){
    echo "done";
}
header("location: https://www.swapamc.com/swapproj/employeemanager");

?>