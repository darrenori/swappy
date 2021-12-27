<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';



echo "<form method=POST action=https://www.swapamc.com/swapproj/employeemanager/adduserinc>";
echo "Username:" . "<br>";
echo "<input type=text name=username>" . "<br><br>";
echo "Working Role:" . "<br>";
echo "<input type=text name=role>" . "<br><br>";
echo "Number:" . "<br>";
echo "<input type=text name=number>" . "<br><br>";
echo "Department:" . "<br>";
echo "<input type=text name=department>" . "<br><br>";
echo "Hourly Wage:" . "<br>";
echo "<input type=text name=pay>" . "<br><br>";
echo "<input type=submit>";
echo "</form>";

if (isset($_GET['error'])) {
    $error=htmlentities($_GET["error"]);

    if ($error == 'haventcreated') {
        echo "Make sure employee creates an account first!";
    }

    if ($error == 'alreadyemployee') {
        echo "Employee already exists!";
    }
}
