
<style>
    label {
        display: flex;
        align-items: center;
    }

    span::after {
        padding-left: 5px;
    }

    input:invalid+span::after {
        content: '✖';
    }

    input:valid+span::after {
        content: '✓';
    }
</style>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';




$jwtarray = jwtdecrypt();
$userid = $jwtarrayinformation['userid'];


date_default_timezone_set('Asia/Singapore');


if ($role == 6 || $role == 5 || $role == 4 || $role == 3 || $role == 2 || $role == 1) {

    echo "<h2>Take Leave</h2>";
    echo "<form method='POST' action='/swapproj/attendance/takeleaveinc'>";
    echo "<input type='date' name='leaveDate' id='leaveDate' required pattern='\d{2}/\d{2}/\d{4}'>";
    echo "<span class='validity'></span>";
    echo "<br><br>";
    echo "<input type='submit' name='request' value='Request'>";
    echo "</form>";

    try {
        $query = $conn->prepare("SELECT leave_id,leave_date,leave_status FROM mydb.employee_leave WHERE leave_userid =?");
        $query->bind_param('i', $userid);
        if ($query === false) {
            throw new Exception("Statement Preparation failed (takeleave)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=stmtallerror");
        error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(stmtallerror)", 0);
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
        header("location: https://www.swapamc.com/swapproj/attendance/takeleave?error=badstatement");
        error_log("TPAMC:ATTENDANCE(TakeLeave):0:$ip:Error(badstatement)", 0);
        exit;
    }
    $query->store_result();
    $query->bind_result($leaveID, $leaveDate, $leaveStatus);


    echo "<h3>Leave Requests</h3>";
    if ($query->num_rows === 0) exit('Empty');
    echo "<table border=1;>";
    echo "<tr>";
    echo "<td>Date</td>";
    echo "<td>Status</td>";
    echo "</tr>";

    while ($query->fetch()) {
        echo "<tr>";
        echo "<td>" . $leaveDate . "</td>";
        echo "<td>" . $leaveStatus . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    $query->close();
} else {
    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    error_log("TPAMC:CAMPUS:0:$ip:Error(unauthorized)", 0);
    exit();
}

if (isset($_GET["status"])) {
    if (($_GET["status"]) == "Approved") {
        echo "Leave Approved!";
    } elseif (($_GET["status"]) == "invalid") {
        echo "Attendance Invalid!";
    }
}
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<p>Please enter the date</p>";
    } elseif ($_GET["error"] == "invalidDate") {
        echo "<p>Date is invalid</p>";
    } elseif ($_GET["error"] == "badstatement") {
        echo "<p>Bad Statement</p>";
    } elseif ($_GET["error"] == "stmtallerror") {
        echo "<p>STMT All Error</p>";
    } elseif ($_GET["error"] == "statusSet") {
        echo "<p>Status has been set</p>";
    } elseif ($_GET["error"] == "baddate") {
        echo "<p>Date is invalid</p>";
    } elseif ($_GET["error"] == "dateused") {
        echo "<p>Date is used</p>";
    }
}
?>

<script>
    var today = new Date().toISOString();
    today = today.substring(0, today.length - 14);
    console.log(today);
    document.getElementById("leaveDate").min = today;
</script>

