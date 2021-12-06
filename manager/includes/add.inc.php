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

foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";
    
    if($key!="quantity"){
        $postinformation[$key] = $value;
    }
}
$username = $postinformation['username'];
$role = $postinformation['role'];
$number = $postinformation['number'];
$department = $postinformation['department'];
$pay = $postinformation['pay'];


if(badInput([$username,$role,$number,$department,$pay])==0){
    
    
} else {
    //kick them out
}

$query=$conn->prepare("SELECT user_username FROM mydb.users WHERE user_username = '$username';");

if($query->execute()){
    //get row count
    // $resultSet = $query->get_result();
    // $result = $resultSet->fetch_all();
    // $rows = sizeOf($result);
    // echo $rows;



    $row = $query->fetch();

    


    if($row){
        echo "exists";
        $query->close();

        //is there an exisitng user in the table?
        $query=$conn->prepare("SELECT user_username FROM mydb.working_employees WHERE user_username = '$username';");
        if($query->execute()){

            $row = $query->fetch();

            if($row){
                header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=employeeexists");
                




            } else {

                echo "exists";
                $query->close();


                //if user is not exisitng in users table
                $query=$conn->prepare("INSERT INTO mydb.working_employees (user_username,working_role,working_number,working_department,working_perhourpay) VALUES ('$username','$role','$number','$department','$pay');");
                if($query->execute()){
                    echo "done";
                }
                header("location: https://www.swapamc.com/swapproj/employeemanager");
                
            }
        }






       
    } else {
        
        header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=usernamefailed");
    }


    

    
}



?>