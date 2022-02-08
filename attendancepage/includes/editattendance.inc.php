<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

//jwt
$jwtarray = jwtdecrypt();
$attendanceID = $jwtarrayinformation['attendanceid'];


if ($role == 6 || $role == 5 || $role == 2) {
    //check if submit
    if (isset($_POST["submit"])) {


        //check if status is valid or absent
        try {
            $query = $conn->prepare("SELECT attendance_status FROM mydb.employee_attendance WHERE attendance_id=?");
            $query->bind_param('i',  $attendanceID);
            if ($query === false) {
                throw new Exception("Statement Preparation failed (editattendance)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                exit();
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=stmtallerror");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
            exit;
        }

        try {
            $execute = $query->execute();
            if ($execute  === false) {
                throw new Exception("Statement Execution failed (editattendance)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                exit();
            }
        } catch (Exception $e) {
            header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=badstatement");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
            exit;
        }
        $query->bind_result($attendanceStatus);
        $query->fetch();
        $query->close();

        if ($attendanceStatus == "Valid" or $attendanceStatus == "Absent") {
            header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=invalid");
            exit;
        }




        //check if status is empty
        if (empty($_POST['attendStatus'])) {
            header("location: https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "&error=emptyinput");
            error_log("TPAMC:ATTENDANCE:0:$ip:Error(emptyinput)", 0);
            exit();
        } elseif ($_POST['attendStatus'] === "valid") {


            try {
                $query = $conn->prepare("SELECT attendance_out_time FROM mydb.employee_attendance WHERE attendance_id=?");
                $query->bind_param('i',  $attendanceID);
                if ($query === false) {
                    throw new Exception("Statement Preparation failed (editattendance.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "error=stmtallerror");
                error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
                exit;
            }

            try {
                $execute = $query->execute();
                if ($execute  === false) {
                    throw new Exception("Statement Execution failed (editattendance.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                header("location: https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "error=badstatement");
                error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
                exit;
            }
            $query->bind_result($attendanceOutTime);
            $query->fetch();
            $query->close();

            if (!$attendanceOutTime == "") {
                $attendanceStatus = "Valid";

                try {
                    $query = $conn->prepare("UPDATE mydb.employee_attendance SET attendance_status=? WHERE attendance_id =?");
                    $query->bind_param('si', $attendanceStatus, $attendanceID);
                    if ($query === false) {
                        throw new Exception("Statement Preparation failed (editattendance.inc)");
                        error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                        exit();
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "error=stmtallerror");
                    error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
                    exit;
                }

                try {

                    if ($query->execute()) {
                        header("location:https://www.swapamc.com/swapproj/attendance/editemployee?status=valid");
                        exit();
                    }
                    if ($query->execute() === false) {
                        throw new Exception("Statement Execution failed (editattendance.inc)");
                        error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                        exit();
                    }
                } catch (Exception $e) {
                    header("location: https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "error=badstatement");
                    error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
                    exit;
                }
                $conn->close();
                unset($jwtarrayinformation['status']);
            } else {
                $attendanceStatus = "Clock In Verified";

                try {
                    $query = $conn->prepare("UPDATE mydb.employee_attendance SET attendance_status=? WHERE attendance_id =?");
                    $query->bind_param('si', $attendanceStatus, $attendanceID);
                    if ($query === false) {
                        throw new Exception("Statement Preparation failed (editattendance.inc)");
                        error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                        exit();
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "error=stmtallerror");
                    error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
                    exit;
                }

                try {

                    if ($query->execute()) {
                        header("location:https://www.swapamc.com/swapproj/attendance/editemployee?status=clockInVerified");
                        exit();
                    }
                    if ($query->execute() === false) {
                        throw new Exception("Statement Execution failed (editattendance.inc)");
                        error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                        exit();
                    }
                } catch (Exception $e) {
                    header("location: https://www.swapamc.com/swapproj/attendance/editattendance?attendanceid=" . $attendanceID . "error=badstatement");
                    error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
                    exit;
                }
                $conn->close();
            }





            //update status to absent

        } elseif ($_POST['attendStatus'] === "absent") {

            $attendanceStatus = "Absent";

            try {
                $query = $conn->prepare("UPDATE mydb.employee_attendance SET attendance_status=? WHERE attendance_id =?");
                $query->bind_param('si', $attendanceStatus, $attendanceID);
                if ($query === false) {
                    throw new Exception("Statement Preparation failed (editattendance.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/attendance/editstatus?attendanceid=" . $attendanceID . "error=stmtallerror");
                error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
                exit;
            }

            try {

                if ($query->execute()) {
                    header("location:https://www.swapamc.com/swapproj/attendance/editemployee?status=absent");
                    exit();
                }
                if ($query->execute() === false) {
                    throw new Exception("Statement Execution failed (editattendance.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                header("location: https://www.swapamc.com/swapproj/attendance/editstatus?attendanceid=" . $attendanceID . "error=badstatement");
                error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
                exit;
            }
            $conn->close();
            unset($jwtarrayinformation['status']);
        }
    } else {
        header("location: https://www.swapamc.com/swapproj/attendance?error=emptySubmit");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(emptySubmit)", 0);
        exit();
    }
} else {
    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    error_log("TPAMC:ATTENDANCE(editattendanceinc):0:$ip:Error(unauthorized)", 0);
    exit;
}
