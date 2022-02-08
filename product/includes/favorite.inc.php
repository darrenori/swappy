<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';

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
#NOTE. THIS IS AN AJAX FILE. DO NOT USE HEADER

// require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';


$jwtarray = jwtdecrypt();

if(isset($jwtarray)&&$jwtarray==true){
    $jwtarrayinformation = $jwtarray['array'];
}

//print_r($jwtarrayinformation);
if (!isset($_POST)) {
    echo 'not correct type!';
    
    exit;
    
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

} else {
    echo "error";
    exit;
}






$methd = $postinformation;
$whitelist=['productid'];
$empty = checkEmpty($methd,$whitelist);
$maxlengtharray['productid']=11;
if($empty!=null){
   exit();
} 


$validarray = XSSPrevention($methd,$whitelist);

$validarray = escapeString($conn,$validarray);
if(validateCSRFAjax($postinformation)==false){
    echo "CSRF BAD";
    exit;
}

if(checkNumber([$validarray['productid']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    exit();
}


if(checkLength($validarray,$maxlengtharray)!=null){
    exit();
}



$productid=$validarray['productid'];










$userid = $jwtarrayinformation['userid'];






//does id exist
try {
    $query = $conn->prepare("SELECT product_id FROM mydb.products WHERE product_id = $productid");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(favorite)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    
    exit;
}


// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (favorite)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    
    exit;
}


$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);


if(!(sizeof($array))==1){
    echo 'Product does not exist';
    
    exit;
}










//is it already favorited
try {
    $query = $conn->prepare("SELECT product_id,user_id FROM mydb.usersfavorite WHERE product_id = '$productid' AND user_id ='$userid';");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(favorite)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    
    exit;
}


// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (favorite)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    
    exit;
}


$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);






//'Product has already been favorited before!'
//Unfavorite
if(sizeof($array)!=0){
    

    
    try {
        $query = $conn->prepare("DELETE FROM mydb.usersfavorite WHERE product_id = '$productid' AND user_id = '$userid';");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(favorite)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badstatement");
        exit;
    }


    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (favorite)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badstatement");
        exit;
    }

    echo 'unfavorited';
    exit;

    
    

}















//add to favorites
try {
    $query = $conn->prepare("INSERT INTO mydb.usersfavorite (product_id,user_id) VALUES ('$productid','$userid');");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(favorite)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badstatement");
    exit;
}


// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (favorite)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badstatement");
    exit;
}

echo 'favorited';