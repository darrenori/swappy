<?php


//Import all required files
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';



//get all product names line 11-71
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

if (isset($_POST['searchitem'])) {
    $searchitem = $_POST['searchitem'];
    //get all product names 
    if (isset($allproductslist)) {
        foreach ($allproductslist as $key => $value) {
            $matchessearch = str_contains(strtolower($value), strtolower($searchitem));
            if (!$matchessearch) {
                unset($allproductslist[$key]);
            }
        }
    }
    if (empty($allproductslist)) {
        echo"no results for <i>".$searchitem."<i>";
    }else{
        echo"Showing results for <i>".$searchitem."<i><br>";
    }
}


foreach ($allproductslist as $key => $value) {
    echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$key'>$value  </a>";
    echo "<br>";

}
echo "";


//get all store names


//alter results
//provide links to them 

