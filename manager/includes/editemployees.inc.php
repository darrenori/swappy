<?php

## Originally edit.inc

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employeefunctions.inc.php';

if(isset($jwtarrayinformation['employeeid'])){
    $employeeid = $jwtarrayinformation['employeeid'];
}    


### CSRF ####
if(validateCSRF()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/employeemanager/edit?error=badcsrf&user=$employeeid"){
        echo 'bad csrf';
        //dont redirect if on the same page
  
    } else {
        header("location: https://www.swapamc.com/swapproj/employeemanager/edit?error=badcsrf&user=$employeeid");
        exit;
    }
}
### CSRF ####

// removes any other GET and POST names and does html specialchars
$whitelist =['role','number','department','pay'];
$_POST = XSSPrevention($_POST, $whitelist);
// runs all variables thru sqlescape string
$_POST = escapeString($conn, $_POST);

// declares variable length in chars for each item. 
$maxlengtharray['role'] = 45;
$maxlengtharray['number'] = 45;
$maxlengtharray['department'] = 65535;
$maxlengtharray['pay'] = 11;

// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
$emptyflag = empty(checkEmpty($_POST,$whitelist));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/employeemanager/edit?error=invalid&user=$employeeid");
    exit;
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
    error_log("TPAMC:".$filename.":3:$ipadd:Malicious Input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/edit?error=badinput&user=$employeeid");
    exit();
}

$jwtarrayinformation['employeeid'] = $employeeid;
jwtupdate($jwtarrayinformation);



// throws error "Statment Preparation failed" when statement fails
try {
    $query = $conn->prepare("UPDATE mydb.working_employees SET working_role = ?, working_number = ?, 
    working_department  = ?, working_perhourpay = ?
    WHERE working_id = ?;");
    $query->bind_param('sssss',$role,$number,$department,$perhourpay,$employeeid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(edit.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (UPDATE)", 0);
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
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (UPDATE)", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");// echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
    exit;
}

header("location: https://www.swapamc.com/swapproj/employeemanager");
