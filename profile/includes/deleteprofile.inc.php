<?php
##Originally deleteprofile and outside includes


require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';


$userid = $jwtarrayinformation["userid"];
$username=$jwtarrayinformation['username'];

try {
$query = $conn->prepare("DELETE FROM mydb.users WHERE user_id = $userid");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(deleteprofile.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (deleteprofile.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement"); //    echo mysqli_error($query);

    exit;
}



    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
