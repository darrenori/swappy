<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/tasks/includes/tasks.inc.php';


if(isset($_GET['task'])){
    

    if(badTaskInput([$_GET['task']])===false){
        $taskid = $_GET['task'];
        $jwtarrayinformation['task'] = $_GET['task'];
        jwtupdate($jwtarrayinformation);
    }
    
}




try {
$query = $conn->prepare("SELECT working_id,task_name,task_details,task_progress,task_assignedby FROM mydb.employees_task WHERE task_id = $taskid;");
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(edittasks)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (edittasks)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement"); //    echo mysqli_error($query);
        
            exit;
        }


if($query->execute()){
    $query->bind_result($employeeid,$name,$details,$progress,$assignedby);

    if($query->fetch()){
        //0 is received 1 is in progress 2 is waiting for check
        echo $name;
        echo "<form method=POST action='https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittaskinc'>";
        echo "Task name"."<br><br>";
        echo "<input type=text name='name' value='".$name."'>"."<br><br>";

        echo "Details"."<br><br>";
        echo "<input type=text name='details' multiple='multiple' value='".$details."'>"."<br><br>";

        echo "Progress"."<br><br>";


        if($progress==0){
            echo '<select name="progress">';
            echo '<option value="Received" selected>Received</option>';
            echo '<option value="In Progress">In Progress</option>';
            echo '<option value="Waiting for check">Waiting for check</option>';
            echo '</select>';

        }elseif($progress==1){
            echo '<select name="progress">';
            echo '<option value="Received">Received</option>';
            echo '<option value="In Progress" selected>In Progress</option>';
            echo '<option value="Waiting for check">Waiting for check</option>';
            echo '</select>';

        }elseif($progress==2){
            echo '<select name="progress">';
            echo '<option value="Received">Received</option>';
            echo '<option value="In Progress">In Progress</option>';
            echo '<option value="Waiting for check" selected>Waiting for check</option>';
            echo '</select>';

        }

        

        echo "<br><br>Assigned by"."<br><br>";
        echo "<input type=text name='assignedby' value=$assignedby>"."<br><br>";
        echo "<input type=submit value=submit>";


        echo "</form>";
        echo "<br><a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=".$employeeid."'>Back</a>";

        

        
        
    }
}

