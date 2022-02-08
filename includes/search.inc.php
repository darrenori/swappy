<html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</html>


<?php
ob_start();
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/navbar.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';

// $newcsrf=generateCSRF();
        

?>


<header>
        <div class=navbar5>
        <ul class=nav_links>
            <form class='nav_form' action="/swapproj/allproducts" method="get">
                <button class='nav_btn' type="submit" value="'  <?php echo $specialkey?>  '" name="cat" >ALL PRODUCTS</button>
                <button class='nav_btn' type="submit" value="'  <?php echo $specialkey?>  '" name="catrouter" >ROUTERS</button>
                <button class='nav_btn' type="submit" value="'  <?php echo $specialkey?>  '" name="cataccessory" >ACCESSORIES</button>
                <button class='nav_btn' type="submit" value="'  <?php echo $specialkey?>  '" name="catswitch" >SWITCHES</button>
                <button class='nav_btn' type="submit" value="'  <?php echo $specialkey?>  '" name="catutility" >UTILITY</button>
                <button class='nav_btn' type="submit" value="'  <?php echo $specialkey?>  '" name="catothers" >OTHERS</button>
            </form>
        </ul> 
        <form action="/swapproj/search" method="post">
            <input class='search' type="text" name ="searchitem" placeholder="Router...">
            <input class='fa fa-search' type="submit" value="Submit">
            <!-- <input class="hidden" value="<?php echo $newcsrf?>"> -->
        </form>
        </div>  
</header>

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
// if (validateCSRF() == false) {
//     $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


//     if ($actual_link == "http://www.swapamc.com/swapproj/campus?error=badcsrf") {
//         echo 'bad csrf';
//         //dont redirect if on the same page

//     } else {
//         header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
//         exit;
//     }
// }
### CSRF ####

$whitelist = ['searchitem'];
$_POST = XSSPrevention($_POST, $whitelist);
$_POST = escapeString($conn, $_POST);

//buffer not applicable
$emptyflag = empty(checkEmpty($_POST, ['id']));


$searchitem = $_POST['searchitem'];

//get all product names line 11-71
try {
    $query = $conn->prepare("SELECT product_id,product_name,product_picone,product_price FROM mydb.products;");
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

$query->bind_result($id, $name,$picone,$price);
while ($query->fetch()) {
    $allproductslist[$id] = $name;
    $allimageslist[$id] = $picone;
    $allothers[$id] = [$price];
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
        // echo "No search results for <i>" . $searchitem . "</i><br>";
        $specialproductlist = [];

        ### SUGGEST RESULTS   ####
        if (strpos($searchitem, "r") !== false) {
            $specialkey = "Router";
        } else if (strpos($searchitem, "c") !== false) {
            $specialkey = "Cisco";
        } else $specialkey = "Router";
        // echo "Showing <b>Product</b> results for <i>" . $specialkey . "</i> instead.<br>";
        if (isset($allproductslist)) {
            echo "<div class='category55'>No results for ".$searchitem.". Showing&nbsp;<b>Product</b>&nbspresults for&nbsp;<i>" . $specialkey . " instead</i></div>";
            echo "<div class='container5'>";


            foreach ($allproductslist as $key => $value) {
                $matchessearch = str_contains(strtolower($value), strtolower($specialkey));
                if ($matchessearch) {
                    $specialproductlist[$key] = $value;
                }
            }
            foreach ($specialproductlist as $key => $value) {
                $ppic = $allimageslist[$key];
                require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
                $image = new Image();

                $src = $image->show($ppic);
                echo "<style>";
                echo "#test$key{";
                    echo "background:linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)), url('$src');";
                    // echo 'flex-basis: 100%;' ;
                    // echo 'height: 85vh;';
                    echo 'background-position: center;';
                    echo 'background-size: cover;';
                    echo 'background-image: black;';
                    echo 'background-repeat: no-repeat;';
                echo "}";
                echo "</style>";



                echo "<div class='item'>";
                echo "<div id='test$key' class='itemimage'></div>";
                echo "<div class='itemname'>";
                echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$key'>$value  </a>";
                echo "</div></div><br>";
            }
            echo "</div><br><br>";
        }
    }



    //print out product results
    if (!empty($filteredproductslist)) {
        echo "<div class='category55'>Showing &nbsp;<b>Product</b>&nbsp; results for &nbsp;<i>" . $searchitem . "</i></div>";
        echo "<div class='container5'>";
        foreach ($filteredproductslist as $key => $value) {

            $ppic = $allimageslist[$key];
                require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
                $image = new Image();

                $src = $image->show($ppic);
                echo "<style>";
                echo "#test$key{";
                    echo "background:linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)), url('$src');";
                    // echo 'flex-basis: 100%;' ;
                    // echo 'height: 85vh;';
                    echo 'background-position: center;';
                    echo 'background-size: cover;';
                    echo 'background-image: black;';
                    echo 'background-repeat: no-repeat;';
                echo "}";
                echo "</style>";


            echo "<div class='item'>";
            echo "<div id='test$key' class='itemimage'></div>";
            echo "<div  class='itemname'>";
            echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$key'>$value  </a>";
            
            echo "</div></div><br>";
        }
        echo "</div><br><br>";
    }


    //print out store results
    if (!empty($filteredstoreslist)) {
        echo "<div class='category55'>Showing &nbsp;<b>Store</b>&nbsp; results for &nbsp;<i>" . $searchitem . "</i></div>";
        echo "<div class='container5'>";
        foreach ($filteredstoreslist as $key => $value) {
            // echo "<div class='itemname'>";
            // echo "<a href='https://www.swapamc.com/swapproj/allstores/store?id=$key'>$value</a>";
            // echo "<br>";

            echo "<div class='item'>";
            echo "<div class='itemimage'></div>";
            echo "<div class='itemname'>";
            echo "<a href='https://www.swapamc.com/swapproj/allstores/store?id=$key'>$value  </a>";
            echo "</div></div><br>";
        }
        echo "</div><br><br>";
    }



} else {
    header("location: https://www.swapamc.com/swapproj/campus");
    exit;
}

?>

<style>
<?php include 'product/css/allproduct.css'; 


?>
body { background: black !important; }
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">