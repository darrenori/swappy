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
    $productname = $_SESSION['productarray'][$cart];
    $selectedchoices = [];
    $checkIfValuesTampered = [];
    $quantity = $_POST['quantity'];
    $cartarray = $_SESSION['cartarray'];

    $query=$conn->prepare("SELECT type,type_choice,additional_costs,product_price FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE  product_name ='$productname';");

    if ($query->execute()) {
        $query->bind_result($db_type,$db_type_choice,$db_additional_costs,$db_product_price);
        


        #adssd

        while($checkempty = $query->fetch()){

            //i am changing to replace space with underscore as 
            //SQL converts space to underscore when sending data to us
            $db_type=strval($db_type);
            $db_type = preg_replace('/\s+/', '_', $db_type);
            
            //this is used LATER, to check whether the value actually exists in database
            array_push($checkIfValuesTampered,$db_type_choice);

        
            
            for($i=0;$i<sizeof($postinformation);$i++){
                if(isset($postinformation[$db_type])){ //the information from post is a valid type as checked from database.
                    //we know that key is valid. 

                    if($postinformation[$db_type] == $db_type_choice){
                        
                        $choiceAndExtraCosts = [$db_type_choice,$db_additional_costs];
                        $validtypes[$db_type] = $choiceAndExtraCosts;  
                        
                    } else {

                        //not any catcher here as 1 type can have multiple options. e.g. red and blue colors
                        // echo $db_type_choice;
                        // echo "interception detected value ";
                    }
                    
                } else {
                    echo "interception deleted key "."<br>";
                    echo "here->";
                    print_r($db_type);
                    echo "<br>";

                }
            } 

            for($i=0;$i<sizeof($checkIfValuesTampered);$i++){

                if($checkIfValuesTampered[$i]==$db_type_choice){
                    //echo "found";
                    break;
                }
    
                if($checkIfValuesTampered[$i]==sizeof($checkIfValuesTampered)-1){
                    echo "interception has been detected. We are logging you off";
                    
                }
            }

            if(!$checkempty){ //if the product has no types
            
                $query->close();
    
                $query=$conn->prepare("SELECT product_price FROM mydb.products WHERE product_id=$productid;");
    
                if($query->execute()){
                    $query->bind_result($db_empty_price);
                    if($query->fetch()){
                        $total = $quantity * $db_empty_price;
                        
                        
                    }
                }
            }





        }




    } else {
        echo mysqli_error($query);
    }

    if(isset($validtypes)){
        $typestotalcost =0;
        foreach ($validtypes as $key => $value) {
            $typestotalcost = $typestotalcost + $validtypes[$key][1];
        }

        $total = $typestotalcost + $db_product_price;
        $total = $quantity * $total;
    }

    // if(isset($typestotalcost)){
        
    // } 


    print_r($validtypes);
    //echo "<br>";//update types. update 

    $query->close();
    
    $cartid = $cartarray[$cart];
    $getAdditionalCumulative = [];
    
    foreach ($validtypes as $key => $value) {
        
        $choice = $value[0];
        $additional = $value[1];
        array_push($getAdditionalCumulative,$additional);

        

        //change types

        $query = $conn->prepare("UPDATE mydb.cart_typevariants SET cart_typevariants_variant = '$choice', 
        cart_additionalcosts ='$additional'
        WHERE cart_typevariants_type = '$key' AND cart_id = $cartid;");


        if(!$query){
            echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
        }

        if($query->execute()){
            //success
        } else {
            echo mysqli_error($query);
        }
        
        $query->close();









        
        
    }


    //change price at cart table
    $total = $db_product_price;

    for($i=0;$i<sizeof($getAdditionalCumulative);$i++){
        $total = $total + $getAdditionalCumulative[$i];
    }

    $total = $quantity*$total;

    $query = $conn->prepare("UPDATE mydb.user_cart SET quantity = '$quantity',
    price ='$total'
    WHERE cart_id = $cartid;");

    if($query->execute()){
        echo "all done!";
        header("location: ../product/viewcart");
    }


    

    







    

   



?>