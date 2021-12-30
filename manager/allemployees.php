<?php
    //session_start();
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

    

    

    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    
    $userid = $jwtarrayinformation['userid'];
    $role = $jwtarrayinformation['role'];
    if($role=='6'||$role=='5'||$role=='3'){
        
    } else {
        header("location: https://www.swapamc.com/swapproj/login");
    }

    $query =$conn->prepare("SELECT user_username,working_id,mydb.working_employees.user_id,working_role,working_number,working_department,working_perhourpay FROM mydb.working_employees
    INNER JOIN mydb.users
    ON mydb.working_employees.user_id = mydb.users.user_id;");


    if($query->execute()){
        $query->bind_result($username,$workingid,$employeeid,$role,$number,$department,$perhourpay);
        echo "<table>";
        echo "<tr>";
        echo "<th>"."Username"."</th>";
        echo "<th>"."Role"."</th>";
        echo "<th>"."Number"."</th>";
        echo "<th>"."Department"."</th>";
        echo "<th>"."Hourly Wage"."</th>";
        echo "</tr>";


        


        while($query->fetch()){

            echo "<tr>";

            echo "<td>".$username."</td>";
            echo "<td>".$role."</td>";
            echo "<td>".$number."</td>";
            echo "<td>".$department."</td>";
            echo "<td> $".$perhourpay."</td>";
            echo "<td>"."<a href='https://www.swapamc.com/swapproj/employeemanager/edit?user=$workingid'><input type=button name=edit value=edit></a><br>";
            echo "<a href='https://www.swapamc.com/swapproj/employeemanager/deleteinc?user=$workingid'><input type=button name=delete value=delete></a><br>";
            echo "<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$workingid'><input type=button name=delete value=tasks></a>"."</td>";



            echo "</tr>";

            
            
        }
    }

    echo "<a href='https://www.swapamc.com/swapproj/employeemanager/adduser'><input type=button name=edit value=Add users></a>";





?>

<html>
    <head>
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>

    </head>
</html>