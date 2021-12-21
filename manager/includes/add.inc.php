<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';


require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
$jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }




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

//echo $username.$role.$number.$department.$pay;

if(badInput([$username,$role,$number,$department,$pay])==0){
    
    
} else {
    //kick them out
}


//if employee has created account already
//(they need to create account before havin employee role)
$query=$conn->prepare("SELECT user_id FROM mydb.users WHERE user_username = '$username';"); 


if($row=$query->execute()){
    //get row count
    // $resultSet = $query->get_result();
    // $result = $resultSet->fetch_all();
    // $rows = sizeOf($result);
    // echo $rows;



    
    $query->bind_result($userid);
    


    if($query->fetch()){

        echo $userid;
        //echo "exists";
        $query->close();

        //is there an exisitng user in the wokring table? so that there is only 1 employee row per user
        $query=$conn->prepare("SELECT user_id FROM mydb.working_employees WHERE user_id = '$userid';");
        if($query->execute()){

            

            if($query->fetch()){
                echo "user already employee";
                header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=alreadyemployee");
            } else {

                $query->close();
                $query=$conn->prepare("INSERT INTO mydb.working_employees (user_id,working_role,working_number,working_department,working_perhourpay) VALUES ('$userid','$role','$number','$department','$pay');");
                if($query->execute()){
                    header("location: https://www.swapamc.com/swapproj/employeemanager");
                }
                
            }

            

            // if($row){
            // header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=employeeexists");
                



                
             
        }






       
    } else {
        header("location: https://www.swapamc.com/swapproj/employeemanager/adduser?error=haventcreated");
        echo "employee needs to create account first!";
    }


    

    
} 



?>