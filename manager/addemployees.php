<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
$jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }


require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/manager/includes/employee.inc.php';

echo "<form method=POST action=../employeemanager/adduserinc>";
 echo "Username:"."<br>";
 echo "<input type=text name=username>"."<br><br>";
 echo "Working Role:"."<br>";
 echo "<input type=text name=role>"."<br><br>";
 echo "Number:"."<br>";
 echo "<input type=text name=number>"."<br><br>";
 echo "Department:"."<br>";
 echo "<input type=text name=department>"."<br><br>";
 echo "Hourly Wage:"."<br>";
 echo "<input type=text name=pay>"."<br><br>";
 echo "<input type=submit>";
echo "</form>";

if(isset($_GET['error'])){
    if($_GET['error']=='haventcreated'){
        echo "Make sure employee creates an account first!";
    }

    if($_GET['error']=='alreadyemployee'){
        echo "Employee already exists!";
    }

    
    
}





?>