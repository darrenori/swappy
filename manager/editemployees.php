<?php
session_start();

if (!isset($_SESSION['loginstate'])) {
    header("location: https://www.swapamc.com/swapproj/login");
    exit();
} elseif ($_SESSION['loginstate'] === "A") {
    header("location: https://www.swapamc.com/swapproj/emailverification");
    exit();
} elseif ($_SESSION['loginstate'] === "B") {
    header("location: https://www.swapamc.com/swapproj/googleauthentication");
    exit();
} elseif (!$_SESSION['loginstate'] === "OK") {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}



require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employee.inc.php';


if (isset($_GET['user'])) {
    $employeeid = $_GET['user'];
}

if (badInput([$employeeid]) !== false) {
    header("location: https://www.swapamc.com/swapproj/employeemanager");
    exit;
}
$_SESSION['employeeid'] = $employeeid;



$query = $conn->prepare("SELECT user_username, working_role,working_number,working_department,working_perhourpay FROM mydb.working_employees 
    INNER JOIN mydb.users
    ON mydb.working_employees.user_id = mydb.users.user_id 
    WHERE  mydb.working_employees.working_id =" . $employeeid . ";");
if (!$query) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>";
}



if ($query->execute()) {
    $query->bind_result($username, $role, $number, $department, $perhourpay);

    echo "<form method=POST action=../employeemanager/editinc>";

    if ($query->fetch()) {

        echo "<h3>Username: ".$username."</h3>";
        echo "Role:" . "<br>";
        echo "<input type=text name=role value=$role>" . "<br><br>";
        echo "Number:" . "<br>";
        echo "<input type=text name=number value=$number>" . "<br><br>";
        echo "Department:" . "<br>";
        echo "<input type=text name=department value=$department>" . "<br><br>";
        echo "Hourly wage:" . "<br>";
        echo "<input type=text name=pay value=$perhourpay>" . "<br><br>";
    }

    echo "<input type=submit>";

    echo "</form>";
} else {
    echo mysqli_error($query);
}
