<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';




//jwt
$jwtarray = jwtdecrypt();

unset($jwtarrayinformation['employeeusername']);
unset($jwtarrayinformation['employeeid']);
$userid = $jwtarrayinformation['userid'];
$role = $jwtarrayinformation['role'];




//get time and date
date_default_timezone_set('Asia/Singapore');
$date = date('d/m/Y');
$month = date('m');
$year = date('Y');

$time = date('h:i:s a', time());
$jwtarrayinformation['currentdate'] = $date;
$jwtarrayinformation['currenttime'] = $time;
$jwtarrayinformation['currentmonth'] = $month;
$jwtarrayinformation['currentyear'] = $year;

jwtupdate($jwtarrayinformation);


//check for authorization
if ($role == 6 || $role == 5 || $role == 4 || $role == 3 || $role == 2 || $role == 1) {


    //show time and date
    echo "<h2>Take Attendance</h2>";
    echo "<h4>Current Time</h4>";
    echo $date . "<br>" . $time;
    echo "<form method='POST' action='attendanceinc'";
    echo "<br>" . "<br>";


    //db select date for validation
    try {
        $query = $conn->prepare("SELECT attendance_date FROM  mydb.employee_attendance WHERE attendance_userid =? AND attendance_date=?");
        $query->bind_param("is", $userid, $date);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(attendance)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
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
        header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
        exit;
    }
    $query->store_result();
    $query->bind_result($inDate);
    $query->fetch();
    if ($query->num_rows === 0);
    $query->close();




    // check if date exists 
    if ($date == $inDate) {

        //if date exists, take latest clock in time exists in db
        try {
            $query = $conn->prepare("SELECT attendance_in_time FROM  mydb.employee_attendance WHERE attendance_userid =?");
            $query->bind_param("i", $userid);
            if ($query === false) {
                throw new Exception("Statement Preparation failed (attendance)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                exit();
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
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
            header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
            exit;
        }
        $query->store_result();
        $query->bind_result($inTime);
        $query->fetch();
        if ($query->num_rows === 0) exit('Empty');
        $query->close();



        //check if clock in time is empty
        if (empty($inTime)) {
            echo "<input type='radio' name='clock' value='clockIn'> Clock In";
            echo "<br>";
            echo "<input type='submit' name='submit' value='submit'>";



            //if not empty, check if clock out time is empty
        } else {


            try {
                $query = $conn->prepare("SELECT attendance_out_time FROM  mydb.employee_attendance WHERE attendance_userid = ? AND attendance_date= ?");
                $query->bind_param("is", $userid, $inDate);
                if ($query === false) {
                    throw new Exception("Statement Preparation failed (attendance)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
                error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
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
                header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
                error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
                exit;
            }
            $query->store_result();
            $query->bind_result($outTime);
            $query->fetch();
            $query->close();




            //check out time if empty
            if ($outTime == "") {
                echo "<input type='radio' name='clock' value='clockOut'> Clock Out";
                echo "<br>" . "<br>";
                echo "<input type='submit' name='submit' value='submit'>";


                //if not empty, dont show clock in and out button
            } else {
                echo "You have clocked in and out for the day!";
            }
        }



        //if date dont exist
    } else {
        echo "<input type='radio' name='clock' value='clockIn'> Clock In";
        echo "<br><br>";
        echo "<input type='submit' name='submit' value='submit'>";
    }

    echo "</form>";



    if (isset($_GET["clockin"]) == "success") {
        echo "Clockin Success! Will be Reviewed by Manager";
    }
    if (isset($_GET["clockout"]) == "success") {
        echo "Clockout Success! Will be Reviewed by Manager";
    }

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Please select an option</p>";
        } elseif ($_GET["error"] == "badstatement") {
            echo "<p>Bad Statement</p>";
        } elseif ($_GET["error"] == "stmtallerror") {
            echo "<p>STMT All Error</p>";
        }
    }

   


    //redirect to take leave page 
    echo("<button onclick=\"location.href='/swapproj/attendance/takeleave'\">Request Leave</button>");






    //show user attendance history
    try {
        $query = $conn->prepare("SELECT attendance_id,attendance_date,attendance_in_time,attendance_out_time,attendance_status ,attendance_break FROM  mydb.employee_attendance WHERE attendance_userid =?");
        $query->bind_param("i", $userid);
        if ($query === false) {
            throw new Exception("Statement Preparation failed (attendance)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
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
        header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
        exit;
    }
    $query->store_result();
    $query->bind_result($attendanceID, $attendanceDate, $attendanceInTime, $attendanceOutTime, $attendanceStatus, $attendanceBreak);


    if ($query->num_rows === 0) exit('Empty');


    echo "<br><br>";
    echo "<h3>Past Attendance History</h3>";
    echo "<table border=1;>";
    echo "<tr>";
    echo "<td>Date</td>";
    echo "<td>Clock in Time</td>";
    echo "<td>Clock out Time</td>";
    echo "<td>Break(min)</td>";
    echo "<td>Status</td>";
    echo "</tr>";


    while ($query->fetch()) {
        echo "<tr>";
        echo "<td>" . $attendanceDate . "</td>";
        echo "<td>" . $attendanceInTime . "</td>";
        echo "<td>" . $attendanceOutTime . "</td>";
        echo "<td>" . $attendanceBreak . "</td>";
        echo "<td>" . $attendanceStatus . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";

    $query->close();




} else {

    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    error_log("TPAMC:CAMPUS:0:$ip:Error(unauthorized)", 0);
    exit();
}
?>

