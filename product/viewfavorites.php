<?php
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';


$userid = $jwtarrayinformation['userid'];

//add
try {
    $query = $conn->prepare("SELECT product_name,product_price,product_about,product_picone FROM mydb.usersfavorite
    INNER JOIN mydb.products
    ON mydb.products.product_id = mydb.usersfavorite.product_id WHERE user_id = '$userid';");
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




$query->bind_result($productname,$productprice,$productabout,$productpicone);


while($query->fetch()){
    echo "<table>";

    echo "<tr>";
    echo "<th>Product</th>";
    echo "<th>Price</th>";
    echo "<th>About</th>";
    echo "<th>Picone</th>";

    echo "</tr>";

    

    echo "<tr>";
    echo "<td>$productname</td>";
    echo "<td>$$productprice</td>";
    echo "<td>$productabout</td>";
    echo "<td>$productpicone</td>";

    echo "</tr>";

    echo "</table>";
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