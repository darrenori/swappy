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
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';

if(isset($_GET['user'])){
    $employeeid = $_GET['user'];
}
else{
    echo "Error";
}

if(badInput([$employeeid])==0){
    $_SESSION['employeeid'] = $employeeid;
} else {
    //kick them out
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

$query=$conn->prepare("DELETE FROM mydb.working_employees WHERE working_id = $employeeid");
if($query->execute()){
    header("location: https://www.swapamc.com/swapproj/employeemanager");
}
?>