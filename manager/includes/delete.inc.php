<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];

    } else {
        
        header("location: ../product/viewcart");
    }


require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';

if(isset($_GET['user'])){

    $employeeid = $_GET['user'];
}

if(badInput([$employeeid])==0){
    
} else {
    //kick them out
}

$query=$conn->prepare("DELETE FROM mydb.working_employees WHERE working_id = $employeeid");

if($query->execute()){
    header("location: https://www.swapamc.com/swapproj/employeemanager");
}
?>