<?php

//db con

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/store/storefunctions.inc.php';


checkIfIdExists($conn);


foreach ($_GET as $key => $val) { // converts old value to new value
    //renders any scripts into html form of special char e.g., & = &amp
    if (gettype($key) == "string") {
        $key = htmlspecialchars($key, ENT_QUOTES);}
    //only checks if of string type (integers will not run through htmlspecialchars)
    if (gettype($val) == "string") {
        $val = htmlspecialchars($val, ENT_QUOTES);
    }
}
try {
$query = $conn->prepare("SELECT * FROM mydb.storeprod INNER JOIN mydb.store 
    ON mydb.store.store_id = mydb.storeprod.store_id 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.storeprod.product_id 
    WHERE mydb.store.store_id = '$id';");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(store)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
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
    echo 'Message: ' . $e->getMessage();
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
    echo "<th>OGPrice</th>";
    echo "<th>Type</th>";

    for ($i = 0; $i < $totalrows; $i++) {
        $product_name = $array[$i]['product_name'];
        $product_price = $array[$i]['product_price'];
        $product_type = $array[$i]['product_price'];

        echo "<tr>";
        echo "<td><p>$product_name</p></td>";
        echo "<td><p>$product_price</p></td>";
        echo "<td><p>$product_price</p></td>";

        echo "<tr>";
    }
    echo "</table>";

//types
//if checkIfIdExists has run, the following line of code will be safe
$id = $_GET["id"];
$alltypes = getTypeForProduct($id, $conn);

print_r($alltypes);
echo "<br>";




//vairants

$numberofTypes = sizeof($alltypes);
for ($i = 0; $i < $numberofTypes; $i++) {
    $info[$i] = getVariantsFromTypes($alltypes[$i], $id, $conn);
};


// for($i=-;$i<sizeof($info);$i++){

// }
$newchoicesarray = $info[0];
$newcostsarray = $info[1];

print_r($newchoicesarray);
echo "<br>";
print_r($newcostsarray);
