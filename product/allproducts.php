<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';




try {
    $query = $conn->prepare("SELECT product_id,product_name FROM mydb.products;");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(allproducts)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/campus?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (allproducts)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?error=badstatement"); //    echo mysqli_error($query);
    exit;
}



###Zephy
## changed some things
//Search for item 

$query->bind_result($id, $name);



while ($query->fetch()) {
    $allproductslist[$id] = $name;
}

###zeph
//search box
echo '<form action="/swapproj/sortinc" method="post">';
echo '<button type="submit" name="Price" value="Price"></button>';
echo '</form>';



foreach ($allproductslist as $key => $value) {
    echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$key'>$value  </a>";
    echo "<br>";

}
echo "";




?>

<html>
<h1>ALLSTORES</h1>
<a href='https://www.swapamc.com/swapproj/campus'><input type=button name=employeemanager value='Home'></a>

</html>