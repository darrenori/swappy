<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employee.inc.php';
$userusername = $jwtarrayinformation['userusername'];

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
    echo $jwtarrayinformation['userusername'] . "<br>";


    echo "Assigned by:" . "<br>";
    echo $jwtarrayinformation['username'] . "<br>";

    echo "<br><br>";
    echo "<input type='submit'>";

    echo "</form>";


    if (isset($_GET['error'])) {
        if ($_GET['error'] = 'baddate') {
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