<?php




//db con
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


checkIfIdExists($conn);

    //renders any scripts into html form of special char e.g., & = &amp
    foreach ($_GET as $key => $val) {
        if (gettype($key) == "string" && $key !== "0") {
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

    // $getuser = htmlentities($_GET["user"]);
    // $employeeid = $getuser;
    
//if checkIfIdExists has run, the following line of code will be safe
$id = $_GET["id"];
//set the id into jwt storage for error handling
//remember to remove the jwt


try {
    $query = $conn->prepare("SELECT * FROM mydb.storeprod
    INNER JOIN mydb.products
    ON mydb.products.product_id = mydb.storeprod.product_id
    INNER JOIN mydb.store
    ON mydb.store.store_id = mydb.storeprod.store_id
    WHERE mydb.storeprod.product_id = $id");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(product)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts?id=" . $productid . "&error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (product)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/allproducts?id=" . $productid . "&error=badstatement"); //    echo mysqli_error($query);
    exit;
}


//convert to array. 
//$query->bind_result() works too
$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);



$product_name = $array[0]['product_name'];
$product_price = $array[0]['product_price'];
$product_about = $array[0]['product_about'];
$store_name = $array[0]['store_name'];
echo "<h2>Store: " . $store_name . "</h2>";
echo "Name: " . $product_name . "<br>";

echo "Price: " . $product_price . "<br>";
echo "About: " . $product_about . "<br><br><br>";




$alltypes = getTypeForProduct($id, $conn);


$numberofTypes = sizeof($alltypes);

echo "<form method='POST' action='/swapproj/allproducts/product/addtocart'>";
for ($i = 0; $i < $numberofTypes; $i++) {
    $info[$i] = getVariantsFromTypes($alltypes[$i], $id, $conn);
    $executedonce = false;

    // print_r($info[$i]);

    echo $alltypes[$i] . "<br>";
    $variant = $info[$i][0];
    $pricevariant = $info[$i][1];
    for ($j = 0; $j < sizeof($variant); $j++) {
        if ($pricevariant[$j] != null && $pricevariant[$j] != "" && $pricevariant[$j] != 0) {
            //  sets checkbox to checked if it was the first one to be executed
            if ($executedonce === false) {
                echo "<span class='optionscontainer'>" . "<span>" . $variant[$j] . "</span> " . "+S$" . "<span id='price$variant[$j]'>" . $pricevariant[$j] . "</span>" . "<input class=checkbox name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()'  type=radio  id='$variant[$j]' checked>" . "</span>";
                echo "<br>";
                $executedonce = true;
            } else {
                echo "<span class='optionscontainer'>" . "<span>" . $variant[$j] . "</span> " . "+S$" . "<span id='price$variant[$j]'>" . $pricevariant[$j] . "</span>" . "<input class=checkbox name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio  id='$variant[$j]'>" . "</span>";
                echo "<br>";
                $executedonce = true;
            }
        } else {
            if ($executedonce === false) {

                echo $variant[$j]  . "<input class=checkbox value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio name='$alltypes[$i]' checked>";
                echo "<br>";
                $executedonce = true;
            } else {
                echo $variant[$j]  . "<input class=checkbox value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio name='$alltypes[$i]'>";
                echo "<br>";
                $executedonce = true;
            }
        }
    }

    echo "<br>";
};


echo "<p>Quantity: </p>";
echo "<input id='quantity' onchange='calculatePriceUserSide()' type=number name='quantity' value=1>" . "<br><br>";

echo "Total Costs: <br>";


echo "<p id='price'>" . "$" . $product_price . "</p>";

echo "<input type='submit' name='submit' onclick=defaultCheck >";

echo "</form>";



//store initial session variables
session_start();
$jwtarrayinformation["productid"] = $id;
$jwtarrayinformation["progresscheckout"] = 'A';
jwtupdate($jwtarrayinformation);






?>

<html>

<!-- <script src='https://www.swapamc.com/swapproj/allproducts/product/script'></script> -->
<script type="text/javascript">
    function defaultCheck() {
        var checkboxesarray = document.getElementsByClassName("checkbox");

        if (checkboxesarray.length > 0) {


        }
    }

    function calculatePriceUserSide() {

        var quantity = document.getElementById("quantity").value;

        if (quantity < 1) {
            quantity = 1;
            document.getElementById("quantity").value = 1;
        }


        var priceforone = "<?php echo json_encode($product_price); ?>";


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