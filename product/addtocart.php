<?php

    //read
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    $jwtarray_insidearray = $jwtarray['array'];
    


    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];

    } else {
        header("location: ../product/viewcart");
    }


    
    if(!isset($jwtarray_insidearray["progresscheckout"])){
        header("location: ../product/viewcart");
    } elseif($jwtarray_insidearray["progresscheckout"]!='A'){
        header("location: ../product/viewcart");
    } 

    
    

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/product/product.function.php';





    

    foreach ($_POST as $key => $value) {
        //echo "$key = $value<br>";
        
        if($key!="quantity"){
            $postinformation[$key] = $value;
        }
    }

    if(!isset($postinformation)){
        //if they tryna enter funny business yo
    }

    







    
    session_start();
    $productid = $jwtarray_insidearray["productid"];
    $quantity = $_POST["quantity"];

   

    

    
   

    $query=$conn->prepare("SELECT type,type_choice,additional_costs,product_price FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE  mydb.product_type.product_id =$productid;");

    //new
    $checkIfValuesTampered = [];





    //this query is to check that there hasnt been interception
    if($query->execute()){
        $query->bind_result($db_type,$db_type_choice,$db_additional_costs,$db_product_price);
        


        #adssd

        while($checkempty = $query->fetch()){
            $db_type=strval($db_type);
            $db_type = preg_replace('/\s+/', '_', $db_type);


            
            array_push($checkIfValuesTampered,$db_type_choice);

        
            
            for($i=0;$i<sizeof($postinformation);$i++){
                if(isset($postinformation[$db_type])){ //is a valid type as checked from database.
                    //we know that key is valid. 

                    if($postinformation[$db_type] == $db_type_choice){
                        //we know that value is valid. key will also be valid(from prev check)
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
            

            

            
        }


        

        for($i=0;$i<sizeof($checkIfValuesTampered);$i++){

            if($checkIfValuesTampered[$i]==$db_type_choice){
                echo "found";
                break;
            }

            if($checkIfValuesTampered[$i]==sizeof($checkIfValuesTampered)){
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

        

        
    } else {
        
        echo mysqli_error($query);
    }

    

   

    



    
    

    if(isset($validtypes)){
        $typestotalcost =0;
        foreach ($validtypes as $key => $value) {
            $typestotalcost = $typestotalcost + $validtypes[$key][1];
        }
    }

    if(isset($typestotalcost)){
        $total = $typestotalcost + $db_product_price;
        $total = $quantity * $total;
    } 
    


    
    

    

    $cartidrandom = floatval(rand(pow(10, 8-1), pow(10, 8)-1));
    
    
    //echo "<br>RANDOM" .$cartidrandom."<br>";


    print_r($jwtarray_insidearray);
    $userid = $jwtarray_insidearray['userid'];
    
    $query->close();
    $query=$conn->prepare("INSERT INTO mydb.user_cart (mydb.user_cart.cart_id,mydb.user_cart.user_id, mydb.user_cart.product_id,mydb.user_cart.quantity,mydb.user_cart.price,mydb.user_cart.purchased,,mydb.user_cart.bundled) VALUES ($cartidrandom,$userid,$productid,$quantity,$total,'0','0');");
    
    
    if($query->execute()){
        //echo "<br>success<br>";
      
    } else {
        echo $query->error;
        
    }

    $query->close();

    if(isset($validtypes)){
        foreach ($validtypes as $types => $variants) {
            $variantandprice = $validtypes[$types];
            // echo "---------------------";
            // echo $types."<br>".$variantandprice[0]."<br>".$variantandprice[1]."<br>".$cartidrandom;
            $typevariant = strval($variantandprice[0]);
    
            
            
            $price = floatval($variantandprice[1]);
    
            
            
            $newquery = $conn->prepare("INSERT INTO mydb.cart_typevariants (cart_typevariants_type, cart_typevariants_variant, cart_additionalcosts, cart_id) VALUES ('$types','$typevariant',$price,$cartidrandom)");
    
            if(!$newquery){
                echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
            }
            
            if($newquery->execute()){
                echo "<br>success one<br>";
                $newquery->close();
            } else {
                echo $newquery->error;
                $newquery->close();
                
            }
    
            
        }
    
    }

    
    
   header("location: ../product/viewcart");

   
    


    




?>