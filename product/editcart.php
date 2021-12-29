<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

if (!isset($_GET['cart']) || !isset($jwtarrayinformation['cartarray']) || !isset($jwtarrayinformation['productarray']) || !isset($jwtarrayinformation['productprice'])) {
    header("location: https://www.swapamc.com/swapproj/allproducts?error=badinfo");
    exit;
} elseif (!is_numeric($_GET['cart'])) {
    header("location: https://www.swapamc.com/swapproj/allproducts?error=badinfo");
    exit;
} elseif (sizeof($jwtarrayinformation['cartarray']) < $_GET['cart']) {
    header("location: https://www.swapamc.com/swapproj/allproducts?error=badinfo");
    exit;
}
//renders any scripts into html form of special char e.g., & = &amp
foreach ($_GET as $key => $val) {
    if (gettype($key) == "string" && $key !=="0") {
        $goodkey = htmlentities($key);
        $_GET[$goodkey] = $_GET[$key];
        unset($_GET[$key]);
    }
    //only checks if of string type (integers will not run through htmlspecialchars)
    if (gettype($val) == "string") {
        $goodval = htmlentities($val);
        $_GET[$goodkey] = $goodval;
    }
    if (empty($val)) {
        $_GET[$goodkey] = "0";
    }
}

$order = $_GET['cart'];

$cartarray = $jwtarrayinformation['cartarray'];
$productname = $jwtarrayinformation['productarray'];

$jwtarrayinformation['cart'] = $order;
$price = $jwtarrayinformation['productprice'][$order];


$userid = $jwtarrayinformation['userid'];


jwtupdate($jwtarrayinformation);

try {
    $query = $conn->prepare("SELECT cart_typevariants_type,cart_typevariants_variant,price,quantity FROM mydb.cart_typevariants 
    INNER JOIN mydb.user_cart
    ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
    where mydb.cart_typevariants.cart_id=$cartarray[$order];");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(editcart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=" . $cartarray[$order] . "&error=badstatement");
    exit;
}
$alltypes = [];
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (editcart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=" . $cartarray[$order] . "&error=badstatement"); //    echo mysqli_error($query);

    exit;
}

$query->bind_result($type, $variant, $total, $quantity);

while ($query->fetch()) {
    array_push($alltypes, $type);

    $selectedchoices[$type] = $variant;
}

echo "<h2>" . $productname[$order] . "(" . $price . ")" . "</h2>";




$query->close();




//if there is a type

if (isset($selectedchoices)) {
    $numberofTypes = sizeof($alltypes);

    echo "<form method='POST'>";
    for ($i = 0; $i < $numberofTypes; $i++) {
        $info[$i] = getVariantsFromTypesUsingName($alltypes[$i], $productname, $conn);

        // print_r($info[$i]);

        echo $alltypes[$i] . "<br>";
        $variant = $info[$i][0];
        $pricevariant = $info[$i][1];




        for ($j = 0; $j < sizeof($variant); $j++) {
            if ($pricevariant[$j] != null && $pricevariant[$j] != "" && $pricevariant[$j] != 0) {

                //what the user has chosen before when adding to cart
                if ($selectedchoices[$alltypes[$i]] == $variant[$j]) {
                    echo "<span class='optionscontainer'>" . "<span>" . $variant[$j] . "</span> " . "+S$" . "<span id='price$variant[$j]'>" . $pricevariant[$j] . "</span>" . "<input class=checkbox name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio  id='$variant[$j]' checked >" . "</span>";
                    echo "<br>";
                } else {
                    echo "<span class='optionscontainer'>" . "<span>" . $variant[$j] . "</span> " . "+S$" . "<span id='price$variant[$j]'>" . $pricevariant[$j] . "</span>" . "<input class=checkbox name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio  id='$variant[$j]' >" . "</span>";
                    echo "<br>";
                }
            } else {

                if ($selectedchoices[$alltypes[$i]] == $variant[$j]) {
                    echo $variant[$j]  . "<input class=checkbox value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio name='$alltypes[$i]' checked>";
                    echo "<br>";
                } else {
                    echo $variant[$j]  . "<input class=checkbox value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio name='$alltypes[$i]'>";
                    echo "<br>";
                }
            }
        }

        echo "<br>";
    };

    echo "<p id='left'></p>";


    echo "<p>Quantity: </p>";
    echo "<input id='quantity' onchange='calculatePriceUserSide()' type=number name='quantity' value=$quantity>" . "<br><br>";

    echo "Total Costs: <br>";


    echo "<p id='price'>" . "$" . $total . "</p>";

    echo "<input type='submit' value='edit' formaction='/swapproj/allproducts/product/changes'>";
    echo "<input type='submit' value='delete' formaction='/swapproj/allproducts/product/delete'>";

    echo "</form>";
} else {


    try {
        $query = $conn->prepare("SELECT quantity,price FROM mydb.user_cart WHERE cart_id = $cartarray[$order];");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(editcart)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=" . $cartarray[$order] . "&error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (editcart)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=" . $cartarray[$order] . "&error=badstatement"); //    echo mysqli_error($query);

        exit;
    }




    //if product has no types


    $query->bind_result($quantity, $total);

    if ($query->fetch()) {
        echo "<p>Quantity: </p>";
        echo "<input id='quantity' onchange='calculatePriceUserSide()' type=number name='quantity' value=$quantity>" . "<br><br>";

        echo "Total Costs: <br>";


        echo "<p id='price'>" . "$" . $total . "</p>";

        echo "<input type='submit' value='edit' formaction='/swapproj/allproducts/product/changes'>";
        echo "<input type='submit' value='delete' formaction='/swapproj/allproducts/product/delete' >";

        echo "</form>";
    }
}












?>





































<html>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!-- <script src='https://www.swapamc.com/swapproj/allproducts/product/script'></script> -->
<script type="text/javascript">
    function calculatePriceUserSide() {
        var priceforone = "<?php echo json_encode($price); ?>";


        //cgeckbox are inputfield
        var checkboxesarray = document.getElementsByClassName("checkbox");
        for (let i = 0; i < checkboxesarray.length; i++) {
            if (checkboxesarray[i].checked) {

                var additional = document.getElementById("price" + checkboxesarray[i].id);
                if (!isNaN(parseFloat(additional.innerHTML))) {
                    priceforone = (parseFloat(priceforone) + parseFloat(additional.innerHTML)).toFixed(2);
                }


                // console.log("one" + priceforone);
            } else {


                // var additional = document.getElementById("price"+checkboxesarray[i].id);
                // priceforone = (parseFloat(priceforone) + parseFloat(additional.innerHTML)).toFixed(2);
                // var additional = document.getElementById("price"+checkboxesarray[i].id);
                // priceforone = (parseFloat(priceforone) - parseFloat(additional.innerHTML)).toFixed(2);
                // console.log("nt checked");

                //console.log("one" + priceforone);
            }
        }

        var quantity = document.getElementById("quantity").value;

        var total = (quantity * priceforone).toFixed(2);
        document.getElementById("price").innerHTML = "$" + total;

        calculateInventory();

    }

    // function checkOrUncheck(id){
    //     console.log(id);
    //     if(document.getElementById(id).checked = true){
    //         document.getElementById(id).checked = false;

    //     }
    // }


    function calculateInventory(){

        var typesandvariants = {}; //use json style array as we want to push to ajax

        typesandvariants['type'] = 'ajax';
        typesandvariants['product_name'] = <?php echo json_encode($productname); ?>;

        //cgeckbox are inputfield
        var checkboxesarray = document.getElementsByClassName("checkbox");
        for (let i = 0; i < checkboxesarray.length; i++) {
        
            if (checkboxesarray[i].checked){

                typesandvariants[checkboxesarray[i].getAttribute("name")] = checkboxesarray[i].getAttribute("value");

            
            }
        }




        var jsonString = JSON.stringify(typesandvariants);





        jQuery.ajax({
            url:'https://www.swapamc.com/swapproj/checkquantity',
            type:'post',
            data: {info:jsonString},
            

            success:function(result){

                console.log(result);



                if(result!=null&&result!=''){

                    // console.log(result);
                    document.getElementById("left").innerHTML = "ONLY "+result+" REMAINING";
                    
                    document.getElementById("quantity").setAttribute("max",result);

                    // if(document.getElementById("quantity").value>result){
                    //     document.getElementById("quantity").value = result;
                    //     document.getElementById("quantity").setAttribute("value",result);

                    // }
                    
                }

                
                
                
            }

        });





    }

    //initalise - if product has no types, run this
    calculateInventory();
</script>


</html>