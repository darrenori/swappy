<?php
## Originally delete.inc

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';

### CSRF ####
if(validateCSRFGet()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        echo 'bad csrf';
        //dont redirect if on the same page
  
    } else {
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
}
### CSRF ####


if (!isset($_GET['user'])) {
    header("location: https://www.swapamc.com/swapproj/employeemanager");
    exit;
} else {
    //renders any scripts into html form of special char e.g., & = &amp
    foreach ($_GET as $key => $val) {
        if (gettype($key) == "string" && $key !== "0") {
            $goodkey = htmlspecialchars($key, ENT_QUOTES);
            $_GET[$goodkey] = $_GET[$key];
            unset($_GET[$key]);
        }
        //only checks if of string type (integers will not run through htmlspecialchars)
        if (gettype($val) == "string") {
            $goodval = htmlspecialchars($val, ENT_QUOTES);
            $_GET[$goodkey] = $goodval;
        }
        if (empty($val)) {
            $_GET[$goodkey] = "0";
        }
    }


    $maxlengtharray['user'] = 11;
    // bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
    $_GET = XSSPrevention($_GET, ['user']);
    $bufferflag = empty(checkLength($_GET, $maxlengtharray));
    $emptyflag = empty(checkEmpty($_GET, ['user']));

    if (!($bufferflag && $emptyflag)) {
        header("location: https://www.swapamc.com/swapproj/employeemanager?error=invalidid");
        exit;
    }elseif (badInputTwo([$_GET['user']])) {
        header("location: https://www.swapamc.com/swapproj/employeemanager?error=invalidid");
        exit;
    }


    $employeeid = $_GET['user'];
}

if (badEmployeeInput([$employeeid]) !== false) {
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badinput");
    exit();
}

$jwtarrayinformation['employeeid'] = $employeeid;
jwtupdate($jwtarrayinformation);
// throws error "Statment Preparation failed" when statement fails
try {
    $query = $conn->prepare("DELETE FROM mydb.working_employees WHERE working_id = ?");
    $query->bind_param('s',$employeeid);

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(delete.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (DELETE)", 0);
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
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (DELETE)", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
    exit;
}

header("location: https://www.swapamc.com/swapproj/employeemanager");
exit;