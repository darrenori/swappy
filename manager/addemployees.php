<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';


echo "<div class='triangle'><div class='container5'>";
echo "<div class='item' id='example2'>";
echo "<div class='static'>Add New Employee</div>";

echo "<form method=POST action=https://www.swapamc.com/swapproj/employeemanager/adduserinc>";

    echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Username:</p></div>" ;
        echo "<div class='pairing2'><input type=text name=username placeholder='Username'></div>" ;
    echo "</div>";

    echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Working Role:</p></div>" ;
        echo "<div class='pairing2'><input type=text name=role placeholder='Working Role'></div>";
    echo "</div>";

    echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Number:</p></div>" ;
        echo "<div class='pairing2'><input type=text name=number placeholder='Number'></div>" ;
    echo "</div>";

    echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Department:</p></div>";
        echo "<div class='pairing2'><input type=text name=department placeholder='Department'></div>" ;
    echo "</div>";

    echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Hourly Wage:</p></div>" ;
        echo "<div class='pairing2'><input type=text name=pay placeholder='$12/hr'></div>";
    echo "</div>";


        echo "<input style='margin-left: 9px; width:97%' type=submit>";
echo "</form></div></div>";


echo "</div>";

if (isset($_GET['error'])) {
    $error=htmlentities($_GET["error"]);

    if ($error == 'haventcreated') {
        echo "Make sure employee creates an account first!";
    }

    if ($error == 'alreadyemployee') {
        echo "Employee already exists!";
    }
}
?>
<style>
    <?php include 'storemanager/addstore.css'; ?>
</style>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

