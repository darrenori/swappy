<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';



function badInputThree($array){
    $pattern = "/^[a-zA-Z0-9_\-, ]*$/i";

    foreach($array as $key=>$val){
        
        $a = !(preg_match($pattern,$val));

        if($a==1){
            return true;
        }
    }
    
    return false;

    //0 is valid input

}

function checkNumber($array)
{
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    $pattern = "/^[0-9]+$/i";

    foreach($array as $key => $value) {
        
        $a = !(preg_match($pattern, $value));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

}

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

    if(badInputThree($postinformation)==1){
        echo "error";
        exit;
    } 




} else {
    echo "error";
    exit;
}


$methd = $postinformation;
$whitelist=['value','name'];
$empty = checkEmpty($methd,$whitelist);
$maxlengtharray['value']=11;
$maxlengtharray['name']=300;

if($empty!=null){
//    header("location: https://www.swapamc.com/swapproj/productmanager?error=missing".$empty);
   exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkNumber([$validarray['value']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    exit();
}

if(badInputThree([$validarray['name']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    exit();
}


if(checkLength($validarray,$maxlengtharray)!=null){
    exit();
}


$name = $validarray['name'];
$value = $validarray['value'];



if(validateCSRFAjax($postinformation)==false){
    echo "CSRF BAD";
    exit;
}


// echo $name;
$name = md5($name);

try {
    $query = $conn->prepare("SELECT product_id FROM mydb.inventory WHERE productcode = ?;");
    $query->bind_param('s',$name);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
    //change header location accordingly
    
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
    
}

$result = $query->get_result();
$arrayone = $result->fetch_all(MYSQLI_ASSOC);
// print_r($arrayone);
if(sizeof($arrayone)<1||$arrayone==null){
    echo 'bad';
}

$query->close();

try {
    $query = $conn->prepare("UPDATE mydb.inventory SET quantityleft = ? WHERE productcode = ?;");
    $query->bind_param('ss',$value,$name);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
    //change header location accordingly
    
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);    
}

$query->close();
$prodid=$arrayone[0]['product_id'];


try {
    $query = $conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE product_id = ?;");
    $query->bind_param('s',$prodid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
    
}
$query->bind_result($qn);
$total=0;

while($query->fetch()){
    // echo $qn;
    $total = $total + $qn;

}




$query->close();

try {
    $query = $conn->prepare("UPDATE mydb.products SET total_quantity = ? WHERE product_id = ?;");
    $query->bind_param('ss',$total,$prodid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (quantity)");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
    
}













echo "success";

?>