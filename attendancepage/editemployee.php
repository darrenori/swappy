<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

$jwtarray = jwtdecrypt();
$userid = $jwtarrayinformation['userid'];
$role = $jwtarrayinformation['role'];
date_default_timezone_set('Asia/Singapore');


//to approve leave for employee
if ($role == 6 || $role == 5 ||  $role == 2) {


    $attendanceStatus = "To be Reviewed";
    try {
        $query = $conn->prepare("SELECT attendance_id,attendance_date,attendance_in_time,attendance_out_time,attendance_status,attendance_userid,attendance_break FROM mydb.employee_attendance WHERE attendance_status=? ");
        $query->bind_param('s', $attendanceStatus);
        if ($query === false) {
            throw new Exception("Statement Preparation failed (attendance)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=stmtallerror");
        error_log("TPAMC:ATTENDANCE(editemployee):0:$ip:Error(stmtallerror)", 0);
        exit;
    }

    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (attendance)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=badstatement");
        error_log("TPAMC:ATTENDANCE(editemployee):0:$ip:Error(badstatement)", 0);

        exit;
    }
    $query->store_result();
    $query->bind_result($attendanceID, $attendanceDate, $attendanceInTime, $attendanceOutTime, $attendanceStatus, $attendanceUserID, $attendanceBreak);

    if ($query->num_rows === 0) {
        echo "<h3>To Be Reviewed Attendance</h3>";
        echo ('Empty');
    } else {

        //to be reviewed
        echo "<table border=1;>";
        echo "<tr>";
        echo "<td>User ID</td>";
        echo "<td>Date</td>";
        echo "<td>Clock in Time</td>";
        echo "<td>Clock out Time</td>";
        echo "<td>Break(min)</td>";
        echo "<td>Status</td>";
        echo "<td>Edit Status</td>";
        echo "</tr>";


        while ($query->fetch()) {
            echo "<tr>";
            echo "<td>" . $attendanceUserID . "</td>";
            echo "<td>" . $attendanceDate . "</td>";
            echo "<td>" . $attendanceInTime . "</td>";
            echo "<td>" . $attendanceOutTime . "</td>";
            echo "<td>" . $attendanceBreak . "</td>";
            echo "<td>" . $attendanceStatus . "</td>";
            echo "<td>" . "<a href='https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "'>Edit</a>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    $query->close();


    if (isset($_GET["status"])) {
        if (($_GET["status"]) == "clockInVerified") {
            echo "Clock in Verified Success";
        } elseif (($_GET["status"]) == "valid") {
            echo "Attendance Valid Success";
        } elseif (($_GET["status"]) == "absent") {
            echo "Attendance Absent Success";
        }
    }



    $leaveStatus = "To be Reviewed";

    try {
        $query = $conn->prepare("SELECT leave_id,leave_date,leave_status,leave_userid FROM mydb.employee_leave WHERE leave_userid =? AND leave_status=? ORDER BY leave_date ASC");
        $query->bind_param('is', $userid, $leaveStatus);
        if ($query === false) {
            throw new Exception("Statement Preparation failed (takeleave)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=stmtallerror");
        error_log("TPAMC:ATTENDANCE(editemployee):0:$ip:Error(stmtallerror)", 0);

        exit;
    }

    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (takeleave)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=badstatement");
        error_log("TPAMC:ATTENDANCE(editemployee):0:$ip:Error(badstatement)", 0);
        exit;
    }
    $query->store_result();
    $query->bind_result($leaveID, $leaveDate, $leaveStatus, $leaveUserID);


    //to be reviewed
    echo "<h3>To Be Reviewed Leave Request</h3>";
    if ($query->num_rows === 0) {
        echo ('Empty');

    } else {


        echo "<table border=1;>";
        echo "<tr>";
        echo "<td>User ID</td>";
        echo "<td>Date</td>";
        echo "<td>Status</td>";
        echo "<td>Edit Status</td>";
        echo "</tr>";


        while ($query->fetch()) {
            echo "<tr>";
            echo "<td>" . $leaveUserID . "</td>";
            echo "<td>" . $leaveDate . "</td>";
            echo "<td>" . $leaveStatus . "</td>";
            echo "<td>" . "<a href='https://www.swapamc.com/swapproj/attendance/editleave?leaveid=" . $leaveID . "'>Edit</a>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $query->close();
    }
    echo "<br><br>";

    if (isset($_GET["status"])) {
        if (($_GET["status"]) == "Approved") {
            echo "Leave set Approved !";
        } elseif (($_GET["status"]) == "invalid") {
            echo "Leave set Invalid !";
        }
    }
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "badstatement") {
            echo "<p>Bad Statement</p>";
        } elseif ($_GET["error"] == "stmtallerror") {
            echo "<p>STMT All Error</p>";
        }
    }

} else {

    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    error_log("TPAMC:CAMPUS:0:$ip:Error(unauthorized)", 0);
    exit();
}
