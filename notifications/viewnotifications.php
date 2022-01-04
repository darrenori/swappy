<?php
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';


$userid = $jwtarrayinformation['userid'];

//add
try {
    $query = $conn->prepare("SELECT notification,header,level,type FROM mydb.notification WHERE user_id = '0' OR user_id='$userid';");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(viewnotification)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
    exit;
}



// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (viewnotification)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
    exit;
}

$query->bind_result($notification,$header,$level,$type);
while($query->fetch()){

    echo "<table>";

    echo "<tr>";
    echo "<th>Header</th>";
    echo "<th>Notification</th>";
    echo "<th>Level</th>";
    echo "<th>Type</th>";

    echo "</tr>";



    echo "<tr>";
    echo "<td>$header</td>";
    echo "<td>$notification</td>";
    if($level==0){
        echo "<td>Low</td>";

    } else if ($level==1){
        echo "<td>Medium</td>";

    } else if ($level==2) {
        echo "<td>High</td>";

    } else {
        echo "<td>Error. Contact Administrator</td>";

    }
    
    if($type==0){
        echo "<td>Maintenance</td>";

    } else if ($type==1){
        echo "<td>Warning</td>";

    } else if ($type==2) {
        echo "<td>Others</td>";

    } else {
        echo "<td>Error. Contact Administrator</td>";

    }

    echo "</table>";

    echo "<br><br>";



}







?>
<html>
    <head>
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>

    </head>
</html>