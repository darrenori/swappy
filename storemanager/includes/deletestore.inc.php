<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

##ZEPH

### CSRF ####
if(validateCSRFGet()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        echo 'bad csrf';
        //dont redirect if on the same page
  
    } else {
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
    
}
### CSRF ####


// removes any other GET names and does html specialchars
$_GET = XSSPrevention($_GET, ['id']);
// runs all variables thru sqlescape string
$_GET = escapeString($conn, $_GET);
// ensures input is only XX characters long
$maxlengtharray['id'] = 11;
$bufferflag = checkLength($_GET,$maxlengtharray);
//makes sure item is not 
$emptyflag = checkEmpty($_GET, ['id']);


//is id valid
if ($emptyflag !== null) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=invalidid");
    exit();
}elseif ($bufferflag!==null){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=invalidid");
    exit();
}
//removes any nondigit characters.
$storeid = preg_replace('/[^\d]/', '', $_GET['id']);

try {
    $query = $conn->prepare("SELECT store_id FROM mydb.store WHERE store_id = ?;");
    $query -> bind_param('s',$storeid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storedelete)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}


try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(storedelete)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}

$query->bind_result($storeid);

if (!$query->fetch()) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}


$query->close();






//delete
try {
    $query = $conn->prepare("DELETE FROM mydb.store WHERE `store_id` = ?;");
    $query->bind_param('s',$storeid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storedelete)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (DELETE)", 0);
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}


try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(storedelete)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (DELETE)", 0);
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}

header("location: https://www.swapamc.com/swapproj/productmanager?error=none");
