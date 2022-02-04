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

    //convert the nested json array inside to array
    $postinformation = json_decode($postinformation, true);
    

    //line for regex here
    //print_r($postinformation);

     




} else {
    echo "error";
    exit;
}

// print_r($postinformation);

$methd = $postinformation;
$whitelist=['string'];
$empty = checkEmpty($methd,$whitelist);
$maxlengtharray['string']=11;

if($empty!=null){
//    header("location: https://www.swapamc.com/swapproj/productmanager?error=missing".$empty);
   exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(badInputTwo([$validarray['string']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    exit();
}


if(checkLength($validarray,$maxlengtharray)!=null){
    exit();
}


$string = $validarray['string'];




if(validateCSRFAjax($postinformation)==false){
    echo "CSRF BAD<br>";
   
    exit;
}



$array = explode(",",$string);
    $tid = $array[0];
    $wid = $array[1];
    $progress= $array[2];



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

