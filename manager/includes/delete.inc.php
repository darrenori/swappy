<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';

if(isset($_GET['user'])){

    $employeeid = $_GET['user'];
}

if(badInput([$employeeid])!==false){
    header("location: ../employeemanager?error=badinput");
    exit();
}

$jwtarrayinformation['employeeid'] = $employeeid;
jwtupdate($jwtarrayinformation);
$query=$conn->prepare("DELETE FROM mydb.working_employees WHERE working_id = $employeeid");

if($query->execute()){
    header("location: https://www.swapamc.com/swapproj/employeemanager");
}else{
    header("location: ../employeemanager?error=stmtfailed");
    exit();
}

?>