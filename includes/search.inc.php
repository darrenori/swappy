<?php

if (!isset($_POST['searchitem'])) {
    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    exit;
} else {
    $searchitem = $_POST['searchitem'];
}


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



//get all store names

try {
    $query = $conn->prepare("SELECT store_id,store_name FROM mydb.store;");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(allstores)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/campus?page=stores?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (allstores)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?page=stores?error=badstatement"); //    echo mysqli_error($query);

    exit;
}

###Zephy
## changed some things
//Search for item 

$query->bind_result($storeID, $storeNAME);
while ($query->fetch()) {
    $allstoreslist[$storeID] = $storeNAME;
}

if (isset($_POST['searchitem'])) {
    $searchitem = $_POST['searchitem'];
    $filteredproductslist = [];
    $filteredstoreslist = [];

    ////// FOLLOWING IF STATEMENTS REMOVE ANY 
    //get all product names 
    if (isset($allstoreslist)) {
        foreach ($allstoreslist as $key => $value) {
            $matchessearch = str_contains(strtolower($value), strtolower($searchitem));
            if (!$matchessearch) {
                unset($filteredstoreslist[$key]);
            }
        }
    }
    if (isset($allproductslist)) {
        foreach ($allproductslist as $key => $value) {
            $matchessearch = str_contains(strtolower($value), strtolower($searchitem));
            if ($matchessearch) {
                $filteredproductslist[$key] = $value;
            }
        }
    }


    if (empty($filteredproductslist) and empty($filteredstoreslist)) {
        echo "No search results for <i>" . $searchitem . "</i><br>";
        $specialproductlist=[];

        ### SUGGEST RESULTS   ####
        if (strpos($searchitem, "r") !== false) {
            $specialkey="Router";
        }else if (strpos($searchitem, "c")!==false) {
            $specialkey="Cisco";
        }else $specialkey="Router";
        echo "Showing <b>Product</b> results for <i>".$specialkey."</i> instead.<br>";
        if (isset($allproductslist)) {
            foreach ($allproductslist as $key => $value) {
                $matchessearch = str_contains(strtolower($value), strtolower($specialkey));
                if ($matchessearch) {
                    $specialproductlist[$key] = $value;
                }
            }
            foreach ($specialproductlist as $key => $value) {
                echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$key'>$value  </a>";
                echo "<br>";
            }
            echo "<br><br>";
        }

    }
    //print out product results
    if (!empty($filteredproductslist)) {
        echo "Showing <b>Product</b> results for <i>" . $searchitem . "</i><br>";
        foreach ($filteredproductslist as $key => $value) {
            echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$key'>$value  </a>";
            echo "<br>";
        }
        echo "<br><br>";
    }


    //print out store results
    if (!empty($filteredstoreslist)) {
        echo "Showing <b>Store</b> results for <i>" . $searchitem . "</i><br>";
        foreach ($filteredstoreslist as $key => $value) {
            echo "<a href='https://www.swapamc.com/swapproj/allstores/store?id=$storeID'>$storeNAME</a>";
            echo "<br>";
        }
        echo "<br><br>";
    }
} else {
    header("location: https://www.swapamc.com/swapproj/campus");
    exit;
}
