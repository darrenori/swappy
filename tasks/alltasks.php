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


$userid = $_SESSION['userid'];
$role = $_SESSION['role'];
if($role==6||$role==5||$role==3){
    
} else {
    echo "ur a fake";
}

if(isset($_GET['user'])){

    $employeeid = $_GET['user'];
    $_SESSION['employeeid'] = $_GET['user'];
}

if(badInput([$employeeid])==0){
    $_SESSION['employeeid'] = $employeeid;
} else {
    //kick them out
}


$query = $conn->prepare("SELECT task_id,task_name,task_details,task_progress,working_fname,task_assignedby,task_dateassigned,task_datefinish,task_dateedited
FROM mydb.employees_task 
INNER JOIN mydb.working_employees
ON working_employees.working_id = employees_task.working_id
WHERE working_employees.working_id = $employeeid;");

if($query->execute()){
    $query->bind_result($taskid,$name,$details,$progress,$fname,$assignedby,$dateassigned,$datefinish,$edited);

    echo "<table>";
        echo "<tr>";
        echo "<th>"."Task"."</th>";
        echo "<th>"."Details"."</th>";
        echo "<th>"."Progress"."</th>";
        echo "<th>"."Assigned by"."</th>";
        echo "<th>"."Date assigned"."</th>";
        echo "<th>"."To finish by"."</th>";
        echo "<th>"."Edit"."</th>";
        echo "<th>"."Delete"."</th>";
        echo "<th>"."Edited on"."</th>";

        echo "</tr>";

    while($query->fetch()){
        echo "<tr>";
        echo "<td>".$name."</td>";
        echo "<td>".$details."</td>";

        
        
        if($progress==0){
            echo "<td>".'Received'."</td>";
        } elseif($progress==1){
            echo "<td>".'In Progress'."</td>";

        } elseif($progress==2){
            echo "<td>".'Waiting for check'."</td>";

        }

        echo "<td>".$assignedby."</td>";
        echo "<td>".$dateassigned."</td>";
        echo "<td>".$datefinish."</td>";

        $_SESSION['employeefname'] = $fname;
        echo "<td>"."<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid'><input type=button name=edit value=edit></a>"."</td>";
        echo "<td>"."<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager/deletetask?task=$taskid'><input type=button name=edit value=delete></a>"."</td>";
        if(isset($edited)){
            echo "<td>".$edited."</td";
        
        } else {
            echo "<td>"."Not edited Yet"."</td>";
        }

        echo "</tr>";
        

        

    }

    echo "</table>";

    
}

echo "<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager/addtask'>Add</a>";








?>

<style>
            table,th,td {
                border:1px solid black;
            }
        </style>


