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



require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';

echo "<form method=POST action=../employeemanager/adduserinc>";
 echo "First Name:"."<br>";
 echo "<input type=text name=fname>"."<br><br>";
 echo "Last Name:"."<br>";
 echo "<input type=text name=lname>"."<br><br>";
 echo "Role:"."<br>";
 echo "<input type=text name=role>"."<br><br>";
 echo "Number:"."<br>";
 echo "<input type=text name=number>"."<br><br>";
 echo "Address:"."<br>";
 echo "<input type=text name=address>"."<br><br>";
 echo "<input type=submit>";
echo "</form>";



?>