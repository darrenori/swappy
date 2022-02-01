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

    

    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }

    // print_r($_SESSION);
    // exit;
    //take note
    if(!isset($jwtarrayinformation["progresscheckout"])){
        header("location: ../product/viewcart");
    } elseif($jwtarrayinformation["progresscheckout"]!='A'){
        header("location: ../product/viewcart");
    }

    // foreach ($_POST as $key => $value) {
    //     //echo "$key = $value<br>";
        
    //     if($key!="quantity"){
    //         $postinformation[$key] = $value;
    //     }
    // }

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

    $cartid = $jwtarrayinformation['cartid'];
   

    
    try {
        $query = $conn->prepare("DELETE FROM mydb.user_cart WHERE cart_id = ?");
        $query->bind_param('s',$cartid);
        
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed");
        }
    } catch (Exception $e) {
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
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
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
        exit();
    }

    

        // echo "done";
    header("location: ../product/viewcart");
    
    



?>