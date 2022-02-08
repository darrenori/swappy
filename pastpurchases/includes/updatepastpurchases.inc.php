<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';



if($jwtarrayinformation['role']<1){
    header("location: https://www.swapamc.com/swapproj/campus");
    error_log("TPAMC:ATTENDANCE(editattendance):0:$ip:Error(unauthorized)", 0);
    exit;
}

if(isset($_POST)){
    $postinformation = $_POST;
    $postinformation = json_decode(json_encode($postinformation), true);
    if(isset($postinformation['info'])){
        
        $postinformation = $postinformation['info'];
    } else {
        echo "error";
    }

    $postinformation = json_decode($postinformation, true);


}


if(badInputTwo([$postinformation])){
    echo "error bad";
} else {
    $array = explode(",",$postinformation);
    $pid = $array[0];
    $uid = $array[1];
    $status= $array[2];
}


//does it exist

try {
    $query = $conn->prepare("SELECT purchase_id FROM mydb.user_past_purchases WHERE purchase_id = ?;");
    $query->bind_param('s',$pid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(viewtask)");
        exit;
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    exit;
    //change header location accordingly
}


try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(viewtask)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
}

$query->bind_result($pid);

if(!$query->fetch()){
    echo 'does not exist';
}

$query->close();

try {
    $query = $conn->prepare("UPDATE mydb.user_past_purchases SET purchase_status = ? WHERE purchase_id = ?");
    $query->bind_param('ss',$status,$pid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(viewtask)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    exit;
    //change header location accordingly
}


try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(viewtask)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    exit;
}

echo 'success';



?>

