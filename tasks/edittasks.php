<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/tasks/includes/tasks.inc.php';

if (!isset($_GET)) {
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=notaskselected");
    exit;
}
    //renders any scripts into html form of special char e.g., & = &amp
    foreach ($_GET as $key => $val) {
        if (gettype($key) == "string" && $key !== "0") {
            $goodkey = htmlentities($key);
            $_GET[$goodkey] = $_GET[$key];
            unset($_GET[$key]);
        }
        //only checks if of string type (integers will not run through htmlspecialchars)
        if (gettype($val) == "string") {
            $goodval = htmlentities($val);
            $_GET[$goodkey] = $goodval;
        }
        if (empty($val)) {
            $_GET[$goodkey] = "0";
        }
    }

    // $getuser = htmlentities($_GET["user"]);
    // $employeeid = $getuser;



// if(isset($_GET['task'])){
    

   
    
// }

//check if quantity valid
$whitelist=['task'];
$maxlengtharray['task']=11;
$methd = $_GET;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=empty".$empty);
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkId($validarray)!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=malicious");
    exit();
}

if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=toolonger");
    exit();
}



$taskid=$validarray['task'];

$jwtarrayinformation['task'] = $taskid;
jwtupdate($jwtarrayinformation);
$csrf=generateCSRF();

// exit;


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
        echo "<input type='hidden' name='csrf' value='$csrf'>";


        echo "</form>";
        echo "<br><a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=".$employeeid."'>Back</a>";

        

        
        
    }
}

