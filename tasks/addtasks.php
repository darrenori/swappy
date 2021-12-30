<?php
    session_start();

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }
    
    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';
    // $userusername = $jwtarrayinformation['userusername'];
    $employeeid = $jwtarrayinformation['employeeid'];
    

    $query=$conn->prepare("SELECT user_username FROM mydb.working_employees
    INNER JOIN mydb.users
    ON mydb.working_employees.user_id = mydb.users.user_id 
    WHERE working_id = '$employeeid';");


    if($query->execute()){
        $query->bind_result($employee_username);
        if($query->fetch()){
            $employee_username =  $employee_username;
            
            
        }
    }
    
    $userid = $jwtarrayinformation['userid'];
    $username = $jwtarrayinformation['username'];
    $role = $jwtarrayinformation['role'];
    if($role==6||$role==5||$role==3){
        
    } else {
        echo "ur a fake";
    }

    echo "<form action='/swapproj/employeemanager/taskmanager/addtaskinc' method=POST>";
    echo "Task name"."<br>";
    echo "<input type='text' name='taskname'>"."<br>";

    echo "Task details"."<br>";
    echo "<input type='text' name='taskdetails'>"."<br>";

    



    echo "Date to Finish by"."<br>";
    echo "<input type='datetime-local'  id='date' name='date'>";

    echo "<br><br>";

    echo "Assigned to:"."<br>";
    echo $employee_username."<br>";


    echo "Assigned by:"."<br>";
    echo $username."<br>";
    
    echo "<br><br>";
    echo "<input type='submit'>";
    
    echo "</form>";


    if(isset($_GET['error'])){
        if($_GET['error']='baddate'){
            echo "INVALID DATE";
        }
    }
?>

<script>
    var today = new Date().toISOString();
    today = today.substring(0, today.length - 8);

    console.log(today)
    document.getElementById("date").min = today;
</script>