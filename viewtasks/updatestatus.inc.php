<?php



require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';



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
    $tid = $array[0];
    $wid = $array[1];
    $progress= $array[2];
}


//does it exist

try {
    $query = $conn->prepare("SELECT task_id FROM mydb.employees_task WHERE task_id = ? AND working_id = ?;");
    $query->bind_param('ss',$tid,$wid);
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

$query->bind_result($tid);

if(!$query->fetch()){
    echo 'does not exist';
}

$query->close();

try {
    $query = $conn->prepare("UPDATE mydb.employees_task SET task_progress = ? WHERE task_id = ?");
    $query->bind_param('ss',$progress,$tid);
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

