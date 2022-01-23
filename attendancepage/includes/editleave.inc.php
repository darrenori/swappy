<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

//jwt
$jwtarray = jwtdecrypt();
$leaveID = $jwtarrayinformation['leaveid'];


if (isset($_POST["submit"])) {
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
} else {
    header("location: https://www.swapamc.com/swapproj/attendance");
    exit();
}
