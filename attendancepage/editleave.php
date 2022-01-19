<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';


    if ($role == 6 || $role == 5 || $role == 2) {
        
        $leaveID = htmlspecialchars($_GET["leaveid"]);
        $jwtarray = jwtdecrypt();
        $jwtarrayinformation['leaveid'] = $leaveID;
        jwtupdate($jwtarrayinformation);

        //select leave status to perform checking later
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

        if ($leaveStatus == "To be Reviewed") {
            
            echo "<h3>Edit Employee's Attendance</h3>";
            echo "<form method='POST' action='/swapproj/attendance/editleaveinc'>";
            echo "<input type='radio' name='leaveStatus' value='Approved'> Approve";
            echo "<br>";
            echo "<input type='radio' name='leaveStatus' value='Invalid'> Invalid";
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
                }
            }
        
        } else {
            header("location:https://www.swapamc.com/swapproj/attendance/takeleave?error=statusSet");
            error_log("TPAMC:ATTENDANCE(editleave):0:$ip:Error(statusSet)", 0);
            exit();
    }
}

