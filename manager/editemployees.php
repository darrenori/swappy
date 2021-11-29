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


if(isset($_GET['user'])){

    $employeeid = $_GET['user'];
}

if(badInput([$employeeid])==0){
    $_SESSION['employeeid'] = $employeeid;
} else {
    //kick them out
}


$query = $conn->prepare("SELECT working_fname,working_lname,working_role,working_number,working_address FROM mydb.working_employees WHERE working_id = $employeeid;");
if(!$query){
    echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
}



if($query->execute()){
    $query->bind_result($fname,$lname,$role,$number,$address);
    
    echo "<form method=POST action=../employeemanager/editinc>";

    if($query->fetch()){
        echo "First Name:"."<br>";
        echo "<input type=text name=fname value=$fname>"."<br><br>";
        echo "Last Name:"."<br>";
        echo "<input type=text name=lname value=$lname>"."<br><br>";
        echo "Role:"."<br>";
        echo "<input type=text name=role value=$role>"."<br><br>";
        echo "Number:"."<br>";
        echo "<input type=text name=number value=$number>"."<br><br>";
        echo "Address:"."<br>";
        echo "<input type=text name=address value=$address>"."<br><br>";
    }

    echo "<input type=submit>";

    echo "</form>";
} else {
    echo mysqli_error($query);
}


?>