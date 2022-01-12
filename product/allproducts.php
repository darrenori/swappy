<?php

////  WHITELIST OF GETITEMS (IF ADDING ANY MORE NAMES TO GET FORM, be sure to append them here.)
$sortitems = ['sortname', 'sortprice'];
$categories = ['catrouter', 'cataccessory', 'catswitch', 'catutility', 'catothers'];
$sortprice=false;
$sortname=false;
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





###Zeph 
##SORTING BY Category
// Buttons with categories
$specialkey = "HSHTY6";
$selectedcategory; //used to identify selected category
echo '<form action="/swapproj/allproducts" method="get">';
echo '<button type="submit" value="' . $specialkey . '" name="catrouter" >ROUTERS</button>';
echo '<button type="submit" value="' . $specialkey . '" name="cataccessory" >ACCESSORIES</button>';
echo '<button type="submit" value="' . $specialkey . '" name="catswitch" >SWITCHES</button>';
echo '<button type="submit" value="' . $specialkey . '" name="catutility" >UTILITY</button>';
echo '<button type="submit" value="' . $specialkey . '" name="catothers" >OTHERS</button>';
echo '</form>';

// Results alteration
// 
// Print out results

//alters the query to return allproductslist by category if selected
if (empty($_GET)) {
    $pricevalue = "ascending";
    $namevalue = "ascending";
} else {

    ## allowing for only known GET keys
    foreach ($_GET as $key => $value) {
        if (!(in_array($key, $sortitems) || in_array($key, $categories))) {
            // removes any items with special $_GET keys
            unset($_GET[$key]);
        }
    }
    $sortprice = isset($_GET['sortprice']);
    $sortname = isset($_GET['sortname']);
    // if category button was clicked
    foreach ($_GET as $key => $value) {
        // sets the index of categories table to $selectedcategory, so we can retrieve the items from the db
        foreach ($categories as $catindex => $cattype) {
            if ($key === $cattype) {
                $selectedcategory = $catindex + 1;
                $selectedcategoryname =$key;
                $query->close();
                try {
                    $query = $conn->prepare("SELECT products.product_id,product_name,product_price FROM mydb.products INNER JOIN mydb.productcat ON mydb.products.product_id = mydb.productcat.product_id WHERE mydb.productcat.cat_id=?");
                    $query->bind_param('i', $selectedcategory);
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(allproducts)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    //change header location accordingly
                    // header("location: https://www.swapamc.com/swapproj/allproducts?error=badstatement");
                    exit;
                }
                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (allproducts)");
                    }break;
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    // header("location: https://www.swapamc.com/swapproj/allproducts?error=badstatement"); //    echo mysqli_error($query);
                    exit;
                }
        
            }
        }
    }
}

###Zephy
## changed some things
//Search for item 

$query->bind_result($id, $name, $price);



while ($query->fetch()) {
    $allproductslist[$id] = [$price, $name];
}



## SORTING BY PRICE AND ALPHABET
if ($sortprice) {
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
if ($sortname) {
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

// Here's where we try to implement stacking (diddn't work, need to find out how to get the GET from the url)
$currenturlstripped = preg_replace('/[^a-zA-Z0-9\=\?\/(\/swapproj)]+/', '', $_SERVER['REQUEST_URI']);

###zeph
//sort only box
echo '<form action="' . $currenturlstripped . '" method="get">';
if (!empty($selectedcategory)) {
    echo '<input type="hidden" value="' . $specialkey . '" name="'.$selectedcategoryname.'" ></input>';
    // $pricevalue=$pricevalue."&".$key."=".$specialkey;
    // $namevalue=$namevalue."&".$key."=".$specialkey;
}
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