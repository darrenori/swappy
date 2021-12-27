<?php



function getTypeForStoreProduct($productid, $conn)
{


    try {
        $query = $conn->prepare("SELECT DISTINCT type FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE mydb.product_type.product_id = $productid;");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(storefunctions.inc.php)");
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
            throw new Exception("Statement Execution failed (storefunctions.inc.php)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/allstores?error=badstatement"); //    echo mysqli_error($query);

        exit;
    }



    $alltypes = [];


    //convert to array. 
    //$query->bind_result() works too
    $result = $query->get_result();
    $array = $result->fetch_all(MYSQLI_ASSOC);

    $totalrows = sizeof($array);

    for ($i = 0; $i < $totalrows; $i++) {
        $type = $array[$i]['type'];
        $alltypes[$i] = $type;
        //echo $type;
    }

    return $alltypes;
}

function getVariantsFromStoreTypes($type, $productid, $conn)
{
    try {
        $query = $conn->prepare("SELECT type_choice,additional_costs FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE mydb.type.type = '$type' AND mydb.product_type.product_id =$productid;");
        if ($query === false) {

            //change filename accordingly
            throw new Exception("Statement Preparation failed(storesfunctions.inc)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allstores?error=badstatement");
        exit;
    }
    $choice = [];
    $addcosts = [];

    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (storesfunctions.inc)");
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

    //print_r($array);

    for ($i = 0; $i < $totalrows; $i++) {
        $choice[$i] = $array[$i]['type_choice'];

        $addcosts[$i] = $array[$i]['additional_costs'];
    }




    $info = [$choice, $addcosts];
    return $info;
}

function checkIfStoreIdExists($conn)
{


    if (isset($_GET["id"])) {
        //renders any scripts into html form of special char e.g., & = &amp
        foreach ($_GET as $key => $val) {
            if (gettype($key) == "string" && $key !== "0") {
                $goodkey = htmlentities($key);
                $_GET[$goodkey] = $_GET[$key];
                unset($_GET[$key]);
            }
            //only checks if of string type (integers will not run through htmlspecialchars)
            if (gettype($val) == "string") {
                $goodval = htmlentities($val);
                $_GET[$goodkey] = $goodval;
            }
            if (empty($val)) {
                $_GET[$goodkey] = "0";
            }
        }

        // $getuser = htmlentities($_GET["user"]);
        // $employeeid = $getuser;

        //converts id to integer (if id is not integer, id will return empty);
        $id = (int)$_GET['id'];
        if (empty($id)) {
            header("location: https://www.swapamc.com/swapproj/allproducts?error=invalidid");
            exit;
        }
        try {
            $query = $conn->prepare("SELECT store_id FROM mydb.store WHERE store_id = '$id';");
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(storesfunctions.inc)");
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
                throw new Exception("Statement Execution failed (storesfunctions.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/allstores?error=badstatement"); //    echo mysqli_error($query);

            exit;
        }


        $result = $query->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $totalrows = sizeof($array);

        if ($totalrows == 0) {
            header("location: https://www.swapamc.com/swapproj/allstores");
        }
    }
}
