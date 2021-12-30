<?php
## Originally delete.inc

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';

if (isset($_GET['user'])) {
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
    
        $getuser = htmlentities($_GET["user"]);
        $employeeid = $getuser;
}

if (badEmployeeInput([$employeeid]) !== false) {
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badinput");
    exit();
}

$jwtarrayinformation['employeeid'] = $employeeid;
jwtupdate($jwtarrayinformation);
// throws error "Statment Preparation failed" when statement fails
try {
    $query = $conn->prepare("DELETE FROM mydb.working_employees WHERE working_id = $employeeid");

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(delete.inc)");
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
        throw new Exception("Statement Execution failed (delete.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
    exit;
}

header("location: https://www.swapamc.com/swapproj/employeemanager");
exit;