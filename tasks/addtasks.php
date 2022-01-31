<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';
$employeeusername = $jwtarrayinformation['employeeusername'];

if (isset($_GET)) {
    # code...
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

$userid = $jwtarrayinformation['userid'];
$role = $jwtarrayinformation['role'];
if ($role == 6 || $role == 5 || $role == 3) {



    echo "<form action='/swapproj/employeemanager/taskmanager/addtaskinc' method=POST>";
    echo "Task name" . "<br>";
    echo "<input type='text' name='taskname'>" . "<br>";

    echo "Task details" . "<br>";
    echo "<input type='text' name='taskdetails'>" . "<br>";





    echo "Date to Finish by" . "<br>";
    echo "<input type='datetime-local'  id='date' name='date'>";

    echo "<br><br>";

    echo "Assigned to:" . "<br>";
    echo $employeeusername . "<br>";


    echo "Assigned by:" . "<br>";
    echo $jwtarrayinformation['username'] . "<br>";

    echo "<br><br>";
    echo "<input type='submit'>";
    $csrf=generateCSRF();
    echo "<input type='hidden' name='csrf' value='$csrf'>";

    echo "</form>";

    #checked by debugger, deemed unharmful
    if (isset($_GET['error'])) {
        if ($_GET['error'] === 'baddate') {
            echo "INVALID DATE";
        }
    }

    jwtupdate($jwtarrayinformation);
} else {
    echo "ur a fake";
    header("location: https://www.swapamc.com/swapproj/campus?error=unauthoriseduser");
    exit();
}
?>

<script>
    var today = new Date().toISOString();
    today = today.substring(0, today.length - 8);

    console.log(today)
    document.getElementById("date").min = today;
</script>