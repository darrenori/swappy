<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
$jwtarray = jwtdecrypt();
if(isset($jwtarray)){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    //header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/tasks/includes/tasks.inc.php';


if(isset($_POST['name'])&&isset($_POST['details'])&&isset($_POST['progress'])&&isset($_POST['assignedby'])){
    $name = $_POST['name'];
    $details = $_POST['details'];
    $progress = $_POST['progress'];
    $assignedby = $_POST['assignedby'];

    if($progress=='Received'){
        $progress=0;
    } elseif($progress=='In Progress'){
        $progress=1;
    } elseif($progress=='Waiting for check'){
        $progress=2;
    } else {
        //kick
    }

    

    if(badInput([$name,$details,$progress,$assignedby])==0){
        
    } else {
        //kick em
    }

    
}

$taskid = $jwtarrayinformation['task'];
$employeeid = $jwtarrayinformation['employeeid'];

date_default_timezone_set('Asia/Singapore');
$now = time();
$now = date('Y-m-d', $now)." ".date('H:i:s');

$query = $conn->prepare("UPDATE mydb.employees_task SET task_name = '$name', task_details = '$details',
task_progress='$progress',task_assignedby='$assignedby',task_dateedited='$now' WHERE task_id = '$taskid';");


if($query->execute()){
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid");

}



?>