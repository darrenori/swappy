<?php
function checkId($array)
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

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


// if(!isset($_GET['id'])||$_GET['id']==null){
//     header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
//     exit;
// }

$whitelist=['id'];
$maxlengtharray['id']=11;
$methd = $_GET;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=emptyid");
    exit;
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkId([$validarray['id']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}

if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/productmanager?error=toolongid");
    exit;
}



$prodid = $validarray['id'];
// $prodid=$_GET['id'];

if(validateCSRFGet()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        
        //dont redirect if on the same page
  
    } else {
        error_log("TPAMC:".$filename.":4:$ipadd:2 CSRF", 0);
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
    
    
}



//is id valid
if(isset($_GET['id'])&&$_GET['id']!=null){
    $prodid=$_GET['id'];

    if(badInputTwo([$prodid])==true){
        header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;
    }
    try {
        $query = $conn->prepare("SELECT product_id FROM mydb.products WHERE product_id = ?;");
        $query->bind_param('s',$prodid);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(productedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }


    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Preparation failed(productedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }
} else {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;

}
$query->bind_result($id);

if(!$query->fetch()){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}


$query->close();






//delete
try {
    $query = $conn->prepare("DELETE FROM mydb.products WHERE `product_id` = ?;");
    $query->bind_param('s',$prodid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(productedit)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    // header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    // exit;
}


try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(productedit)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    // header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    // exit;
}

header("location: https://www.swapamc.com/swapproj/productmanager?error=none");