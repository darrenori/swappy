<?php
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

    
    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/tasks/includes/tasks.inc.php';
    
    
    $userid = $_SESSION['userid'];
    $role = $_SESSION['role'];
    if($role==6||$role==5||$role==3){
        
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
    $now = date('Y-m-d', $now)." ".date('H:i:s');
    
    // echo $now;
    // echo strtotime($now)."<br>";
    // echo strtotime($selectedDate);
    $verifyTime = checkTime($now,$selectedDate);
    
    if($verifyTime==0){
        header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager/addtask?error=baddate");
    } else {
        echo "valid";
        $taskname = $_POST['taskname'];
        $taskdetails = $_POST['taskdetails'];
        $userusername = $jwtarrayinformation['userusername'];
        $employeeid = $jwtarrayinformation['employeeid'];
        $assignedby = $jwtarrayinformation['username'];
        

        print_r($postinformation);
        

        $query=$conn->prepare("INSERT INTO mydb.employees_task (working_id,task_name,task_details,task_progress,
        task_assignedby,task_dateassigned,task_datetofinish) VALUES ($employeeid,'$taskname','$taskdetails',0,'$assignedby','$now','$selectedDate');");

        if($query->execute()){
            echo "done";
        }

        
        header("location: https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$employeeid");
    }

    

    


    

   



?>