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
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example

$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}



$role = $jwtarrayinformation['role'];
$productid = $jwtarrayinformation['productid'];
$userid = $jwtarrayinformation['userid'];






$whitelist=['comment'];
$maxlengtharray['comment']=255;
$methd = $_POST;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=empty$empty");
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(badInputTwo([$validarray['comment']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badcomment");
    exit();
}


if(checkLength($validarray,$maxlengtharray)!=null){   
    $checklen=checkLength($validarray,$maxlengtharray );
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$checklen"."toolong");
    exit();
}

if(validateCSRF()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        
        //dont redirect if on the same page
  
    } else {
        error_log("TPAMC:".$filename.":4:$ipadd:2 CSRF", 0);
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
    
    
}

$comment = $validarray['comment'];








//id
$whitelist=['id'];
$maxlengtharray['id']=11;
$methd = $_GET;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=empty$empty");
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkId([$validarray['id']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badid");
    exit();
}


if(checkLength($validarray,$maxlengtharray)!=null){   
    $checklen=checkLength($validarray,$maxlengtharray );
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$checklen"."toolong");
    exit();
}




// $reviewid = $_GET['id'];
$reviewid=$validarray['id'];




// if(isset($_GET['id'])&&$_GET['id']!=null){
//     if(badInputTwo([$_GET['id']])==1){
//         header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
//         exit();

//     }
// } else {
//     header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=emptyid");
//     exit();
// }


// if(isset($_POST['comment'])&&$_POST['comment']!=null){
//     if(badInputTwo([$_POST['comment']])==1){
//         header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
//         exit();

//     }
// } else {
//     header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=emptycomment");
//     exit();
// }



















if($role!=6){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=notpermitted");
    exit();

}

//check if reviewid exists, and who is its parent(if any)


try {
    $query=$conn->prepare("SELECT review_id,childof_id FROM mydb.reviews WHERE review_id=?;");
    $query->bind_param('s',$reviewid);
    
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
}

$query->bind_result($revid,$parent);

if($query->fetch()){
    $revid = $revid;
    $parent = $parent;
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
try {
    $query=$conn->prepare("INSERT INTO mydb.reviews (review_product_id,review_user_id,
    review_comment,review_rating,review_pic,review_total_likes,review_total_dislikes,review_date,childof_id) 
    VALUES (?,?,?,'','','0','0',?,?);");
    $query->bind_param('sssss',$productid,$userid,$comment,$now,$actualparent);
    
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed");
    }
} catch (Exception $e) {
    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
}





    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);





?>