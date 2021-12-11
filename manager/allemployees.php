<?php
    //session_start();
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)){
        
        $jwtarrayinformation = $jwtarray['array'];

    } else {
        header("location: ../product/viewcart");
    }

    

    

    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    
    $userid = $jwtarrayinformation['userid'];
    $role = $jwtarrayinformation['role'];
    if($role=='6'||$role=='5'||$role=='3'){
        
    } else {
        header("location: https://www.swapamc.com/swapproj/login");
    }

    $query =$conn->prepare("SELECT * FROM mydb.working_employees;");


    if($query->execute()){
        $query->bind_result($id,$username,$role,$number,$department,$perhourpay);
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
            echo "<td>"."<a href='https://www.swapamc.com/swapproj/employeemanager/edit?user=$id'><input type=button name=edit value=edit></a><br>";
            echo "<a href='https://www.swapamc.com/swapproj/employeemanager/deleteinc?user=$id'><input type=button name=delete value=delete></a><br>";
            echo "<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$id'><input type=button name=delete value=tasks></a>"."</td>";



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