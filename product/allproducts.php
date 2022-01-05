<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/sort.inc.php';




try {
    $query = $conn->prepare("SELECT product_id,product_name,product_price FROM mydb.products;");
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

$query->bind_result($id, $name, $price);



while ($query->fetch()) {
    $allproductslist[$id] = [$price, $name];
}

//currently unable to stack sorts
if (!empty($_GET)) {
    if (isset($_GET['sortprice'])) {
        if ($_GET['sortprice'] === "descending" || $_GET['sortprice'] === "ascending") {
            $sortPricedirection = htmlentities($_GET['sortprice']);
            if ($sortPricedirection === "descending") {
                $pricevalue = "none";
                arsort($allproductslist);
            } else if ($sortPricedirection === "ascending") {
                $pricevalue = "descending";
                asort($allproductslist);
            } else {
                $pricevalue = "ascending";
            }
        } else {
            $pricevalue = "ascending";
        }
    } else {
        //default is ascending
        $pricevalue = "ascending";
    }
    if (isset($_GET['sortname'])) {
        if ($_GET['sortname'] === "descending" || $_GET['sortname'] === "ascending") {
            $sortNamedirection = htmlentities($_GET['sortname']);
            if ($sortNamedirection === "descending") {
                $namevalue = "none";
                rsort($allproductslist);
            } else if ($sortNamedirection === "ascending") {
                $namevalue = "descending";
                sort($allproductslist);
            } else {
                $namevalue = "ascending";
            }
        } else {
            $namevalue = "ascending";
        }
    } else {
        //default is ascending
        $namevalue = "ascending";
    }
} else {
    $pricevalue = "ascending";
    $namevalue = "ascending";
}

###zeph
//sort only box
echo '<form action="/swapproj/allproducts" method="get">';
echo '<button type="submit" name="sortprice" value="' . $pricevalue . '">Price</button><br>';
echo '<button type="submit" name="sortname" value="' . $namevalue . '">AZ</button><br>';
echo '</form>';




foreach ($allproductslist as $key => $val) {
    echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$key'>$val[1] </a>";
    echo "<br>";
}
echo "";




?>

<html>


<h1>All Products</h1>
<a href='https://www.swapamc.com/swapproj/campus'><input type=button name=employeemanager value='Home'></a>

</html>