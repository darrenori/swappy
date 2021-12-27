<?php

function addToCart()
{
}



function getTypeForProduct($productid, $conn)
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
            throw new Exception("Statement Preparation failed(productfunctions.inc)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allproducts?product=" . $productid . "&error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (productfunctions.inc)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/allproducts?product=" . $productid . "&error=badstatement"); //    echo mysqli_error($query);

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




function getVariantsFromTypes($type, $productid, $conn)
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
            throw new Exception("Statement Preparation failed(productfunctions.inc)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allproducts?product=" . $productid . "&error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (productfunctions.inc)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/allproducts?product=" . $productid . "&error=badstatement"); //    echo mysqli_error($query);

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

function getVariantsFromTypesUsingName($type, $name, $conn)
{



    if (strpos($type, '_') == true) {
        $type = str_replace('_', ' ', $type);
    }




    try {
            $query = $conn->prepare("SELECT type_choice,additional_costs,product_price FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE mydb.type.type = '$type' AND product_name ='$name';");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(productfunctions.inc)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/allproducts?type=" . $type . "&productname=" . $type . "&error=badstatement");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (productfunctions.inc)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/allproducts?type=" . $type . "&productname=" . $type . "&error=badstatement"); //    echo mysqli_error($query);

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


function checkIfIdExists($conn)
{

    if (isset($_GET["id"])) {

        //converts id to integer (if id is not integer, id will return empty);
        $id = (int)$_GET['id'];
        if (empty($id)) {
            header("location: https://www.swapamc.com/swapproj/allproducts?error=invalidid");
            exit;
        }

        try {
        $query = $conn->prepare("SELECT product_id FROM mydb.products WHERE product_id = '$id';");
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(productfunctions.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/allproducts?productid=" . $id . "&error=badstatement");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (productfunctions.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/allproducts?productid=" . $id . "&error=badstatement"); //    echo mysqli_error($query);
    
            exit;
        }
    
    
            $result = $query->get_result();
            $array = $result->fetch_all(MYSQLI_ASSOC);

            $totalrows = sizeof($array);

            if ($totalrows == 0) {
                header("location: https://www.swapamc.com/swapproj/allproducts?error=invlidid");
                exit;
            }
    }
}

function calculatePrice()
{
    return 0;
}
