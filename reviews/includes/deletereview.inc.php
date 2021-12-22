<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/product/product.function.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

$useridsignedin = $jwtarrayinformation['userid'];


if(isset($_GET['id'])&&$_GET['id']!=null){
    if(badInputTwo([$_GET['id']])==1){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
        exit();

    }
}




