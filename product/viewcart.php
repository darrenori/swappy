<?php

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';



    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

    $userid = $jwtarrayinformation['userid'];
    
//     $query = $conn->prepare("SELECT cart_id,product_name,product_price,product_picone,quantity,price FROM mydb.user_cart 
//     INNER JOIN mydb.products
//     ON mydb.user_cart.product_id = mydb.products.product_id
//     WHERE user_id = ? AND mydb.user_cart.purchased='0';");
//     $query->bind_param('s',$userid);
//     $cartidrows = [];
//     $productnamerows = [];
//     $productpricerows = [];
//     $arrayforemptytypes = [];
//     $totalprice = 0;

//     if($query->execute()){
//         $query->bind_result($cartid,$productname,$productprice,$productpic,$emptyquantity,$emptyprice);
//         while($query->fetch()){
//             // echo $emptyquantity."<br>".$emptyprice."<br>";
            
//             array_push($cartidrows,$cartid);
//             array_push($productnamerows,$productname);
//             array_push($productpricerows,$productprice);
//             array_push($arrayforemptytypes,[$emptyquantity,$emptyprice]);


//         }
        



//     }

//   //  print_r($arrayforemptytypes[1]);

    

// $query->close();

// if(isset($selectedcarts)){
//     echo 'Hi there. If you cannot find me, look at viewcart.php'."<br>";
//     // for checkout page
//     if (!empty($selectedcarts)) {
//         //this code should only run in view cart page
//         $_SESSION['cart'] = array_values($selectedcarts);
        
//     } else if (!isset($_SESSION['cart'])) {
//         // this code runs if session was not set
//         $_SESSION['cart'] = [];
//     }


//     $cartidrows = $_SESSION['cart'];

//     echo "Total items: " . sizeof($selectedcarts) . "<br>";

   
//     echo "<br><br>";

//     for($i=0;$i<sizeof($cartidrows);$i++){
    


//         $query = $conn->prepare("SELECT cart_typevariants.cart_id,cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts,quantity,price FROM mydb.cart_typevariants 
//         INNER JOIN mydb.user_cart
//         ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
//         where mydb.cart_typevariants.cart_id=$cartidrows[$i];");
    

//         if($query->execute()){
//             $query->bind_result($cartidnow,$type,$variant,$additionalcosts,$quantity,$price);

            

        
        
//             echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=$cartidrows[$i]'>".$productnamerows[$i]."</a>"."(".$productpricerows[$i].")"."<br>";
            
//             //if there are types
//             echo "<br>";
            
//             $counter = 0;

//             while($query->fetch()){
                


                

//                 if(isset($type)&&$counter!=1){  //only execute header once
//                     $counter=1;

//                     echo "<table>";

//                     echo "<tr>";
//                     echo "<th>type</th>";
//                     echo "<th>variant</th>";
//                     echo "<th>additionalcosts</th>";
//                     echo "</tr>";

                    
//                 } 

//                 if(isset($type)){
//                     echo "<tr>";
//                     echo "<th>$type</th>";
//                     echo "<th>$variant</th>";
//                     echo "<th>$additionalcosts</th>";
//                     echo "</tr>";

//                 }
            

                

//             }

        


        

//             if(isset($type)){  //if there are types within
//                 echo "</table>";

            
//                 echo "QUANTITY: ". $quantity ."<br>";
//                 echo "PRICE: ". $price ."<br>";
//                 echo "<br>";

//                 $totalprice = $totalprice +$price;
                

//             } else {
//                 //if no types   
//                 echo "</table>";
                
            
//                 echo "QUANTITY: ". $arrayforemptytypes[$i][0] ."<br>";
//                 echo "PRICE: ". $arrayforemptytypes[$i][1] ."<br>";
//                 echo "<br>";

//                 $totalprice = $totalprice +$arrayforemptytypes[$i][1];

//             }
        

//             $query->close();

//             unset($type);

        

        
//         } else {
//                 echo "Smthin wnt wrong";
//         }

        
//     }

//     echo "TOTAL (BEFORE GST): " . $totalprice;
//     $totalpricegst = $totalprice * 1.07;
//     echo "<br>TOTAL (AFTER GST): " . "$" . $totalpricegst;
//     echo "<br>";


// } else {
//     echo "Total items: " . sizeof($cartidrows)."<br>";
//     echo "<br><br>";

//     echo "<form  method='POST' action='/swapproj/checkout'>";



//     for($i=0;$i<sizeof($cartidrows);$i++){
    


//         $query = $conn->prepare("SELECT cart_typevariants.cart_id,cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts,quantity,price FROM mydb.cart_typevariants 
//         INNER JOIN mydb.user_cart
//         ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
//         where mydb.cart_typevariants.cart_id=$cartidrows[$i];");
    

//         if($query->execute()){
//             $query->bind_result($cartidnow,$type,$variant,$additionalcosts,$quantity,$price);

//             echo "<input type='checkbox' name ='" . $cartidrows[$i] . "' >";

        
        
//             echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=$cartidrows[$i]'>".$productnamerows[$i]."</a>"."(".$productpricerows[$i].")"."<br>";
            
//             //if there are types
//             echo "<br>";
            
//             $counter = 0;

//             while($query->fetch()){
                


                

//                 if(isset($type)&&$counter!=1){  //only execute header once
//                     $counter=1;

//                     echo "<table>";

//                     echo "<tr>";
//                     echo "<th>type</th>";
//                     echo "<th>variant</th>";
//                     echo "<th>additionalcosts</th>";
//                     echo "</tr>";

                    
//                 } 

//                 if(isset($type)){
//                     echo "<tr>";
//                     echo "<th>$type</th>";
//                     echo "<th>$variant</th>";
//                     echo "<th>$additionalcosts</th>";
//                     echo "</tr>";

//                 }
            

                

//             }

        


        

//             if(isset($type)){  //if there are types within
//                 echo "</table>";

            
//                 echo "QUANTITY: ". $quantity ."<br>";
//                 echo "PRICE: ". $price ."<br>";
//                 echo "<br>";

//                 $totalprice = $totalprice +$price;
                

//             } else {
//                 //if no types   
//                 echo "</table>";
                
            
//                 echo "QUANTITY: ". $arrayforemptytypes[$i][0] ."<br>";
//                 echo "PRICE: ". $arrayforemptytypes[$i][1] ."<br>";
//                 echo "<br>";

//                 $totalprice = $totalprice +$arrayforemptytypes[$i][1];

//             }
        

//             $query->close();

//             unset($type);

        

        
//         } else {
//                 echo "Smthin wnt wrong";
//         }

        
//     }

//     echo "TOTAL (BEFORE GST): " . $totalprice;
//     echo "<br>";
//     echo "Grand Total: " . $totalprice * 1.07;
//     echo '<br>';

//     echo "<input type='submit' name='submit'>";
//     echo "</form>";


// }




































    

?>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

<div class="allcontainer">
    <div class="left">
        <h2 class='bag'>Bag</h2>

        <div class='row'>
            
            <input type='checkbox' class='check'>
            <div class="picture">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';

                    $image = new Image();
                    $src = $image->show("uploads/IMG-DEFAULTPROFILE.jpg");
        
                    echo '<img class="pic" width=150px src="'.$src.'" />';
                ?>
            </div>

            <div class="elements">
                <div class="elementone">
                    <h2 class='name'>Torchlight</h2>
                    <input type='button' value='Edit' class='editbutton'>
                    <h3 class='price'>$15.99</h3>


                </div>

                <div class='tag'>
                    <p class='tagvalues'>Utility,Portable</p>
                </div>

                <div class='variants'>
                    <span class='variantoptions'>Color: Red</span>
                    <span class='variantoptions'>Size: Large</span>

                    <span class='variantoptions'>Weight: 5kg</span>

                </div>

                <div class='quantity'>
                    <p>Quantity: 2</p>
                </div>

                <div class='remove'>
                    <p>Remove from Cart</p>
                </div>
                

            </div>
            
            
        </div>

        <div class='row'>
            
            <input type='checkbox' class='check'>
            <div class="picture">
                <?php
                    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';

                    $image = new Image();
                    $src = $image->show("uploads/IMG-DEFAULTPROFILE.jpg");
        
                    echo '<img class="pic" width=150px src="'.$src.'" />';
                ?>
            </div>

            <div class="elements">
                <div class="elementone">
                    <h2 class='name'>Torchlight</h2>
                    <input type='button' value='Edit' class='editbutton'>
                    <h3 class='price'>$15.99</h3>


                </div>

                <div class='tag'>
                    <p class='tagvalues'>Utility,Portable</p>
                </div>

                <div class='variants'>
                    <span class='variantoptions'>Color: Red</span>
                    <span class='variantoptions'>Size: Large</span>

                    <span class='variantoptions'>Weight: 5kg</span>

                </div>

                <div class='quantity'>
                    <p>Quantity: 2</p>
                </div>

                <div class='remove'>
                    <p>Remove from Cart</p>
                </div>
                

            </div>

    </div>


    

    </div>

    <div class="right">

        <div class='summary'>
            <h6>TPAMC</h6>
            <h4>SUMMARY</h4>

            <div class='subtotal'>
                <span>Subtotal</span>
                <span class='subtotalactl'>$11.98</span>
            </div>

            <div class='taxes'>
                <span>Taxes</span>
                <span>$11.98</span>
            </div>


            <div class='shipping'>
                <span>Shipping</span>
                <span>$11.98</span>
            </div>

            <div class='total'>
                <span>TOTAL</span>
                <span>$11.98</span>
            </div>

            <input type="submit" class='chkoutbtn' value='CHECKOUT' >


        
        </div>


    
</div>






<style>
<?php include 'product/css/viewcart.css';?>
a{color: black !important;}
</style>


<html>
    <head>
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>

    </head>
</html>