<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


//is id valid
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=invalidid");
    exit();
}
$storeid = preg_replace('/[^\d]/', '', $_GET['id']);

try {
    $query = $conn->prepare("SELECT store_id FROM mydb.store WHERE store_id = '$storeid';");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storedelete)");
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
        throw new Exception("Statement Preparation failed(storedelete)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
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
    $query = $conn->prepare("DELETE FROM mydb.store WHERE `store_id` = '$storeid';");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storedelete)");
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
        throw new Exception("Statement Preparation failed(storedelete)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    // header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    // exit;
}

header("location: https://www.swapamc.com/swapproj/productmanager?error=none");
