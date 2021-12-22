<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
$order = $_GET['cart'];
$cartarray = $jwtarrayinformation['cartarray'];
$productname = $jwtarrayinformation['productarray'];

$jwtarrayinformation['cart'] = $order;
$price = $jwtarrayinformation['productprice'][$order];


$userid = $jwtarrayinformation['userid'];


if (!isset($_GET['cart']) || !isset($jwtarrayinformation['cartarray']) || !isset($jwtarrayinformation['productarray']) || !isset($jwtarrayinformation['productprice'])) {
    header("location: ../product/viewcart");
} elseif (!is_numeric($_GET['cart'])) {
    header("location: ../product/viewcart");
} elseif (sizeof($jwtarrayinformation['cartarray']) < $_GET['cart']) {
    header("location: ../product/viewcart");
}
jwtupdate($jwtarrayinformation);


$query = $conn->prepare("SELECT cart_typevariants_type,cart_typevariants_variant,price,quantity FROM mydb.cart_typevariants 
    INNER JOIN mydb.user_cart
    ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
    where mydb.cart_typevariants.cart_id=$cartarray[$order];");
$alltypes = [];

if ($query->execute()) {
    $query->bind_result($type, $variant, $total, $quantity);

    while ($query->fetch()) {
        array_push($alltypes, $type);

        $selectedchoices[$type] = $variant;
    }
}

echo "<h2>" . $productname[$order] . "(" . $price . ")" . "</h2>";




$query->close();




//if there is a type

if (isset($selectedchoices)) {
    $numberofTypes = sizeof($alltypes);

    echo "<form method='POST'>";
    for ($i = 0; $i < $numberofTypes; $i++) {
        $info[$i] = getVariantsFromTypesUsingName($alltypes[$i], $productname[$order], $conn);

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


    echo "<p>Quantity: </p>";
    echo "<input id='quantity' onchange='calculatePriceUserSide()' type=number name='quantity' value=$quantity>" . "<br><br>";

    echo "Total Costs: <br>";


    echo "<p id='price'>" . "$" . $total . "</p>";

    echo "<input type='submit' value='edit' formaction='/swapproj/allproducts/product/changes'>";
    echo "<input type='submit' value='delete' formaction='/swapproj/allproducts/product/delete'>";

    echo "</form>";
} else {
    //if product has no tytpwes

    $query = $conn->prepare("SELECT quantity,price FROM mydb.user_cart WHERE cart_id = $cartarray[$order];");

    if ($query->execute()) {
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
    } else {
        header("location: ../swapproj/allproducts/product/editcart?error=stmtfailed");
        exit();
    }
}














?>





































<html>

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

    }

    // function checkOrUncheck(id){
    //     console.log(id);
    //     if(document.getElementById(id).checked = true){
    //         document.getElementById(id).checked = false;

    //     }
    // }
</script>


</html>