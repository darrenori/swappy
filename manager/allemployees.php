<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';


if (!isset($jwtarrayinformation['loginstate'])) {
    header("location: https://www.swapamc.com/swapproj/login");
    exit();
} elseif ($jwtarrayinformation['loginstate'] === "A") {
    header("location: https://www.swapamc.com/swapproj/emailverification");
    exit();
} elseif ($jwtarrayinformation['loginstate'] === "B") {
    header("location: https://www.swapamc.com/swapproj/googleauthentication");
    exit();
} elseif (!$jwtarrayinformation['loginstate'] === "OK") {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
unset($jwtarrayinformation['userusername']);
unset($jwtarrayinformation['employeeid']);
unset($jwtarrayinformation['task']);
jwtupdate($jwtarrayinformation);

$userid = $jwtarrayinformation['userid'];
$role = $jwtarrayinformation['role'];
if($role=='6'||$role=='5'||$role=='3'){

    
} else {
    header("location: https://www.swapamc.com/swapproj/login");
}

$query = $conn->prepare("SELECT mydb.users.user_id, user_username, working_id,working_role,working_number,working_department,working_perhourpay FROM mydb.working_employees 
    INNER JOIN mydb.users
    ON mydb.working_employees.user_id = mydb.users.user_id;");


if ($query->execute()) {
    $query->bind_result($user_id, $username, $id, $role, $number, $department, $perhourpay);
    echo "<table>";
    echo "<tr>";
    echo "<th>" . "Username" . "</th>";
    echo "<th>" . "Role" . "</th>";
    echo "<th>" . "Number" . "</th>";
    echo "<th>" . "Department" . "</th>";
    echo "<th>" . "Hourly Wage" . "</th>";
    echo "</tr>";





    while ($query->fetch()) {

        echo "<tr>";

        echo "<td>" . $username . "</td>";
        echo "<td>" . $role . "</td>";
        echo "<td>" . $number . "</td>";
        echo "<td>" . $department . "</td>";
        echo "<td> $" . $perhourpay . "</td>";
        echo "<td>" . "<a href='https://www.swapamc.com/swapproj/employeemanager/edit?user=$id'><input type='button' name='edit' value='edit'></a><br>";
        echo "<a href='https://www.swapamc.com/swapproj/employeemanager/deleteinc?user=$id'><input type='button' name='delete' value='delete'></a><br>";
        echo "<a href='https://www.swapamc.com/swapproj/employeemanager/taskmanager?user=$id'><input type='button' name='tasks' value='tasks'></a>" . "</td>";



        echo "</tr>";
    }
}

echo "<a href='https://www.swapamc.com/swapproj/employeemanager/adduser'><input type='button' name='edit' value='Add users'></a>";
echo "<a href='https://www.swapamc.com/swapproj/allproducts><input type='button' name='allproducts' value='Storefront'></a>";



echo "<h3> PHP List All Session Variables</h3>";
foreach ($jwtarrayinformation as $key => $val)
    echo $key . " " . $val . "<br/>";






?>

<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>

</head>

</html>