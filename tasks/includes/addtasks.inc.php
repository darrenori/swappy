<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/tasks/includes/tasks.inc.php';


$userid = $jwtarrayinformation['userid'];
$role = $jwtarrayinformation['role'];
if ($role == 6 || $role == 5 || $role == 3) {
} else {
    echo "ur a fake";
}

foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";


    $postinformation[$key] = $value;
}

date_default_timezone_set('Asia/Singapore');


$selectedDate =  date("Y-m-d H:i:s", strtotime($_POST["date"]));
// echo $selectedDate;
// echo "<br>";
$now = time();
$now = date('Y-m-d', $now) . " " . date('H:i:s');

// echo $now;
// echo strtotime($now)."<br>";
// echo strtotime($selectedDate);
$verifyTime = checkTime($now, $selectedDate);

if ($verifyTime == 0) {
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/addtask?error=baddate");
} else {
    echo "valid";
    $taskname = $_POST['taskname'];
    $taskdetails = $_POST['taskdetails'];
    $userusername = $jwtarrayinformation['userusername'];
    $employeeid = $jwtarrayinformation['employeeid'];
    $assignedby = $jwtarrayinformation['username'];


    print_r($postinformation);

    try {
    $query = $conn->prepare("INSERT INTO mydb.employees_task (working_id,task_name,task_details,task_progress,
        task_assignedby,task_dateassigned,task_datetofinish) VALUES ($employeeid,'$taskname','$taskdetails',0,'$assignedby','$now','$selectedDate');");
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
