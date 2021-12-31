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

$reviewid = $_GET['id'];
$useridsignedin = $jwtarrayinformation['userid'];
$signedinrole = $jwtarrayinformation['role'];

$query = $conn->prepare("SELECT mydb.users.user_id FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_id = $reviewid;");

if(!$query){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    exit();
}


//was there interception?
if($query->execute()){
    $query->bind_result($uid);

    if($query->fetch()){
        
        if($useridsignedin==$uid||$signedinrole==6){
            

        } else {
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=intruder");
            exit();
        }
        
    }


    
}

$query->close();

//if its a parent, get all child
$query=$conn->prepare("SELECT review_id FROM mydb.reviews WHERE childof_id='$reviewid'");
if(!$query){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    exit();
}

$allchilds = [];

if($query->execute()){
    $query->bind_result($reid);

    while($query->fetch()){
        array_push($allchilds,$reid);
    }
}


$query->close();


if(sizeof($allchilds)>1){
    //delete all rows
    //initalise to delete parent first
    $beforequery = "DELETE FROM mydb.reviews WHERE review_id = $reviewid OR ";

    //create statement to ensure that childs are delete too
    for($a=0;$a<sizeof($allchilds);$a++){
        if($a==sizeof($allchilds)-1){
            $beforequery = $beforequery . ' review_id = ' . $allchilds[$a];
        } else {
            $beforequery = $beforequery . ' review_id = ' . $allchilds[$a] . ' OR ';
        }
    }

    $query = $conn->prepare($beforequery);

    if(!$query){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
        exit();
    }

    if($query->execute()){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);

    } else {
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
        exit();

    }
    

    

} else {
    $query = $conn->prepare("DELETE FROM mydb.reviews WHERE review_id = $reviewid;");

    if($query->execute()){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);

    } else {
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
        exit();

    }

}


