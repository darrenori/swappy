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
    
    $userid = $_SESSION['userid'];
    $role = $_SESSION['role'];
    if($role==6||$role==5||$role==3){
        
    } else {
        echo "ur a fake";
    }

    $query =$conn->prepare("SELECT * FROM mydb.working_employees;");


    if($query->execute()){
        $query->bind_result($id,$fname,$lname,$employeerole,$number,$address);
        echo "<table>";
        echo "<tr>";
        echo "<th>"."First Name"."</th>";
        echo "<th>"."Last Name"."</th>";
        echo "<th>"."Employee Role"."</th>";
        echo "<th>"."Number"."</th>";
        echo "<th>"."Address"."</th>";
        echo "<th>"."Edit"."</th>";
        echo "<th>"."Delete"."</th>";
        echo "<th>"."Tasks"."</th>";
        echo "</tr>";


        


        while($query->fetch()){

            echo "<tr>";

            echo "<td>".$fname."</td>";
            echo "<td>".$lname."</td>";
            echo "<td>".$employeerole."</td>";
            echo "<td>".$number."</td>";
            echo "<td>".$address."</td>";
            echo "<td>"."<a href='https://www.swapamc.com/swapproj/employeemanager/edit?user=$id'><input type=button name=edit value=edit></a>"."</td>";
            echo "<td>"."<a href='https://www.swapamc.com/swapproj/employeemanager/deleteinc?user=$id'><input type=button name=delete value=delete></a>"."</td>";
            echo "<td>"."<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$id'><input type=button name=delete value=tasks></a>"."</td>";



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