<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

$jwtarray = jwtdecrypt();
$userid = $jwtarrayinformation['userid'];
$attendanceCurrentMonth = $jwtarrayinformation['currentmonth'];
$attendanceCurrentYear = $jwtarrayinformation['currentyear'];
//calculate how long they work

//get the attendance id information based on current month and year

try {
    $query = $conn->prepare("SELECT attendance_id,attendance_date,attendance_in_time,attendance_out_time,attendance_break,attendance_userid,attendance_current_month,attendance_current_year FROM  mydb.employee_attendance WHERE attendance_current_month =? AND attendance_current_year =? AND attendance_userid=? ");
    $query->bind_param("ssi", $attendanceCurrentMonth, $attendanceCurrentYear, $userid);
    if ($query === false) {
        throw new Exception("Statement Preparation failed (calculatepay)");
        error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
        exit();
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
    error_log("TPAMC:ATTENDANCE(calculatepay):0:$ip:Error(stmtallerror)", 0);
    exit;
}

try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (calculatepay)");
        error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
        exit();
    }
} catch (Exception $e) {
    header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
    error_log("TPAMC:ATTENDANCE(calculatepay):0:$ip:Error(badstatement)", 0);
    exit;
}
$query->store_result();
$query->bind_result($attendanceID, $attendanceDate, $attendanceInTime, $attendanceOutTime, $attendanceBreak, $attendanceUserID, $attendanceMonth, $attendanceYear);
if ($query->num_rows === 0) exit('Empty');

echo "<table border=1;>";
echo "<tr>";
echo "<td>User ID</td>";
echo "<td>Date</td>";
echo "<td>Clock in Time</td>";
echo "<td>Clock out Time</td>";
echo "<td>Break(min)</td>";
echo "<td>Month</td>";
echo "<td>Year</td>";
echo "</tr>";

$totalTime = 0;
while ($query->fetch()) {
    echo "<tr>";
    echo "<td>" . $attendanceUserID . "</td>";
    echo "<td>" . $attendanceDate . "</td>";
    echo "<td>" . $attendanceInTime . "</td>";
    echo "<td>" . $attendanceOutTime . "</td>";
    echo "<td>" . $attendanceBreak . "</td>";
    echo "<td>" . $attendanceMonth . "</td>";
    echo "<td>" . $attendanceYear . "</td>";
    $time = round((strtotime($attendanceOutTime) - strtotime($attendanceInTime)) / 60 / 60, 2);
    $totalTime = ($time + $totalTime);
    echo "</tr>";
}
echo "</table>";
$query->close();

//calculatepayrate
try {
    $query = $conn->prepare("SELECT working_perhourpay FROM mydb.working_employees 
    INNER JOIN mydb.employee_attendance
    ON mydb.working_employees.working_id = mydb.employee_attendance.attendance_workingid
    AND mydb.working_employees.user_id = mydb.employee_attendance.attendance_userid;");

    if ($query === false) {
        throw new Exception("Statement Preparation failed(calculatepay)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/attendance?error=stmtallerror");
    error_log("TPAMC:ATTENDANCE(calculatepay):0:$ip:Error(stmtallerror)", 0);
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (calculatepay)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/attendance?error=badstatement");
    error_log("TPAMC:ATTENDANCE(calculatepay):0:$ip:Error(badstatement)", 0);
    exit;
}
$query->bind_result($employeePay);
$query->fetch();
$query->close();
$totalPay = $employeePay * $totalTime;
echo  $totalTime . "hr";
echo "<br><br>";
echo "Pay: $";
echo $totalPay;