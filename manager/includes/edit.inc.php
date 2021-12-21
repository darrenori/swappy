<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
$jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';

if(isset($jwtarrayinformation['employeeid'])){
    $employeeid = $jwtarrayinformation['employeeid'];
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


if(badInput([$role,$number,$department,$perhourpay])==0){
    $jwtarrayinformation['employeeid'] = $employeeid;
    
} else {
    //kick them out
}



$query = $conn->prepare("UPDATE mydb.working_employees SET working_role = '$role', working_number = '$number', 
working_department  = '$department', working_perhourpay = '$perhourpay'
WHERE working_id = $employeeid;");

if(!$query){
    echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
}

if($query->execute()){
    echo "deed done";

}

header("location: https://www.swapamc.com/swapproj/employeemanager");

?>