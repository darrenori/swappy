<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';


//jwt
$jwtarray = jwtdecrypt();
$attendanceTime = $jwtarrayinformation['currenttime'];
$attendanceDate = $jwtarrayinformation['currentdate'];
$userid = $jwtarrayinformation['userid'];
$attendanceMonth = $jwtarrayinformation['currentmonth'];
$attendanceYear = $jwtarrayinformation['currentyear'];


//set variable
$attendanceBreak = "60";
$a = "";



if (isset($_POST["submit"])) {

    //check if empty
    if (empty($_POST['clock'])) {
        header("location:https://www.swapamc.com/swapproj/attendance?error=emptyinput");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(emptyinput)", 0);
        exit();
    }

    
    //post clock in
    if ($_POST['clock'] === "clockIn") {

        // get workingid 
        try {
            $query = $conn->prepare("SELECT working_id FROM mydb.working_employees WHERE user_id=?");
            $query->bind_param('i', $userid);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(attendance.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
            exit;
        }

        try {
            $execute = $query->execute();
            if ($query->execute() === false) {
                throw new Exception("Statement Execution failed (attendance.inc)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
            exit;
        }
        $query->store_result();
        $query->bind_result($workingID);
        $query->fetch();
        $query->close();


        //set attendance status
        $attendanceStatus = "To be Reviewed";


        //db to insert 
        try {
            $query = $conn->prepare("INSERT INTO mydb.employee_attendance(attendance_date,attendance_in_time,attendance_out_time,attendance_status,attendance_userid,attendance_break,attendance_current_month,attendance_current_year,attendance_workingid) VALUES (?,?,?,?,?,?,?,?,?)");
            $query->bind_param('ssssisssi', $attendanceDate, $attendanceTime, $a, $attendanceStatus, $userid, $attendanceBreak, $attendanceMonth, $attendanceYear, $workingID);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(attendance.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
            exit;
        }

        try {
            if ($query->execute()) {
                header("location:https://www.swapamc.com/swapproj/attendance?clockin=success");
                exit();
            }
            if ($query->execute() === false) {
                throw new Exception("Statement Execution failed (attendance.inc)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);

            exit;
        }
        $query->close();



        //post clock out
    } elseif ($_POST['clock'] === "clockOut") {

        //db to get attendance id
        try {
            $query = $conn->prepare("SELECT attendance_id,attendance_in_time FROM mydb.employee_attendance WHERE attendance_userid =?  AND attendance_date =? ");
            $query->bind_param('is', $userid, $attendanceDate);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(attendance.inc)");
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
                throw new Exception("Statement Execution failed (attendance.inc)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                exit();
            }
        } catch (Exception $e) {
            header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
            exit;
        }
        $query->bind_result($attendanceID, $attendanceInTime);
        $query->fetch();
        $query->close();

        $attendanceStatus = "To be Reviewed";


        //db to update clock out time
        try {
            $query = $conn->prepare("UPDATE mydb.employee_attendance SET attendance_out_time=?,attendance_status=? WHERE attendance_id =?");
            $query->bind_param('ssi', $attendanceTime,$attendanceStatus, $attendanceID);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(attendance.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
            exit;
        }

        try {
            if ($query->execute()) {
                header("location:https://www.swapamc.com/swapproj/attendance?clockout=success");
                exit();
            }
            if ($query->execute() === false) {
                throw new Exception("Statement Execution failed (attendance.inc)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                exit();
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
            exit;
        }

        $conn->close();
    }
}





