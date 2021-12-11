<?php

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/product/product.function.php';



    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    
    


$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: ../product/viewcart");
}
$userid = $jwtarrayinformation['userid'];
    
    $query = $conn->prepare("SELECT cart_id,product_name,product_price,product_picone,quantity,price FROM mydb.user_cart 
    INNER JOIN mydb.products
    ON mydb.user_cart.product_id = mydb.products.product_id
    WHERE user_id = $userid");
    $cartidrows = [];
    $productnamerows = [];
    $productpricerows = [];
    $arrayforemptytypes = [];
    $totalprice = 0;

    if($query->execute()){
        $query->bind_result($cartid,$productname,$productprice,$productpic,$emptyquantity,$emptyprice);
        while($query->fetch()){
            // echo $emptyquantity."<br>".$emptyprice."<br>";
            
            array_push($cartidrows,$cartid);
            array_push($productnamerows,$productname);
            array_push($productpricerows,$productprice);
            array_push($arrayforemptytypes,[$emptyquantity,$emptyprice]);


        }
        
        // $arraytogive['cartarray'] = $cartidrows;
        // $arraytogive['productarray'] = $productnamerows;
        // $arraytogive['productprice'] = $productpricerows; //excluding types and their prices
        // jwtupdate($arraytogive);


        //print_r(apache_request_headers());
        


    }

    

    $query->close();

    echo "Total items: " . sizeof($cartidrows)."<br>";

    

    for($i=0;$i<sizeof($cartidrows);$i++){
        //print_r($cartidrows[$i]);
        $query = $conn->prepare("SELECT cart_typevariants.cart_id,cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts,quantity,price FROM mydb.cart_typevariants 
        INNER JOIN mydb.user_cart
        ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
        where mydb.cart_typevariants.cart_id=$cartidrows[$i];");
        

        if($query->execute()){
            $query->bind_result($cartidnow,$type,$variant,$additionalcosts,$quantity,$price);

            
            
            echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=$cartidrows[$i]'>".$productnamerows[$i]."</a>"."(".$productpricerows[$i].")"."<br>";
            
            //if there are types

            
            $counter = 0;

            while($checkEmpty=$query->fetch()){
               


                

                if(isset($type)&&$counter!=1){  //only execute header once
                    $counter=1;

                    echo "<table>";

                    echo "<tr>";
                    echo "<th>type</th>";
                    echo "<th>variant</th>";
                    echo "<th>additionalcosts</th>";
                    echo "</tr>";

                    
                } 

                if(isset($type)){
                    echo "<tr>";
                    echo "<th>$type</th>";
                    echo "<th>$variant</th>";
                    echo "<th>$additionalcosts</th>";
                    echo "</tr>";

                }
            

                
    
            }

            

            if(isset($type)){  //if there are types within
                echo "</table>";

            
                echo "QUANTITY: ". $quantity ."<br>";
                echo "PRICE: ". $price ."<br>";
                echo "<br>";

                $totalprice = $totalprice +$price;

            } else {
                echo "</table>";
                
                
            
                echo "QUANTITY: ". $arrayforemptytypes[$i][0] ."<br>";
                echo "PRICE: ". $arrayforemptytypes[$i][1] ."<br>";
                echo "<br>";

                $totalprice = $totalprice +$arrayforemptytypes[$i][1];

            }
            

            $query->close();

            

            
        } else {
            echo "Smthin wnt wrong";
        }
    }

    echo "TOTAL (BEFORE GST): " . $totalprice;


    

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