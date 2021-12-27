<?php

## Originally edit.inc

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employeefunctions.inc.php';

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


if(badEmployeeInput([$role,$number,$department,$perhourpay])!==false){
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badinput");
    exit();
}

$jwtarrayinformation['employeeid'] = $employeeid;
jwtupdate($jwtarrayinformation);



// throws error "Statment Preparation failed" when statement fails
try {
    $query = $conn->prepare("UPDATE mydb.working_employees SET working_role = '$role', working_number = '$number', 
    working_department  = '$department', working_perhourpay = '$perhourpay'
    WHERE working_id = $employeeid;");
    
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(edit.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (edit.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");// echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
    exit;
}

header("location: https://www.swapamc.com/swapproj/employeemanager");

?>