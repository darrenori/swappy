<?php
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';


$userid = $jwtarrayinformation['userid'];
$role = $jwtarrayinformation['role'];

//calls function from employeefunctions.inc.php
checkIfEmployeeIdExists($conn);


if ($role == 6 || $role == 5 || $role == 3) {

    if (!isset($_GET['user'])) {
        header("location: https://www.swapamc.com/swapproj/taskmanager?error=nouserselected");
        exit;
    }
    //if checkIfIdExists has run, the following line of code will be safe

    $employeeid = $_GET['user'];
    $jwtarrayinformation['employeeid'] = $employeeid;
    if (badInput([$employeeid]) === true) {
        header("location: https://www.swapamc.com/swapproj/taskmanager?error=badinput");
        exit;
    }
    ///here's where all the juicy code is.


    try {
    $query = $conn->prepare("SELECT user_username,task_id,task_name,task_details,task_progress,task_assignedby,task_dateassigned,task_datetofinish,task_dateedited
        FROM mydb.working_employees
        LEFT OUTER JOIN mydb.employees_task
        ON working_employees.working_id = employees_task.working_id
        INNER JOIN mydb.users
        ON mydb.working_employees.user_id = mydb.users.user_id 
        WHERE working_employees.working_id = " . $employeeid . ";");
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(alltasks)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/employeemanager?page=tasks&error=badstatement");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (alltasks)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/employeemanager?page=tasks&error=badstatement"); //    echo mysqli_error($query);
        
            exit;
        }
        

        

        $query->bind_result($employeeusername, $taskid, $name, $details, $progress, $assignedby, $dateassigned, $datefinish, $edited);

        echo "<table>";
        echo "<tr>";
        echo "<th>" . "Task" . "</th>";
        echo "<th>" . "Details" . "</th>";
        echo "<th>" . "Progress" . "</th>";
        echo "<th>" . "Assigned by" . "</th>";
        echo "<th>" . "Date assigned" . "</th>";
        echo "<th>" . "To finish by" . "</th>";
        echo "<th>" . "Edit" . "</th>";
        echo "<th>" . "Delete" . "</th>";
        echo "<th>" . "Edited on" . "</th>";

        echo "</tr>";

        while ($query->fetch()) {
            $jwtarrayinformation['userusername'] = $employeeusername;
            //checks if task exists, otherwise does not run
            if (!$taskid) {
                break;
            }
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $details . "</td>";



            if ($progress == 0) {
                echo "<td>" . 'Received' . "</td>";
            } elseif ($progress == 1) {
                echo "<td>" . 'In Progress' . "</td>";
            } elseif ($progress == 2) {
                echo "<td>" . 'Waiting for check' . "</td>";
            }

            echo "<td>" . $assignedby . "</td>";
            echo "<td>" . $dateassigned . "</td>";
            echo "<td>" . $datefinish . "</td>";


            echo "<td>" . "<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittask?task=$taskid'><input type=button name=edit value=edit></a>" . "</td>";
            echo "<td>" . "<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager/deletetask?task=$taskid'><input type=button name=edit value=delete></a>" . "</td>";
            if (isset($edited)) {
                echo "<td>" . $edited . "</td";
            } else {
                echo "<td>" . "Not edited Yet" . "</td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    }
    echo "<h2>Username of employee: " . $employeeusername . "</h2>";

    echo "<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager/addtask'>Add task</a>";
    echo "<br><a href='https://www.swapamc.com/swapproj/employeemanager'>Back to Employee Management</a>";



    echo "<h3> PHP List All Session Variables</h3>";
    foreach ($jwtarrayinformation as $key => $val){
        echo "Key: ".$key;
        if (gettype($val)!=="array") {
        echo  " " . $val . "<br/>";
        }else{
            foreach ($val as $k => $v){
                if (gettype($v)!=="array") {
                echo "- Key of val: ".$k . " " . $v . "<br/>";
                }
            }
        }
    }
    jwtupdate($jwtarrayinformation);






?>

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>