<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';



$userid = $jwtarrayinformation['userid'];



//add
try {
    $query = $conn->prepare("SELECT user_shipping,purchase_id,purchase_time,purchase_cost,cart_bundled FROM mydb.user_past_purchases 
    
    INNER JOIN mydb.user_creditcardinfo
    ON mydb.user_creditcardinfo.user_creditcardinfo_id = mydb.user_past_purchases.user_creditcards
    WHERE user_id = ?
    ORDER BY purchase_time DESC
    ");

    $query->bind_param('s',$userid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(viewnotification)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
    exit;
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (viewnotification)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
    exit;
}




$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);

$query->close();











for($i=0;$i<sizeOf($array);$i++){
    $time = $array[$i]['purchase_time'];
    $totalcosts = $array[$i]['purchase_cost'];
    $bundled = $array[$i]['cart_bundled'];
    $purchaseid = $array[$i]['purchase_id'];
    $timepurchased = $array[$i]['purchase_time'];


    

    //get shipping info
    $usershipping = $array[$i]['user_shipping'];







    

    

    //add
    try {
        $query = $conn->prepare("SELECT user_shipping_address,user_shipping_postalcode,
        user_shipping_unitnumber FROM mydb.user_shippinginformation WHERE user_shipping_id = ?;
        ");
        $query->bind_param('s',$usershipping);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(viewpurchases)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
        exit;
    }

    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (viewpurchases)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
        exit;
    }

    $query->bind_result($shippingaddress,$postalcode,$unitnumber);

    $query->fetch();

    $fulladdress = $shippingaddress . " " . $postalcode . " " . $unitnumber;











    

    






    //display
    $query->close();

    echo "<p>Purchase #$purchaseid"." ($timepurchased) "."</p>";
    echo "<p>Total Costs $$totalcosts</p>";
    echo "<p>Shipped To $fulladdress</p>";

    






    //products
    try {
        $query = $conn->prepare("SELECT cart_id,product_name,product_price,product_picone,quantity,price FROM mydb.user_cart 
        INNER JOIN mydb.products
        ON mydb.user_cart.product_id = mydb.products.product_id
        WHERE bundled = ?
        ");
        $query->bind_param('s',$bundled);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(viewpurchases)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
        exit;
    }

    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (viewpurchases)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
    }

    $result = $query->get_result();
    $arrayone = $result->fetch_all(MYSQLI_ASSOC);

    $query->close();

    //print_r($arrayone);

    for($j=0;$j<sizeOf($arrayone);$j++){
        $cartid = $arrayone[$j]['cart_id'];
        $productname = $arrayone[$j]['product_name'];
        $productprice = $arrayone[$j]['product_price'];
        $productpicone = $arrayone[$j]['product_picone'];
        $productquantity = $arrayone[$j]['quantity'];
        $totalproductprice = $arrayone[$j]['price'];

        echo "<p>Product ". $j+1 .": </p>";
        echo "<p>$productname" ."($productprice)"."</p>";
        echo "<p>Quantity bought: $productquantity</p>";
        echo "<p>Total: $totalproductprice "." (WITHOUT GST)"."</p>";



        
        
        


        //types
        try {
            $query = $conn->prepare("SELECT cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts FROM mydb.cart_typevariants 
            INNER JOIN mydb.user_cart
            ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
            WHERE bundled = ?;
    
            ");
            $query->bind_param('s',$bundled);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(viewnotification)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
            exit;
        }

        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (viewnotification)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/campus?error=statement"); 
        }

        $query->bind_result($type,$variant,$additionalcosts);

        
            
            
        
            
        $counter = 0;

        while($query->fetch()){

            

            if($counter===0){
                echo "<table>";

                echo "<tr>";
                echo "<th>"."Type"."</th>";
                echo "<th>"."Variant"."</th>";
                echo "<th>"."Costs"."</th>";
                echo "</tr>";

            }

            
            
            
            
            echo "<tr>";
            echo "<td>"."$type"."</td>";
            echo "<td>"."$variant"."</td>";
            echo "<td>"."$additionalcosts"."</td>";
            echo "</tr>";


            $counter = 1;

        
            
            

        }

        echo "</table>";

        unset($type);
            
            
            

        

        //unset($type);


       

        $query->close();

        


















        
    }


    echo "<br>";
    echo "<br>";
    echo "<br>";











    

    




}















?>
<html>
    <head>
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>

    </head>
</html>