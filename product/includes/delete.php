<?php 

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/product/product.function.php';
    session_start();


    //take note
    if(!isset($_SESSION["progresscheckout"])){
        header("location: ../product/viewcart");
    } elseif($_SESSION["progresscheckout"]!='A'){
        header("location: ../product/viewcart");
    }

    foreach ($_POST as $key => $value) {
        //echo "$key = $value<br>";
        
        if($key!="quantity"){
            $postinformation[$key] = $value;
        }
    }

    $cart = $_SESSION['cart'];
    $cartarray = $_SESSION['cartarray'];

    $cartid = $cartarray[$cart];

    $query = $conn->prepare("DELETE FROM mydb.user_cart WHERE cart_id = $cartid");

    if($query->execute()){

        echo "done";
        header("location: ../product/viewcart");
    }


?>