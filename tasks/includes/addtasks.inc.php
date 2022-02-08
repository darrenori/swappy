<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/tasks/includes/tasks.inc.php';


$userid = $jwtarrayinformation['userid'];
$role = $jwtarrayinformation['role'];
$taskid = $jwtarrayinformation['task'];
$employeeid = $jwtarrayinformation['employeeid'];
if ($role == 6 || $role == 5 || $role == 3) {
} else {
    echo "ur a fake";
}








$whitelist=['taskname','taskdetails','date'];
$maxlengtharray['taskname']=255;
$maxlengtharray['taskdetails']=255;
$maxlengtharray['date']=19;


$methd = $_POST;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid&error=empty");
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(badInputTwo([$validarray['taskname']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid&error=empty");
    exit();
}

if(badInputTwo([$validarray['taskdetails']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid&error=empty");
    exit();
}

if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid&error=length");
    exit();
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

$taskname = $validarray['taskname'];
$taskdetails = $validarray['taskdetails'];









date_default_timezone_set('Asia/Singapore');

$selectedDate =  date("Y-m-d H:i:s", strtotime($_POST["date"]));
if(regexDate([$selectedDate])!=false){
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid&error=baddate");
    exit();
}

$now = time();
$now = date('Y-m-d', $now) . " " . date('H:i:s');

$verifyTime = checkTime($now, $selectedDate);
















// $taskname = $_POST['taskname'];
// $taskdetails = $_POST['taskdetails'];











if ($verifyTime == 0) {
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/addtask?error=baddate");
} else {
    echo "valid";
    
    $userusername = $jwtarrayinformation['userusername'];
    $employeeid = $jwtarrayinformation['employeeid'];
    $assignedby = $jwtarrayinformation['username'];


    // print_r($postinformation);

    try {
    $query = $conn->prepare("INSERT INTO mydb.employees_task (working_id,task_name,task_details,task_progress,
        task_assignedby,task_dateassigned,task_datetofinish) VALUES (?,?,?,0,?,?,?);");
                $query->bind_param('ssssss',$employeeid,$taskname,$taskdetails,$assignedby,$now,$selectedDate);
                if ($query === false) {
                    //change filename accordingly
                    throw new Exception("Statement Preparation failed(addtaskss.inc)");
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                //change header location accordingly
                header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=".$employeeid."&error=badstatement");
                exit;
            }
            // throws error "Statment Execution failed" when statement fails
            try {
                $execute = $query->execute();
                if ($execute === false) {
                    throw new Exception("Statement Execution failed (addtasks.inc)");
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=".$employeeid."&error=badstatement"); //    echo mysqli_error($query);
            
                exit;
            }
    




    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=".$employeeid);
    exit;
}
