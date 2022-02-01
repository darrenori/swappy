<?php
##ZEPH
// DONE CHECKING no buffer to overflow, only whitelisted variables will ever be used, escaping and encoding done. 
// echo statements removed no session used



function getTypeForStoreProduct($productid, $conn)
{
    //we make it a string so it cannot carry other meanings
    $productid = (string)$productid;
    $inputarray['id']=$productid;
    $maxlengtharray['id'] = 11;
    if (checkLength($inputarray, $maxlengtharray) !== null) {
        header("location: https://www.swapamc.com/swapproj/allstores?error=longinput");
        exit;
    }

    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://


    try {
        $query = $conn->prepare("SELECT DISTINCT type FROM mydb.product_type 
            INNER JOIN mydb.products 
            ON mydb.products.product_id = mydb.product_type.product_id 
            INNER JOIN mydb.type 
            ON mydb.type.type_id = mydb.product_type.type_id 
            WHERE mydb.product_type.product_id = ?;");
        $query->bind_param('s', $productid);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(storefunctions.inc.php)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
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
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
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
    //we make it a string so it cannot carry other meanings
    $productid = (string)$productid;
    $inputarray['id']=$productid;
    $inputarray['type']=$type;
    $maxlengtharray['id'] = 11;
    $maxlengtharray['type'] = 45;
    if (checkLength($inputarray, $maxlengtharray) !== null) {
        header("location: https://www.swapamc.com/swapproj/allstores?error=longinput");
        exit;
    }
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://




    try {
        $query = $conn->prepare("SELECT type_choice,additional_costs FROM mydb.product_type 
            INNER JOIN mydb.products 
            ON mydb.products.product_id = mydb.product_type.product_id 
            INNER JOIN mydb.type 
            ON mydb.type.type_id = mydb.product_type.type_id 
            WHERE mydb.type.type = ? AND mydb.product_type.product_id =?;");
        $query->bind_param('ss', $type, $productid);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(storefunctions.inc.php)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
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
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/allstores?error=badstatement"); //    echo mysqli_error($query);

        exit;
    }
    $choice = [];
    $addcosts = [];




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
    //we make it a string so it cannot carry other meanings
    $storeid = (string)$_GET['id'];
    $inputarray['id']=$storeid;
    $maxlengtharray['id'] = 11;
    if (checkLength($inputarray, $maxlengtharray) !== null) {
        header("location: https://www.swapamc.com/swapproj/allstores?error=longinput");
        exit;
    }
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://


        // $getuser = htmlentities($_GET["user"]);
        // $employeeid = $getuser;

        //converts id to integer (if id is not integer, id will return empty);
        $id = (int)$_GET['id'];
        if (empty($id)) {
            header("location: https://www.swapamc.com/swapproj/allproducts?error=invalidid");
            exit;
        }$id = (string)$id; 
        try {
            $query = $conn->prepare("SELECT store_id FROM mydb.store WHERE store_id = ?;");
            $query->bind_param('s',$id);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(storesfunctions.inc)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
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
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
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
