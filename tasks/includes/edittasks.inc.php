<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/tasks/includes/tasks.inc.php';

$taskid = $jwtarrayinformation['task'];
$employeeid = $jwtarrayinformation['employeeid'];

$whitelist=['name','details','progress','assignedby'];
$maxlengtharray['name']=255;
$maxlengtharray['details']=255;
$maxlengtharray['progress']=20;
$maxlengtharray['assignedby']=125;

$methd = $_POST;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=empty");
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(badInputTwo([$validarray['name']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=maliciousname");
    exit();
}

if(badInputTwo([$validarray['details']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=maliciousdetails");
    exit();
}

if(badInputTwo([$validarray['progress']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=maliciousprogress");
    exit();
}

if(badInputTwo([$validarray['assignedby']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=maliciousassgndby");
    exit();
}

if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=toolong");
    exit();
}



$name = $validarray['name'];
$details = $validarray['details'];
$progress = $validarray['progress'];
$assignedby = $validarray['assignedby'];






if($progress=='Received'){
    $progress=0;
} elseif($progress=='In Progress'){
    $progress=1;
} elseif($progress=='Waiting for check'){
    $progress=2;
} else {
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=badprogress");
    exit();
    //kick
}

if(validateCSRF()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        
        //dont redirect if on the same page
  
    } else {
        error_log("TPAMC:".$filename.":4:$ipadd:2 CSRF", 0);
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
    
    
}



date_default_timezone_set('Asia/Singapore');
$now = time();
$now = date('Y-m-d', $now)." ".date('H:i:s');



try {
    $query=$conn->prepare("UPDATE mydb.employees_task SET task_name = ?, task_details = ?,
    task_progress=?,task_assignedby=?,task_dateedited=? WHERE task_id = ?;");
    $query->bind_param('ssssss',$name,$details,$progress,$assignedby,$now,$taskid);
    // echo $name."<br>".$details."<br>".$progress."<br>".$assignedby."<br>".$now."<br>".$taskid;
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=sqlfailed");
    exit();
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid&error=sqlfailed");
    exit();
}



header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid");





?>