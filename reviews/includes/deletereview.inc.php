<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}
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



// if(isset($_GET['id'])&&$_GET['id']!=null){
//     if(badInputTwo([$_GET['id']])==1){
//         header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
//         exit();

//     }
// } else {
//     header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=emptyid");
//     exit();
// }

//check if quantity valid
$productid=$jwtarrayinformation['productid'];
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
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badrating");
    exit();
}


if(checkLength($validarray,$maxlengtharray)!=null){   
    $checklen=checkLength($validarray,$maxlengtharray );
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$checklen"."toolong");
    exit();
}






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




$reviewid = $validarray['id'];
$useridsignedin = $jwtarrayinformation['userid'];
$signedinrole = $jwtarrayinformation['role'];


try {
    $query=$conn->prepare("SELECT mydb.users.user_id FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id 
    WHERE review_id = ?;");
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

//was there interception?

$query->bind_result($uid);

if($query->fetch()){
    
    if($useridsignedin==$uid||$signedinrole==6){
        

    } else {
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=intruder");
        exit();
    }
    
}


    

$query->close();

//if its a parent, get all child

try {
    $query=$conn->prepare("SELECT review_id FROM mydb.reviews WHERE childof_id=?");
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

$allchilds = [];


$query->bind_result($reid);

while($query->fetch()){
    array_push($allchilds,$reid);
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

    

    try {
        $query = $conn->prepare($beforequery);
        
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

    // if(!$query){
    //     header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    //     exit();
    // }

    // if($query->execute()){
        

    // } else {
    //     header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    //     exit();

    // }
    

    

} else {

    try {
        $query = $conn->prepare("DELETE FROM mydb.reviews WHERE review_id = ?;");
        $query->bind_param("s",$reviewid);
        
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

    

    

}


