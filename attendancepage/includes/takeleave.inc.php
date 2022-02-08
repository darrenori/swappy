<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/tasks/includes/tasks.inc.php';


$jwtarray = jwtdecrypt();
$userid = $jwtarrayinformation['userid'];



date_default_timezone_set('Asia/Singapore');
$leaveDate = $_POST['leaveDate'];
$date = date('Y-m-d');
$verifyTime = checkDatee($date, $leaveDate);

if ($jwtarrayinformation['role'] < 1) {
    header("location: https://www.swapamc.com/swapproj/campus");
    error_log("TPAMC:ATTENDANCE(editattendance):0:$ip:Error(unauthorized)", 0);
    exit;
}

if (isset($_POST['request'])) {




    if (!empty($leaveDate)) {




        if ($verifyTime == 0) {
            header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=baddate");
            error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(BadDate)", 0);
            exit();
        } else {


            $leaveDate = date("d/m/Y", strtotime($leaveDate));

            //select date
            try {
                $query = $conn->prepare("SELECT leave_date FROM mydb.employee_leave WHERE leave_userid=? AND leave_date=?");
                $query->bind_param('is', $userid, $leaveDate);
                if ($query === false) {
                    //change filename accordingly
                    throw new Exception("Statement Preparation failed(takeleaveinc)");
                    error_log("TPAMC:ATTENDANCE(TakeLeave):2:$ip:failed statement", 0);
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=stmtallerror");
                error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(stmtallerror)", 0);
                exit;
            }

            try {
                $execute = $query->execute();
                if ($query->execute() === false) {
                    throw new Exception("Statement Execution failed (takeleaveinc)");
                    error_log("TPAMC:ATTENDANCE(TakeLeave):2:$ip:failed statement", 0);
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=badstatement");
                error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(badstatement)", 0);
                exit;
            }
            $query->store_result();
            $query->bind_result($leaveDatee);
            $query->fetch();
            $query->close();






            if (empty($leaveDatee)) {
                $leaveStatus = "To be Reviewed";

                try {
                    $query = $conn->prepare("INSERT INTO  mydb.employee_leave(leave_date,leave_status,leave_userid) VALUES (?,?,?)");
                    $query->bind_param('ssi', $leaveDate, $leaveStatus, $userid);
                    if ($query === false) {
                        throw new Exception("Statement Preparation failed (takeleaveinc)");
                        error_log("TPAMC:ATTENDANCE(TakeLeave):2:$ip:failed statement", 0);
                        exit();
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=stmtallerror");
                    error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(stmtallerror)", 0);
                    exit;
                }

                try {
                    if ($query->execute()) {
                        header("location: https://www.swapamc.com/swapproj/attendance/takeleave?request=success");
                        exit();
                    }
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (takeleaveinc)");
                        error_log("TPAMC:ATTENDANCE(TakeLeave):2:$ip:failed statement", 0);
                        exit();
                    }
                } catch (Exception $e) {
                    header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=badstatement");
                    error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(badstatement)", 0);
                    exit;
                }
                $query->close();
            } else {
                header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=dateused");
                error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(dateused)", 0);
                exit();
            }
        }
    } else {
        header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=invalidDate");
        error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(invalidDate)", 0);
        exit();
    }
} else {
    header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=emptyinput");
    error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(emptyinput)", 0);
    exit();
}


function checkDatee($date, $leaveDate)
{
    $date = floatval(strtotime($date));
    $leaveDate = floatval(strtotime($leaveDate));

    if ($leaveDate < $date || $leaveDate == $date) {
        return false;
    } elseif ($leaveDate > $date) {
        return true;
    }
}
