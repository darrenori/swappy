<?php
## Originally addtocart.php


if (!isset($_POST)) {

    header("location: https://www.swapamc.com/swapproj/product/viewcart");
    exit();
}

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


//take note
if (!isset($jwtarrayinformation["progresscheckout"])) {
    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart");
    exit;
} elseif ($jwtarrayinformation["progresscheckout"] != 'A') {
    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart");
    exit;
}


//checks quantity
if ($_POST['quantity'] < 1) {
    header("location: https://www.swapamc.com/swapproj/allproducts?error=badquantity");
    exit();
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';






foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";

    if ($key != "quantity") {
        $postinformation[$key] = $value;
    }
}


echo "<br><br><br><br> I am the quantity: " . $_POST['quantity'] . "<br><br><br><br>";


var_dump($postinformation);
if (!isset($postinformation)) {
    //if they tryna enter funny business yo
}










session_start();
$productid = $jwtarrayinformation["productid"];
$quantity = $_POST["quantity"];







try {
    $query = $conn->prepare("SELECT type,type_choice,additional_costs,product_price FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE  mydb.product_type.product_id =$productid;");

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(addtocart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (addtocart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement"); //    echo mysqli_error($query);

    exit;
}


//new
$checkIfValuesTampered = [];





//this query is to check that there hasnt been interception
$query->bind_result($db_type, $db_type_choice, $db_additional_costs, $db_product_price);



#adssd

while ($checkempty = $query->fetch()) {
    $db_type = strval($db_type);
    $db_type = preg_replace('/\s+/', '_', $db_type);



    array_push($checkIfValuesTampered, $db_type_choice);



    for ($i = 0; $i < sizeof($postinformation); $i++) {
        if (isset($postinformation[$db_type])) { //is a valid type as checked from database.
            //we know that key is valid. 

            if ($postinformation[$db_type] == $db_type_choice) {
                //we know that value is valid. key will also be valid(from prev check)
                $choiceAndExtraCosts = [$db_type_choice, $db_additional_costs];
                $validtypes[$db_type] = $choiceAndExtraCosts;
            } else {

                //not any catcher here as 1 type can have multiple options. e.g. red and blue colors
                // echo $db_type_choice;
                // echo "interception detected value ";
            }
        } else {
            echo "interception deleted key " . "<br>";
            echo "here->";
            print_r($db_type);
            echo "<br>";
        }
    }
}




for ($i = 0; $i < sizeof($checkIfValuesTampered); $i++) {

    if ($checkIfValuesTampered[$i] == $db_type_choice) {
        echo "found";
        break;
    }

    if ($checkIfValuesTampered[$i] == sizeof($checkIfValuesTampered)) {
        echo "interception has been detected. We are logging you off";
    }
}

if (!$checkempty) { //if the product has no types

    $query->close();
    try {
        $query = $conn->prepare("SELECT product_price FROM mydb.products WHERE product_id=$productid;");

        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(addtocart)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (addtocart)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement"); //    echo mysqli_error($query);

        exit;
    }

    $query->bind_result($db_empty_price);
    if ($query->fetch()) {
        $total = $quantity * $db_empty_price;
    }
}












if (isset($validtypes)) {
    $typestotalcost = 0;
    foreach ($validtypes as $key => $value) {
        $typestotalcost = $typestotalcost + $validtypes[$key][1];
    }
}

if (isset($typestotalcost)) {
    $total = $typestotalcost + $db_product_price;
    $total = $quantity * $total;
}








$cartidrandom = floatval(rand(pow(10, 8 - 1), pow(10, 8) - 1));
//echo "<br>RANDOM" .$cartidrandom."<br>";

$userid = $jwtarrayinformation['userid'];

$query->close();

try {
    $query = $conn->prepare("INSERT INTO mydb.user_cart (mydb.user_cart.cart_id,mydb.user_cart.user_id, mydb.user_cart.product_id,mydb.user_cart.quantity,mydb.user_cart.price) VALUES ($cartidrandom,$userid,$productid,$quantity,$total);");

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(addtocart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (addtocart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement"); //      echo $query->error;
    exit;
}


$query->close();

if (isset($validtypes)) {
    foreach ($validtypes as $types => $variants) {
        $variantandprice = $validtypes[$types];
        // echo "---------------------";
        // echo $types."<br>".$variantandprice[0]."<br>".$variantandprice[1]."<br>".$cartidrandom;
        $typevariant = strval($variantandprice[0]);



        $price = floatval($variantandprice[1]);

        try {
            $newquery = $conn->prepare("INSERT INTO mydb.cart_typevariants (cart_typevariants_type, cart_typevariants_variant, cart_additionalcosts, cart_id) VALUES ('$types','$typevariant',$price,$cartidrandom)");

            if ($newquery === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(addtocart)");  // echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>";

            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $newquery->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (addtocart)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=" . $productid . "&error=badstatement"); //  echo $newquery->error;
            exit;
        } finally {
            $newquery->close();
        }

    }
}



header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart");
