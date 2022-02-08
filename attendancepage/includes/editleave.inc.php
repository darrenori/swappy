<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

//jwt
$jwtarray = jwtdecrypt();
$leaveID = $jwtarrayinformation['leaveid'];
if ($role == 6 || $role == 5 || $role == 2) {

    if (isset($_POST["submit"])) {

        try {
            $query = $conn->prepare("SELECT leave_status FROM mydb.employee_leave  WHERE leave_id =?");
            $query->bind_param('i', $leaveID);
            if ($query === false) {
                throw new Exception("Statement Preparation failed (editleave)");
                error_log("TPAMC:ATTENDANCE(editleave):2:$ip:failed statement", 0);
                exit();
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=stmtallerror");
            error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(stmtallerror)", 0);
            exit;
        }

        try {

            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (editleave.inc)");
                error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                exit();
            }
        } catch (Exception $e) {
            header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=badstatement");
            error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(badstatement)", 0);
            exit;
        }
        $query->store_result();
        $query->bind_result($leaveStatus);
        $query->fetch();
        $query->close();

        //check if leave is set before
        if ($leaveStatus == "Approved" or $leaveStatus == "Invalid") {
            header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=invalid");
            exit;
        }

        if (empty($_POST['leaveStatus'])) {
            header("location: https://www.swapamc.com/swapproj/attendance/editleave?leaveid=" . $leaveID . "&error=emptyinput");
            error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(emptyinput)", 0);
            exit();
        } elseif ($_POST['leaveStatus'] === "Approved") {

            $leaveStatus = "Approved";

            try {
                $query = $conn->prepare("UPDATE mydb.employee_leave SET leave_status=? WHERE leave_id =?");
                $query->bind_param('si', $leaveStatus, $leaveID);
                if ($query === false) {
                    throw new Exception("Statement Preparation failed (editleave.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/attendance/editleave?leaveid=" . $leaveID . "&error=stmtallerror");
                error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(stmtallerror)", 0);
                exit;
            }

            try {

                if ($query->execute()) {
                    header("location:https://www.swapamc.com/swapproj/attendance/editemployee?status=Approved");
                    exit;
                }
                if ($query->execute() === false) {
                    throw new Exception("Statement Execution failed (editleave.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                header("location: https://www.swapamc.com/swapproj/attendance/editleave?leaveid=" . $leaveID . "&error=badstatement");
                error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(badstatement)", 0);
                exit;
            }
            $conn->close();

            unset($jwtarrayinformation['status']);
            //update status to valid

        } elseif ($_POST['leaveStatus'] === "Invalid") {

            $leaveStatus = "Invalid";

            try {
                $query = $conn->prepare("UPDATE mydb.employee_leave SET leave_status=? WHERE leave_id =?");
                $query->bind_param('si', $leaveStatus, $leaveID);
                if ($query === false) {
                    throw new Exception("Statement Preparation failed (editleave.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/attendance/editleave?leaveid=" . $leaveID . "&error=stmtallerror");
                error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(stmtallerror)", 0);
                exit;
            }

            try {

                if ($query->execute()) {
                    header("location:https://www.swapamc.com/swapproj/attendance/editemployee?status=invalid");
                    exit();
                }
                if ($query->execute() === false) {
                    throw new Exception("Statement Execution failed (editleave.inc)");
                    error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
                    exit();
                }
            } catch (Exception $e) {
                header("location: https://www.swapamc.com/swapproj/attendance/editleave?leaveid=" . $leaveID . "&error=badstatement");
                error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(badstatement)", 0);
                exit;
            }
            $conn->close();
        }
        unset($jwtarrayinformation['status']);
    } else {
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee");
        exit;
    }
    header("location: https://www.swapamc.com/swapproj/campus");
    error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(unauthorized)", 0);
    exit;
}
