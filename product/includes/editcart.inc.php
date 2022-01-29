<?php 

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

    $postinformation = [];

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
    
    $productname = $jwtarrayinformation['productname'];
    $cartid = $jwtarrayinformation['cartid'];









    //check if quantity valid
    $whitelist=['quantity'];
    $maxlengtharray['quantity']=11;
    $methd = $_POST;
    $empty = checkEmpty($methd,$whitelist);

    if($empty!=null){
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=empty".$empty);
        exit();
    } 

    $validarray = XSSPrevention($methd,$whitelist);
    $validarray = escapeString($conn,$validarray);


    if(checkId($validarray)!=false){
        error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=malicious");
        exit();
    }

    if(checkLength($validarray,$maxlengtharray)!=null){   
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=toolong");
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

    $quantity=$validarray['quantity'];




    if($quantity<1){
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=badqnty");
        exit();

    }




    //check others
    foreach ($postinformation as $key => $value) {
        // hashes all values into htmlspecialchars versions
        $postinformation[$key] = htmlspecialchars($value, ENT_QUOTES);
        $postinformation[$key] = mysqli_real_escape_string($conn, $value); 
    }


   //regex
   if(badInputTwo($postinformation)!=false){
        error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=malicious");
        exit();
   }


 
     //length
   if(bufferOverflow($postinformation,255)==true){
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=toolong");
        exit();
   }



















    
    $selectedchoices = [];
    $checkIfValuesTampered = [];
    
    
  
    $toGetProductCode = $postinformation;
    $toGetProductCode['product_name'] = $productname;
    $productcode =  calculateProductCode($toGetProductCode);


   
    try {
        $query=$conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE productcode = ?;");
        $query->bind_param('s',$productcode);
        
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

    

    $query->bind_result($qnleft);

    if($query->fetch()){
        $qnleft = $qnleft;
    }



    

    if($quantity>$qnleft){
        // echo $quantity. "<br>";
        // echo $qnleft . "<br>";
        
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=chooselesser");
        exit();
    }

    $query->close();






    try {
        $query=$conn->prepare("SELECT type,type_choice,additional_costs,product_price FROM mydb.product_type 
        INNER JOIN mydb.products 
        ON mydb.products.product_id = mydb.product_type.product_id 
        INNER JOIN mydb.type 
        ON mydb.type.type_id = mydb.product_type.type_id 
        WHERE  product_name =?");
        $query->bind_param('s',$productname);
        
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
    
                try {
                    $query=$conn->prepare("SELECT product_price FROM mydb.products WHERE product_id=?");
                    $query->bind_param('s',$productid);
                    
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
            
                
                
    
                
                $query->bind_result($db_empty_price);
                if($query->fetch()){
                    $total = $quantity * $db_empty_price;
                    
                    
                }
                
            }





        }




    

    if(isset($validtypes)){
        $typestotalcost =0;
        foreach ($validtypes as $key => $value) {
            $typestotalcost = $typestotalcost + $validtypes[$key][1];
        }

        $total = $typestotalcost + $db_product_price;
        $total = $quantity * $total;

        $query->close();
    
    
        $getAdditionalCumulative = [];
        
        foreach ($validtypes as $key => $value) {
            
            $choice = $value[0];
            $additional = $value[1];
            array_push($getAdditionalCumulative,$additional);

            

            //change types
            try {
                $query=$conn->prepare("UPDATE mydb.cart_typevariants SET cart_typevariants_variant = ?, 
                cart_additionalcosts = ?
                WHERE cart_typevariants_type = ? AND cart_id = ?;");
                $query->bind_param('ssss',$choice,$additional,$key,$cartid);
                
                if ($query === false) {
                    //change filename accordingly
                    throw new Exception("Statement Preparation failed");
                }
            } catch (Exception $e) {
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
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
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
                header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
                exit();
            }

        
            
            $query->close();









            
            
        }


        //change price at cart table
        $total = $db_product_price;

        for($i=0;$i<sizeof($getAdditionalCumulative);$i++){
            $total = $total + $getAdditionalCumulative[$i];
        }

        $total = $quantity*$total;

        

        try {
            $query=$conn->prepare("UPDATE mydb.user_cart SET quantity = ?,
            price =?
            WHERE cart_id = ?");
            $query->bind_param('sss',$quantity,$total,$cartid);
            
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
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
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
            exit();
        }

        if($query->execute()){
            // echo "all done!";
            header("location: ../product/viewcart");
        }
    } else {

        //no types

        
        try {
            $query=$conn->prepare("SELECT product_price FROM mydb.products
            WHERE  product_name =?;");
            $query->bind_param('s',$productname);
            
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
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
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
            exit();
        }

        
            $query->bind_result($db_product_price);

            $query->fetch();

        

        $query->close();

        $total = $db_product_price * $quantity;
        

        try {
            $query=$conn->prepare("UPDATE mydb.user_cart SET quantity = ?,
            price = ?
            WHERE cart_id = ?;");
            $query->bind_param('sss',$quantity,$total,$cartid);
            
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
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
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
            exit();
        }


       

        

        // echo $db_product_price . "<br>";



        // echo $total . "<br>";
        // echo $quantity . "<br>";
        if($query->execute()){
            //echo "all done!";
            header("location: ../product/viewcart");
        }

    }




?>