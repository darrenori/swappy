<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/tasks/includes/tasks.inc.php';

if (!isset($_GET)) {
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=notaskselected");
    exit;
}
    //renders any scripts into html form of special char e.g., & = &amp
    foreach ($_GET as $key => $val) {
        if (gettype($key) == "string" && $key !== "0") {
            $goodkey = htmlentities($key);
            $_GET[$goodkey] = $_GET[$key];
            unset($_GET[$key]);
        }
        //only checks if of string type (integers will not run through htmlspecialchars)
        if (gettype($val) == "string") {
            $goodval = htmlentities($val);
            $_GET[$goodkey] = $goodval;
        }
        if (empty($val)) {
            $_GET[$goodkey] = "0";
        }
    }

    // $getuser = htmlentities($_GET["user"]);
    // $employeeid = $getuser;

if (isset($_GET['task'])) {
    if (badInput([$_GET['task']]) === false) {
        $taskid = $_GET['task'];
    } else {
        header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=" . $employeeid . "&error=badstatement");
        exit;
        }
}

$employeeid = $jwtarrayinformation['employeeid'];






$whitelist=['task'];
$maxlengtharray['task']=11;
$methd = $_GET;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=empty".$empty);
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkId($validarray)!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=" . $employeeid . "&error=badid");
    exit();
}

if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=" . $employeeid . "&error=toolong");
    exit();
}


if(validateCSRFGet()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        
        //dont redirect if on the same page
  
    } else {
        error_log("TPAMC:".$filename.":4:$ipadd:2 CSRF", 0);
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
    
    
}

$taskid = $validarray['task'];














try {
    $query = $conn->prepare("DELETE FROM mydb.employees_task WHERE task_id = $taskid");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(deletetasks.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=" . $employeeid . "&error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (deletetasks.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=" . $employeeid . "&error=badstatement"); //    echo mysqli_error($query);

    exit;
}


header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid");
