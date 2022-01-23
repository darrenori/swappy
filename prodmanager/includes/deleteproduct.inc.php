<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


if(!isset($_GET['id'])||$_GET['id']==null){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;


}



//is id valid
if(isset($_GET['id'])&&$_GET['id']!=null){
    $prodid=$_GET['id'];

    if(badInputTwo([$prodid])==true){
        header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;
    }
    try {
        $query = $conn->prepare("SELECT product_id FROM mydb.products WHERE product_id = '$prodid';");
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
    $query = $conn->prepare("DELETE FROM mydb.products WHERE `product_id` = '$prodid';");
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