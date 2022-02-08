<html>
<?php
if(!isset($selectedcarts)){
    echo '<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>';

}

?>
<?php
ob_start();
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';

if (!isset($selectedcarts)){
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/navbar.php';
}


?>

<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';




require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

$csrf = generateCSRF();

$jwtarray = jwtdecrypt();
if (isset($jwtarray) && $jwtarray == true) {

    $jwtarrayinformation = $jwtarray['array'];
} else {

    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

$userid = $jwtarrayinformation['userid'];

$query = $conn->prepare("SELECT cart_id,product_name,product_price,product_picone,quantity,price FROM mydb.user_cart 
    INNER JOIN mydb.products
    ON mydb.user_cart.product_id = mydb.products.product_id
    WHERE user_id = ? AND mydb.user_cart.purchased='0';");
$query->bind_param('s', $userid);
$cartidrows = [];
$productnamerows = [];
$productpricerows = [];
$arrayforemptytypes = [];
$productpicrows = [];
$totalprice = 0;

if ($query->execute()) {
    $query->bind_result($cartid, $productname, $productprice, $productpic, $emptyquantity, $emptyprice);
    while ($query->fetch()) {
        // echo $emptyquantity."<br>".$emptyprice."<br>";

        array_push($cartidrows, $cartid);
        array_push($productnamerows, $productname);
        array_push($productpricerows, $productprice);
        array_push($arrayforemptytypes, [$emptyquantity, $emptyprice]);
        array_push($productpicrows,$productpic);
    }
}

//  print_r($arrayforemptytypes[1]);



$query->close();

if (isset($selectedcarts)) {
    // echo 'Hi there. If you cannot find me, look at viewcart.php'."<br>";
    // for checkout page
    if (!empty($selectedcarts)) {
        //this code should only run in view cart page
        $_SESSION['cart'] = array_values($selectedcarts);
    } else if (!isset($_SESSION['cart'])) {
        // this code runs if session was not set
        $_SESSION['cart'] = [];
    }


    $cartidrows = $_SESSION['cart'];

    echo "Total items: " . sizeof($selectedcarts) . "<br>";


    echo "<br>";















    for ($i = 0; $i < sizeof($cartidrows); $i++) {
        $query = $conn->prepare("SELECT cart_typevariants.cart_id,cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts,quantity,price FROM mydb.cart_typevariants 
        INNER JOIN mydb.user_cart
        ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
        where mydb.cart_typevariants.cart_id=$cartidrows[$i];");
        if (!isset($productnamerows[$i])) {
            break;
        }

        if ($query->execute()) {
            $query->bind_result($cartidnow, $type, $variant, $additionalcosts, $quantity, $price);





            echo "<a style='background-color:white; color:black; font-weight:bold; text-decoration:none; font-size:1.8em;' href='https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=$cartidrows[$i]'>" . $productnamerows[$i] . "</a>" . "<br>". " ($" . $productpricerows[$i] . ")" . "<br>";

            //if there are types
            echo "<br>";

            $counter = 0;

            while ($query->fetch()) {





                if (isset($type) && $counter != 1) {  //only execute header once
                    $counter = 1;

                    echo "<table class='styled-table'>";

                    echo "<tr><thead>";
                    echo "<th style='background-color:#8D1D25; color:white;'>Type</th>";
                    echo "<th style='background-color:#8D1D25; color:white;'>Variant</th>";
                    echo "<th style='background-color:#8D1D25; color:white;'>Additional Costs</th>";
                    echo "</tr></thead>";
                }

                if (isset($type)) {
                    echo "<tr><thead>";
                    echo "<th style='background-color:white; color:black;'>$type</th>";
                    echo "<th style='background-color:white; color:black;'>$variant</th>";
                    echo "<th style='background-color:white; color:black;'>$ $additionalcosts</th>";
                    echo "</tr></thead>";
                }
            }






            if (isset($type)) {  //if there are types within
                echo "</table>";


                echo "QUANTITY: " . $quantity . "<br>";
                echo "PRICE: $" . $price . "<br>";
                echo "<br>";

                $totalprice = $totalprice + $price;
            } else {
                //if no types   
                echo "</table>";


                echo "QUANTITY: " . $arrayforemptytypes[$i][0] . "<br>";
                echo "PRICE: " . $arrayforemptytypes[$i][1] . "<br>";
                echo "<br>";

                $totalprice = $totalprice + $arrayforemptytypes[$i][1];
            }


            $query->close();

            unset($type);
        } else {
            echo "Smthin wnt wrong";
        }
    }

    echo "<div style='background-color:#707070; height:15%; text-align:right; padding:1vw; width:97.5%;'>";
    $totalpricegst = $totalprice * 1.07;
    $gst = $totalpricegst - $totalprice;
    echo "Subtotal:" . "<span style='background-color:#707070; color:white; margin-left:10vw;'>$" . $totalprice . "</span>";
    echo "<br>Taxes:" . "<span style='background-color:#707070; color:white; margin-left:10vw;'>$" . $gst . "</span><br>";
    echo "<br><hr>";
    echo "<br><span style='background-color:#707070; color:white; '>Grand Total:</span>" . "<span style='background-color:#707070; color:#8D1D25; margin-left:10vw; font-weight:bold;'>$" . $totalpricegst . "</span></div>";
    echo "<br>";
} else {
    // echo "Total items: " . sizeof($cartidrows)."<br>";
    // echo "<br><br>";

    echo '<div class="allcontainer">';
    echo '<div class="left">';

    echo "<a href='https://www.swapamc.com/swapproj/allproducts'><h2 class='bag'>Bag: " . sizeOf($cartidrows) . " Items</h2></a>";


    echo "<form id='chkoutform' method='POST' action='/swapproj/checkout'>";




    for ($i = 0; $i < sizeof($cartidrows); $i++) {



        $query = $conn->prepare("SELECT cart_typevariants.cart_id,cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts,quantity,price FROM mydb.cart_typevariants 
        INNER JOIN mydb.user_cart
        ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
        where mydb.cart_typevariants.cart_id=$cartidrows[$i];");


        if ($query->execute()) {
            $query->bind_result($cartidnow, $type, $variant, $additionalcosts, $quantity, $price);

            echo "<div class='row'>";


            echo "<input onchange='updatePricing()' type='checkbox' class='check' name ='" . $cartidrows[$i] . "' >";
            echo "<div class='picture'>";

            require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
            $scpic = $productpicrows[$i];
            $image = new Image();
            $src = $image->show($scpic);

            

            echo '<img class="pic" width=150px height=150px src="' . $src . '" />';


            echo "</div>";


            // echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=$cartidrows[$i]'>".$productnamerows[$i]."</a>"."(".$productpricerows[$i].")"."<br>";



            echo "<div class='elements'>";
            echo "<div class=\"elementone\">";
            echo "<div class='test'>";
            echo "<h2 class='name'>" . $productnamerows[$i] . "</h2>";
            echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=$cartidrows[$i]'><input type='button' value='Edit' class='editbutton'></a>";
            echo "</div>";
            echo "<h3 class='price'>" . $productpricerows[$i] . " /ea</h3>";
            echo "</div>";

            echo "<div class='tag'>";
            echo "<p class='tagvalues'>Utility,Portable</p>";
            echo "</div>";


            //if there are types    
            $counter = 0;
            $arrayfordesign = [];
            while ($query->fetch()) {







                if (isset($type) && $counter != 1) {  //only execute header once
                    $counter = 1;
                }

                if (isset($type)) {
                    $arrayfordesign[$type] = $variant . "($" . $additionalcosts . ")";
                    // echo "<tr>";
                    // echo "<th>$type</th>";
                    // echo "<th>$variant</th>";
                    // echo "<th>$additionalcosts</th>";
                    // echo "</tr>";

                }
            }

            if (isset($type)) {
                echo "<div class='variants'>";
                foreach ($arrayfordesign as $key => $val) {
                    echo "<span class='variantoptions'>$key: $val</span>";
                }
                echo "</div>";
            }







            if (isset($type)) {  //if there are types within
                // echo "</table>";

                echo "<div class='quantity'>";
                // echo "QUANTITY: ". $quantity ."<br>";
                // echo "PRICE: ". $price ."<br>";
                echo "<span>Quantity: $quantity</span>";
                echo "<span id='ittotal". $cartidrows[$i]."' class='ittotal'>S$$price Total</span>";
                echo "</div>";


                $totalprice = $totalprice + $price;
            } else {
                //if no types   
                // echo "</table>";

                echo "<div class='quantity'>";

                // echo "QUANTITY: ". $arrayforemptytypes[$i][0] ."<br>";
                // echo "PRICE: ". $arrayforemptytypes[$i][1] ."<br>";
                echo "<span>Quantity: " . $arrayforemptytypes[$i][0] . "</span>";
                echo "<span id='ittotal". $cartidrows[$i]."' class='ittotal'>S$" . $arrayforemptytypes[$i][1] . " Total</span>";

                echo "</div>";

                $totalprice = $totalprice + $arrayforemptytypes[$i][1];
            }


            $query->close();

            // echo "<div class='remove'>";
            // echo "<p>Remove from Cart</p>";
            // echo "</div>";

            echo "</div>";
            echo "</div>";

            unset($type);
        } else {
            echo "Smthin wnt wrong";
        }
    }

    echo "</div>";

    // echo "TOTAL (BEFORE GST): " . $totalprice;
    // echo "<br>";
    // echo "Grand Total: " . $totalprice * 1.07;
    // echo '<br>';

    echo "<input type='hidden' name='csrf' value='$csrf'>";

    echo "<input type='hidden' name='submit' value='submit'>";
    echo "</form>";

    echo "<div class=\"right\">";

    echo "<div class='summary'>";
    echo "<h6>TPAMC</h6>";
    echo "<h4>SUMMARY</h4>";

    echo "<div class='subtotal'>";
    echo "<span>Subtotal</span>";
    echo "<span class='subtotalactl' id='subber'>S$0.00</span>";
    echo "</div>";

    echo "<div class='taxes'>";
    echo "<span>Taxes</span>";
    echo "<span id='taxes'>S$0.00</span>";
    echo "</div>";


    echo "<div class='shipping'>";
    echo "<span>Shipping</span>";
    echo "<span>FOC</span>";
    echo "</div>";

    echo "<div class='total'>";
    echo "<span>TOTAL</span>";
    echo "<span id='total'>S$0.00</span>";
    echo "</div>";

    echo "<input type='submit' class='chkoutbtn' value='CHECKOUT' form='chkoutform'>";



    echo "</div>";



    echo "</div>";
}






































?>





<style>
    <?php
    if (!isset($selectedcarts)) {
        include 'product/css/viewcart.css';
    }



    ?>a {
        color: black !important;
    }
</style>


<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>

</head>

</html>

<script>
    function updatePricing(){
        var checkboxesarray = document.getElementsByClassName("check");
        // console.log(checkboxesarray);
        var subtotal=0;
        for (let i = 0; i < checkboxesarray.length; i++) {
            if(checkboxesarray[i].checked){
                name= checkboxesarray[i].name;
                if(name!=null){
                    name = "ittotal"+name;
                    price= document.getElementById(name).innerHTML;
                    price = price.split(" ")[0];
                    price=price.substr(2);
                    
                    
                    if(!isNaN(price)){
                        price = parseFloat(price);  
                        subtotal = subtotal+price;
                        // console.log(price);
                    }


                } 
                
            } else {
                continue;
            }
            
            
        }

        // console.log(subtotal);

        subtotal = subtotal.toFixed(2);
        subtotal = parseFloat(subtotal);
        var taxes=0;
        var total=0;
        
        taxes = parseFloat(subtotal*0.07);
        taxes = taxes.toFixed(2);
        taxes = parseFloat(taxes);  


        total = taxes+subtotal;
        total = parseFloat(total);
        total = total.toFixed(2);

        

        document.getElementById('subber').innerHTML = "S$"+subtotal;
        document.getElementById('taxes').innerHTML = "S$"+taxes;
        document.getElementById('total').innerHTML = "S$"+total;



        
    }
</script>
<?php
ob_flush();

?>