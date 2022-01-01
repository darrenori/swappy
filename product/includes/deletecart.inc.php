<?php 

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
    session_start();

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

    


    //take note
    if(!isset($jwtarrayinformation["progresscheckout"])){
        header("location: ../product/viewcart");
    } elseif($jwtarrayinformation["progresscheckout"]!='A'){
        header("location: ../product/viewcart");
    }

    foreach ($_POST as $key => $value) {
        //echo "$key = $value<br>";
        
        if($key!="quantity"){
            $postinformation[$key] = $value;
        }
    }

    $cartid = $jwtarrayinformation['cartid'];
   

    $query = $conn->prepare("DELETE FROM mydb.user_cart WHERE cart_id = $cartid");

    if($query->execute()){

        echo "done";
        header("location: ../product/viewcart");
    }


?>