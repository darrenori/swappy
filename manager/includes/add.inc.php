<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

//Imports required includes files
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employee.inc.php';

foreach ($_POST as $key => $value) {
    echo "$key = $value<br>";

    if ($key != "quantity") {
        $postinformation[$key] = $value;
    }
}
$username = $postinformation['username'];
$role = $postinformation['role'];
$number = $postinformation['number'];
$department = $postinformation['department'];
$pay = $postinformation['pay'];

echo $username . " " . $role . " " . $number . " " . $department . " " . $pay . "<br>" . "<br>";

//false means that the text is good
if (badInput([$username, $role, $number, $department, $pay]) !== false) {
    header("location: ../employeemanager/adduser?error=badinput");
    exit();
}

$query = $conn->prepare("SELECT user_id FROM mydb.users WHERE user_username = '$username';");
if ($query->execute()) {
    //get row count
    $resultSet = $query->get_result();
    $result = $resultSet->fetch_all();
    $user_id= $result[0][0];
    echo gettype($resultSet);
    echo gettype($result);
    // $rows = sizeOf($result);
    // echo $rows;



    if ($result) {
        echo "exists";
        $query->close();
        //checks if this user is already registered as an employee
        $query = $conn->prepare("SELECT user_id FROM mydb.working_employees WHERE user_id = '$user_id';");
        if ($query->execute()) {

            $row = $query->fetch();

            if ($row) {
                header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=employeeexists");
            } else {

                echo "user does not exist";
                $query->close();
                echo $user_id;

                //if user is not exisitng in users table
                $query = $conn->prepare("INSERT INTO mydb.working_employees (user_id,working_role,working_number,working_department,working_perhourpay) VALUES ('$user_id','$role','$number','$department','$pay');");
                if (!$query->execute()) {
                    echo "done";
                    header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=usernamefailed");
                    exit;
                }
                //if there is no error
                header("location: https://www.swapamc.com/swapproj/employeemanager");
            }
        }
    } else {

        header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=usernamefailed");
        exit;
    }
}
