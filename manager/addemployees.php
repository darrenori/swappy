<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';
$csrf = generateCSRF();

// removes any other GET and POST names and does html specialchars
$whitelist =['error'];
$_GET = XSSPrevention($_GET, $whitelist);
//cleans GET items
$retrieveditem = preg_replace('/[^a-z]+/', '', $_GET['error']);
//Specifies whitelisted Get[error] values
$whitelistvalues=['haventcreated','alreadyemployee'];
$exemptkeys=['key','email']; // no exemptkeys are specified.
cleanValues($_GET,$whitelistvalues,$exemptkeys);



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
echo "<input type='hidden' name='csrf' value='$csrf'>";
echo "</form>";

if (isset($_GET['error'])) {
    //htmlspecialchars done in XSSPrevention() function
    $error=$_GET["error"];

    if ($error == 'haventcreated') {
        echo "Make sure employee creates an account first!";
    }

    if ($error == 'alreadyemployee') {
        echo "Employee already exists!";
    }
}
