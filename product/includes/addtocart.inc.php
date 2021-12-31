<?php
    
    //read
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    $jwtarray_insidearray = $jwtarray['array'];
    $postinformation = [];
    $userid = $jwtarray_insidearray['userid'];
    


   
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }


    
    if(!isset($jwtarray_insidearray["progresscheckout"])){
        header("location: ../product/viewcart");
    } elseif($jwtarray_insidearray["progresscheckout"]!='A'){
        header("location: ../product/viewcart");
    } 

    
    

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';





    

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

   

    

    
   

    $query=$conn->prepare("SELECT type,type_choice,additional_costs,product_price,product_name FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE  mydb.product_type.product_id =$productid;");

    //new
    $checkIfValuesTampered = [];


    













    //this query is to check that there hasnt been interception
    if($query->execute()){
        $query->bind_result($db_type,$db_type_choice,$db_additional_costs,$db_product_price,$product_name);
        

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
                   // print_r($db_type);
                    echo "<br>";

                }
            }
            

            

            
        }


        

        for($i=0;$i<sizeof($checkIfValuesTampered);$i++){

            if($checkIfValuesTampered[$i]==$db_type_choice){
                //echo "found";
                break;
            }

            if($checkIfValuesTampered[$i]==sizeof($checkIfValuesTampered)){
                echo "interception has been detected. We are logging you off";
                
            }
        }

        if(!$checkempty){ //if the product has no types
            
            $query->close();

            $query=$conn->prepare("SELECT product_price,product_name FROM mydb.products WHERE product_id=$productid;");

            if($query->execute()){
                $query->bind_result($db_empty_price,$product_name);
                if($query->fetch()){
                    $total = $quantity * $db_empty_price;
                    
                    
                }
            }
        }

        

        
    } else {
        
        echo mysqli_error($query);
    }


    $query->close();




    //check if there is existing same product same type same variant in database
    $query = $conn->prepare("SELECT cart_id,productcode,quantity FROM mydb.user_cart WHERE user_id = $userid;");

    $arrayforexisting = [];
   

    if(!$query){
        echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
    }

    if($query->execute()){

        $query->bind_result($cartid,$productcode,$quantityleft);

        while($query->fetch()){
            $arrayforexisting[$cartid] = [$productcode,$quantityleft];
            
        }



    } else {
        echo mysqli_error($query);
    }

    $query->close();


    









    








    print_r($arrayforexisting);






    //get product code for inventory
    $toGetProductCode = $postinformation;
    $toGetProductCode['product_name'] = $product_name;
    $productcode =  calculateProductCode($toGetProductCode);


    //check how much of a product is elft
    $query = $conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE productcode = '$productcode';");
    if(!$query){
        echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
    }

    if($query->execute()){

        $query->bind_result($qnleft);

        if($query->fetch()){
            $qnleft = $qnleft;
        }



    } else {
        echo mysqli_error($query);
    }

    
    //check if existing
    $alreadyexists = 0;
    foreach ($arrayforexisting as $info){

        //info 0 is product code, info 1 is quantiy
        

        
        
        if($info[0]==$productcode){
            //if same product and type already exisit
            $quantity = $quantity + $info[1];

            if($quantity>$qnleft){
                echo $quantity. "<br>";
                echo $qnleft . "<br>";
                
                header("location: ../product/viewcart");
                exit;
            }

            $alreadyexists = 1;
            break;










        } else {
            //if its a new type


            if($quantity>$qnleft){
                echo $quantity. "<br>";
                echo $qnleft . "<br>";
                
                header("location: ../product/viewcart");
                exit;
            }


            

        }

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
    
    
    
    $query->close();

    if($alreadyexists==0){
        $query=$conn->prepare("INSERT INTO mydb.user_cart (mydb.user_cart.cart_id,mydb.user_cart.user_id, mydb.user_cart.product_id,mydb.user_cart.quantity,mydb.user_cart.price,productcode) VALUES ($cartidrandom,$userid,$productid,$quantity,$total,'$productcode');");
    
    
        if($query->execute()){
            //echo "<br>success<br>";
        
        } else {
            echo $query->error;

            //HERE
            
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

                    //HERE
                    $newquery->close();
                    
                }
        
                
            }
        
        }

        header("location: ../product/viewcart");

    } elseif($alreadyexists==1){
        echo 'ayo';
        
        $query = $conn->prepare("UPDATE mydb.user_cart SET quantity = $quantity, price = $total WHERE user_id=$userid AND productcode='$productcode';");

        if($query->execute()){
            //echo "<br>success<br>";
        
        } else {
            echo $query->error;

            //HERE
            
        }

        $query->close();
        header("location: ../product/viewcart");

        
    } else {

    }
    

   
    


    





   


?>