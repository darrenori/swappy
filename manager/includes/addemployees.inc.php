<?php

## Originally add.inc

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

//Imports required includes files
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';
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
$whitelist =['role','number','department','pay','username'];
$_POST = XSSPrevention($_POST, $whitelist);
// runs all variables thru sqlescape string
$_POST = escapeString($conn, $_POST);

// declares variable length in chars for each item. 
$maxlengtharray['role'] = 45;
$maxlengtharray['number'] = 45;
$maxlengtharray['department'] = 65535;
$maxlengtharray['pay'] = 11;
$maxlengtharray['username']=60;

// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
$emptyflag = empty(checkEmpty($_POST,$whitelist));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/employeemanager/edit?error=invalid&user=$employeeid");
    exit;
}



foreach ($_POST as $key => $value) {

    if ($key != "quantity") {
        $postinformation[$key] = $value;
    }
}
$username = $postinformation['username'];
$role = $postinformation['role'];
$number = $postinformation['number'];
$department = $postinformation['department'];
$pay = $postinformation['pay'];

//false means that the text is good
if (badEmployeeInput([$username, $role, $number, $department, $pay]) !== false) {
    header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=badinput");
    exit();
}// phoneflag will return false (undesired) if the phone number is not valid (a number and 8 characters in length)
$phoneflag = empty(phoneNumRegEx($number));

if ($phoneflag === false) {
    header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=badinput");
    exit();
}


// throws error "Statment Preparation failed" when statement fails
try {
    //this query checks if user exists
    $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE user_username = ?;");
    $query->bind_param('s',$username);

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(add.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (add.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
    exit;
}

//get row count
$resultSet = $query->get_result();
$result = $resultSet->fetch_all();
$user_id = $result[0][0];
// $rows = sizeOf($result);
// echo $rows;



if ($result) {
    $query->close();

    // throws error "Statment Preparation failed" when statement fails
    try {
        //checks if this user is already registered as an employee
        $query = $conn->prepare("SELECT user_id FROM mydb.working_employees WHERE user_id = ?;");
        $query->bind_param('s',$user_id);

        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(add.inc)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (add.inc)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executin statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
        exit;
    }


    $row = $query->fetch();

    if ($row) {
        header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=employeeexists");
    } else {

        $query->close();
        
        // throws error "Statment Preparation failed" when statement fails
        try {
            //if user is not exisitng in users table
            $query = $conn->prepare("INSERT INTO mydb.working_employees (user_id,working_role,working_number,working_department,working_perhourpay) VALUES (?,?,?,?,?);");
            $query->bind_param('sssss',$user_id,$role,$number,$department,$pay);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(add.inc)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (INSERT)", 0);
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (add.inc)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (INSERT)", 0);
            header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
            exit;
        }


        // echo "done";
        // header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=usernamefailed");
        // exit;

        //if there is no error
        if($jwtarrayinformation['username']==$username){
            
            $empid = isEmployee($conn,$jwtarrayinformation['userid']);
            $jwtarrayinformation['workingid'] = $empid;
            jwtupdate($jwtarrayinformation);
        }


        header("location: https://www.swapamc.com/swapproj/employeemanager");
    }
    $query->close();

    try {
        //if user is not exisitng in users table
        $query = $conn->prepare("UPDATE mydb.users SET user_role = 1 WHERE user_id =? ");
        $query->bind_param('s',$user_id);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(add.inc)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (INSERT)", 0);
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (add.inc)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (INSERT)", 0);
        header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
        exit;
    }













} else {

    header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=usernamefailed");
    exit;
}
