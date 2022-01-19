<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';


if ($role == 6 || $role == 5 || $role == 2) {

    $attendanceid = htmlspecialchars($_GET["attendanceid"]);
    $jwtarray = jwtdecrypt();
    $jwtarrayinformation['attendanceid'] = $attendanceid;
    jwtupdate($jwtarrayinformation);


    echo "<h3>Edit Employee's Attendance</h3>";
    echo "<form method='POST' action='/swapproj/attendance/editattendanceinc'>";
    echo "<input type='radio' name='attendStatus' value='valid'> Valid";
    echo "<br>";
    echo "<input type='radio' name='attendStatus' value='absent'> Absent";
    echo "<br>" . "<br>";
    echo "<input type='submit' name='submit' value='submit'>";
    echo "</form>";

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Please select an option</p>";
        } elseif ($_GET["error"] == "badstatement") {
            echo "<p>Bad Statement</p>";
        } elseif ($_GET["error"] == "stmtallerror") {
            echo "<p>STMT All Error</p>";
        }elseif ($_GET["error"] == "emptySubmit") {
            echo "<p>Empty Submit</p>";
        }
    }
}
