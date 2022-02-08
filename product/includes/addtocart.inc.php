<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';


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


    //read
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';


    $jwtarray = jwtdecrypt();
    $jwtarray_insidearray = $jwtarray['array'];
    $postinformation = [];
    $userid = $jwtarray_insidearray['userid'];
    $productid = $jwtarray_insidearray["productid"];


   
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

    

    foreach ($_POST as $key => $value) {
        //echo "$key = $value<br>";
        
        if($key!="quantity"){
            $postinformation[$key] = $value;
        }
    }

   

    

    //check if quantity valid
    $whitelist=['quantity'];
    $maxlengtharray['quantity']=11;
    $methd = $_POST;
    $empty = checkEmpty($methd,$whitelist);

    if($empty!=null){
        
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=empty".$empty);
        exit;
    } 

    

    $validarray = XSSPrevention($methd,$whitelist);
    $validarray = escapeString($conn,$validarray);


    if(checkId($validarray)!=false){
        error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badinput");
        exit();
    }

    if(checkLength($validarray,$maxlengtharray)!=null){   
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=toolongid");
        exit();
    }

    session_start();
    $quantity = $validarray['quantity'];
    if($quantity<1){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badquantity");
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



    











    //check if others are valid


    //xss,encoding
    foreach ($postinformation as $key => $value) {
        // hashes all values into htmlspecialchars versions
        $postinformation[$key] = htmlspecialchars($value, ENT_QUOTES);
        $postinformation[$key] = mysqli_real_escape_string($conn, $value); 
    }


   //regex
   if(badInputTwo($postinformation)!=false){
        error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badinput");
        exit();
   }


 
     //length
   if(bufferOverflow($postinformation,255)==true){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=toolong");
        exit();
   }

    

    




   
    //check if information matches in databaase
    try {
        $query=$conn->prepare("SELECT type,type_choice,additional_costs,product_price,product_name FROM mydb.product_type 
        INNER JOIN mydb.products 
        ON mydb.products.product_id = mydb.product_type.product_id 
        INNER JOIN mydb.type 
        ON mydb.type.type_id = mydb.product_type.type_id 
        WHERE  mydb.product_type.product_id = ?;");
        $query->bind_param('s',$productid);
        
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(quantity)");
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
            throw new Exception("Statement Execution failed (quantity)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
    }


    
    

    //new
    $checkIfValuesTampered = [];



    //this query is to check that there hasnt been interception
    
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

            try {
                $query=$conn->prepare("SELECT product_price,product_name FROM mydb.products WHERE product_id=?;");
                $query->bind_param('s',$productid);
                if ($query === false) {
                    //change filename accordingly
                    throw new Exception("Statement Preparation failed(quantity)");
                }
            } catch (Exception $e) {
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                exit();
            }
            
            // throws error "Statment Execution failed" when statement fails
            try {
                $execute = $query->execute();
                if ($execute === false) {
                    throw new Exception("Statement Execution failed (quantity)");
                }
            } catch (Exception $e) {
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                exit();
            }

            $query->bind_result($db_empty_price,$product_name);
            if($query->fetch()){
                $total = $quantity * $db_empty_price;
                
                
            }


            
        }

        

        
    


    $query->close();

    //check if there is existing same product same type same variant in database
    try {
        $query=$conn->prepare("SELECT cart_id,productcode,quantity FROM mydb.user_cart WHERE user_id = ? AND purchased = '0';");
        $query->bind_param('s',$userid);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(quantity)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
    }
    
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (quantity)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
    }
    

    $arrayforexisting = [];
   

    

    

    $query->bind_result($cartid,$productcode,$quantityleft);

    while($query->fetch()){
        $arrayforexisting[$cartid] = [$productcode,$quantityleft];
        
    }



    

    $query->close();


    






    //get product code for inventory
    $toGetProductCode = $postinformation;
    $toGetProductCode['product_name'] = $product_name;
    //print_r($toGetProductCode);
    $productcode =  calculateProductCode($toGetProductCode);


    //check how much of a product is elft
    try {
        $query=$conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE productcode = ?;");
        $query->bind_param('s',$productcode);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(quantity)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
    }
    
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (quantity)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
        exit();
    }

    $query->bind_result($qnleft);

    if($query->fetch()){
        $qnleft = $qnleft;
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
                
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=toomuch");
                exit();
            }

            $alreadyexists = 1;
            break;










        } else {
            //if its a new type


            if($quantity>$qnleft){
                echo $quantity. "<br>";
                echo $qnleft . "<br>";
                
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=toomuch");
                exit();
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
        
    
    
        try {
            $query=$conn->prepare("INSERT INTO mydb.user_cart (mydb.user_cart.cart_id,mydb.user_cart.user_id, mydb.user_cart.product_id,mydb.user_cart.quantity,mydb.user_cart.price,productcode,bundled,purchased) VALUES (?,?,?,?,?,?,'0','0');");
            $query->bind_param('ssssss',$cartidrandom,$userid,$productid,$quantity,$total,$productcode);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(quantity)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
            exit();
        }
        
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (quantity)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
            exit();
        }

        $query->close();

        if(isset($validtypes)){
            foreach ($validtypes as $types => $variants) {
                $variantandprice = $validtypes[$types];
                // echo "---------------------";
                // echo $types."<br>".$variantandprice[0]."<br>".$variantandprice[1]."<br>".$cartidrandom;
                $typevariant = strval($variantandprice[0]);
        
                
                
                $price = floatval($variantandprice[1]);
        
                
                
                
        
                try {
                    $query=$conn->prepare("INSERT INTO mydb.cart_typevariants (cart_typevariants_type, cart_typevariants_variant, cart_additionalcosts, cart_id) VALUES (?,?,?,?)");
                    $query->bind_param('ssss',$types,$typevariant,$price,$cartidrandom);
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(quantity)");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
                    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                    exit();
                }
                
                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (quantity)");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
                    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                    exit();
                }


                $query->close();
        
                
            }
        
        }

        header("location: ../product/viewcart");

    } elseif($alreadyexists==1){
        echo 'ayo';


        //check if prodduct id has already been purchased
        // $query=$conn->prepare("SELECT ")









        //$query->close();

        
        
        try {
            $query=$conn->prepare("UPDATE mydb.user_cart SET quantity = ?, price = ? WHERE user_id=? AND productcode=?;");
            $query->bind_param('ssss',$quantity,$total,$userid,$productcode);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(quantity)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
            exit();
        }
        
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (quantity)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
            exit();
        }
        

        $query->close();
        header("location: ../product/viewcart");

        
    } else {

    }
    

   
    


    





   


?>