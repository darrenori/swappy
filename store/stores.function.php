<?php



function getTypeForProduct($productid, $conn){

    


    $query=$conn->prepare("SELECT DISTINCT type FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE mydb.product_type.product_id = $productid;");

    $alltypes = [];

    if($query->execute()){
        
        //convert to array. 
        //$query->bind_result() works too
        $result = $query->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $totalrows = sizeof($array);

        for($i=0;$i<$totalrows;$i++){
            $type= $array[$i]['type'];
            $alltypes[$i] = $type;
            //echo $type;
        }

        return $alltypes;

        

    }
}

function getVariantsFromTypes($type,$productid,$conn){
    
    $query=$conn->prepare("SELECT type_choice,additional_costs FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE mydb.type.type = '$type' AND mydb.product_type.product_id =$productid;");

    $choice = [];
    $addcosts = [];
  
    

    if($query->execute()){
        
        //convert to array. 
        //$query->bind_result() works too
        $result = $query->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $totalrows = sizeof($array);

        //print_r($array);

        for($i=0;$i<$totalrows;$i++){
            $choice[$i] = $array[$i]['type_choice'];
            
            $addcosts[$i] = $array[$i]['additional_costs'];

        }

        


        $info = [$choice,$addcosts];
        return $info;

        

    }
}

function checkIfIdExists($conn){
        
    

    
    if (isset($_GET["id"])) {
        $id=$_GET["id"];
        $query=$conn->prepare("SELECT store_id FROM mydb.store WHERE store_id = '$id';");
        if($query->execute()){
            $result = $query->get_result();
            $array = $result->fetch_all(MYSQLI_ASSOC);

            $totalrows = sizeof($array);

            if($totalrows==0){
                header("location: ../allstores");
            }
        }else {
            header("location: ../allstores");
        }
    } 
}

?>

