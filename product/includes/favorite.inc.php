<?php


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

if(!isset($_GET['id'])||$_GET['id']==null){
    echo 'Information found was not present';
    exit;   
}

if(is_numeric($_GET['id'])){
    $productid = $_GET['id'];
} else {
    echo 'Information found was not present';
    exit;   

}

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