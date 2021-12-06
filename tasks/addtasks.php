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
    $userusername = $_SESSION['userusername'];
    
    $userid = $_SESSION['userid'];
    $role = $_SESSION['role'];
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
    echo $_SESSION['userusername']."<br>";


    echo "Assigned by:"."<br>";
    echo $_SESSION['username']."<br>";
    
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