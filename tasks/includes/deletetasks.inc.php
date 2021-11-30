<?php

session_start();

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
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/tasks/includes/tasks.inc.php';


if(isset($_GET['task'])){
    if(badInput([$_GET['task']])==0){
        $taskid = $_GET['task'];
        
    } else {
        //kick
    }
}



$query = $conn->prepare("DELETE FROM mydb.employees_task WHERE task_id = $taskid");

if($query->execute()){
    echo "done";
}
$employeeid = $_SESSION['employeeid'];

header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid");

?>