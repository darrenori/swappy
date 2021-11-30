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
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/tasks/includes/tasks.inc.php';


if(isset($_GET['task'])){
    

    if(badInput([$_GET['task']])==0){
        $taskid = $_GET['task'];
        $_SESSION['task'] = $_GET['task'];
       

    }
    
}





$query = $conn->prepare("SELECT task_name,task_details,task_progress,task_assignedby FROM mydb.employees_task WHERE task_id = $taskid;");

if($query->execute()){
    $query->bind_result($name,$details,$progress,$assignedby);

    if($query->fetch()){
        //0 is received 1 is in progress 2 is waiting for check

        echo "<form method=POST action='https://www.swapamc.com/swapproj/employeemanager/taskmanager/edittaskinc'>";
        echo "Task name"."<br><br>";
        echo "<input type=text name='name' value=$name>"."<br><br>";

        echo "Details"."<br><br>";
        echo "<input type=text name='details' value=$details>"."<br><br>";

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

        

        
        
    }
}



?>