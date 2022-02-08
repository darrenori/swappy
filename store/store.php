<?php

//db con
###ZEPH
// Checked for bad keys, checked for bad values, params bound,


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/store/storefunctions.inc.php';

$_GET = XSSPrevention($_GET, ['id']);
$_GET = escapeString($conn, $_GET);
checkIfStoreIdExists($conn); //checks if store id exists, if it doesn't exist, code will exit

//if checkIfIdExists has run, the id variable would have been considered safe
$id = (string)$_GET["id"];
try {
    $query = $conn->prepare("SELECT * FROM mydb.storeprod INNER JOIN mydb.store 
    ON mydb.store.store_id = mydb.storeprod.store_id 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.storeprod.product_id 
    WHERE mydb.store.store_id = ?;");
    $query->bind_param('s', $id);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(store)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":1:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/allstores?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (store)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":1:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/allstores?error=badstatement"); //    echo mysqli_error($query);

    exit;
}




//convert to array. 
//$query->bind_result() works too
$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);

$totalrows = sizeof($array);

//creat table


echo "<table  border='1'><tr>";
echo "<th>Name</th>";
echo "<th>From</th>";

for ($i = 0; $i < $totalrows; $i++) {
    $product_name = $array[$i]['product_name'];
    $product_price = $array[$i]['product_price'];
    $product_type = $array[$i]['product_price'];
    $productid = $array[$i]['product_id'];

    echo "<tr>";
    echo "<td><a href='https://www.swapamc.com/swapproj/allproducts/product?id=$productid'>$product_name</a></td>";
    echo "<td><a>$product_price</a></td>";

    echo "<tr>";
}
echo "</table>";

//types
$alltypes = getTypeForStoreProduct($id, $conn);

// print_r($alltypes);
echo "<br>";




//vairants

$numberofTypes = sizeof($alltypes);
for ($i = 0; $i < $numberofTypes; $i++) {
    $info[$i] = getVariantsFromStoreTypes($alltypes[$i], $id, $conn);
};


// for($i=-;$i<sizeof($info);$i++){

// }
$newchoicesarray = $info[0];
if (sizeof($info) > 1) {
    $newcostsarray = $info[1];
}


##ZEPH
//purpose of print statement unrecognized.
// print_r($newchoicesarray);
// echo "<br>";
// if (isset($newcostsarray)) {
//     print_r($newcostsarray);
// }
