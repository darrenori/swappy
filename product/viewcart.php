<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

$userid = $jwtarrayinformation['userid'];

try {
    $query = $conn->prepare("SELECT cart_id,product_name,product_price,product_picone,quantity,price FROM mydb.user_cart 
    INNER JOIN mydb.products
    ON mydb.user_cart.product_id = mydb.products.product_id
    WHERE user_id = $userid");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(viewcart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/campus?page=viewcart&error=badstatement");
    exit;
}
$cartidrows = [];
$productnamerows = [];
$productpricerows = [];
$arrayforemptytypes = [];
$totalprice = 0;
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (viewcart)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?page=viewcart&error=badstatement"); //    echo mysqli_error($query);

    exit;
}



$query->bind_result($cartid, $productname, $productprice, $productpic, $emptyquantity, $emptyprice);
while ($query->fetch()) {
    // echo $emptyquantity."<br>".$emptyprice."<br>";

    array_push($cartidrows, $cartid);
    array_push($productnamerows, $productname);
    array_push($productpricerows, $productprice);
    array_push($arrayforemptytypes, [$emptyquantity, $emptyprice]);
}

$jwtarrayinformation['cartarray'] = $cartidrows;
$jwtarrayinformation['productarray'] = $productnamerows;
$jwtarrayinformation['productprice'] = $productpricerows;
jwtupdate($jwtarrayinformation);

$query->close();

echo "Total items: " . sizeof($cartidrows) . "<br>";



for ($i = 0; $i < sizeof($cartidrows); $i++) {


    try {
        $query = $conn->prepare("SELECT cart_typevariants.cart_id,cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts,quantity,price FROM mydb.cart_typevariants 
        INNER JOIN mydb.user_cart
        ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
        where mydb.cart_typevariants.cart_id=$cartidrows[$i];");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(viewcart)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/campus?page=viewcart&error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (viewcart)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/campus?page=viewcart&error=badstatement"); //    echo mysqli_error($query);

        exit;
    }




    $query->bind_result($cartidnow, $type, $variant, $additionalcosts, $quantity, $price);

    echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/editcart?cart=$i'>" . $productnamerows[$i] . "</a>" . "(" . $productpricerows[$i] . ")" . "<br>";

    //if there are types


    $counter = 0;

    while ($checkEmpty = $query->fetch()) {


        if (isset($type) && $counter != 1) {  //only execute header once
            $counter = 1;

            echo "<table>";

            echo "<tr>";
            echo "<th>type</th>";
            echo "<th>variant</th>";
            echo "<th>additionalcosts</th>";
            echo "</tr>";
        }

        if (isset($type)) {
            echo "<tr>";
            echo "<th>$type</th>";
            echo "<th>$variant</th>";
            echo "<th>$additionalcosts</th>";
            echo "</tr>";
        }
    }



    if (isset($type)) {  //if there are types within
        echo "</table>";


        echo "QUANTITY: " . $quantity . "<br>";
        echo "PRICE: " . $price . "<br>";
        echo "<br>";

        $totalprice = $totalprice + $price;
    } else {
        echo "</table>";



        echo "QUANTITY: " . $arrayforemptytypes[$i][0] . "<br>";
        echo "PRICE: " . $arrayforemptytypes[$i][1] . "<br>";
        echo "<br>";

        $totalprice = $totalprice + $arrayforemptytypes[$i][1];
    }

    echo "TOTAL (BEFORE GST): " . $totalprice."<br>";

    $query->close();
}




?>

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
<a href='https://www.swapamc.com/swapproj/campus'><input type=button name=employeemanager value='Home'></a>

</html>