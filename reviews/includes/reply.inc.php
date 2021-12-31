<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}




if(isset($_GET['id'])&&$_GET['id']!=null){
    if(badInputTwo([$_GET['id']])==1){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
        exit();

    }
} else {
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=emptyid");
    exit();
}


if(isset($_POST['comment'])&&$_POST['comment']!=null){
    if(badInputTwo([$_POST['comment']])==1){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
        exit();

    }
} else {
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=emptycomment");
    exit();
}


$reviewid = $_GET['id'];
$role = $jwtarrayinformation['role'];
$productid = $jwtarrayinformation['productid'];
$userid = $jwtarrayinformation['userid'];
$comment = $_POST['comment'];

if($role!=6){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=notpermitted");
    exit();

}

//check if reviewid exists, and who is its parent(if any)

$query=$conn->prepare("SELECT review_id,childof_id FROM mydb.reviews WHERE review_id='$reviewid';");

if(!$query){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    exit();
}

if($query->execute()){
    $query->bind_result($revid,$parent);

    if($query->fetch()){
        $revid = $revid;
        $parent = $parent;
    }
}

$query->close();

if(isset($parent)&&$parent!=null){
    $actualparent = $parent;

} else {
    $actualparent = $revid;
}

date_default_timezone_set('Asia/Singapore');
$now = time();
$now = date('Y-m-d', $now)." ".date('H:i:s');
$query=$conn->prepare("INSERT INTO mydb.reviews (review_product_id,review_user_id,review_comment,review_rating,review_pic,review_total_likes,review_total_dislikes,review_date,childof_id) VALUES ('$productid','$userid','$comment','','','0','0','$now','$actualparent');");

if(!$query){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    exit();
}

if($query->execute()){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);

} else {
    echo 'smthin went wrong';
}



?>