<?php

if (!isset($_POST['searchitem'])) {
    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    exit;
}




//Import all required files
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

### CSRF ####
if (validateCSRF() == false) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


    if ($actual_link == "http://www.swapamc.com/swapproj/campus?error=badcsrf") {
        echo 'bad csrf';
        //dont redirect if on the same page

    } else {
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
}
### CSRF ####

$whitelist = ['searchitem'];
$_POST = XSSPrevention($_POST, $whitelist);
$_POST = escapeString($conn, $_POST);

//buffer not applicable
$emptyflag = empty(checkEmpty($_POST, ['id']));


$searchitem = $_POST['searchitem'];

//get all product names line 11-71
try {
    $query = $conn->prepare("SELECT product_id,product_name FROM mydb.products;");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(allproducts)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
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
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
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
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
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
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
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
            if ($matchessearch) {
                $filteredstoreslist[$key] = $value;
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
        $specialproductlist = [];

        ### SUGGEST RESULTS   ####
        if (strpos($searchitem, "r") !== false) {
            $specialkey = "Router";
        } else if (strpos($searchitem, "c") !== false) {
            $specialkey = "Cisco";
        } else $specialkey = "Router";
        echo "Showing <b>Product</b> results for <i>" . $specialkey . "</i> instead.<br>";
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
            echo "<a href='https://www.swapamc.com/swapproj/allstores/store?id=$key'>$value</a>";
            echo "<br>";
        }
        echo "<br><br>";
    }
} else {
    header("location: https://www.swapamc.com/swapproj/campus");
    exit;
}
