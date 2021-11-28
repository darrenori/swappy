<?php

    //db con
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/store/stores.function.php';
    

    checkIfIdExists($conn);
    

    $id=$_GET["id"];
    $query=$conn->prepare("SELECT * FROM mydb.storeprod INNER JOIN mydb.store 
    ON mydb.store.store_id = mydb.storeprod.store_id 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.storeprod.product_id 
    WHERE mydb.store.store_id = '$id';");
            
    if($query->execute()){
        
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

        for($i=0;$i<$totalrows;$i++){
            $product_name= $array[$i]['product_name'];
            $product_price= $array[$i]['product_price'];
            $product_type= $array[$i]['product_price'];

            echo "<tr>";
            echo "<td><p>$product_name</p></td>";
            echo "<td><p>$product_price</p></td>";
            echo "<td><p>$product_price</p></td>";
            
            echo "<tr>";


        }
        echo "</table>";
        
    } else {
        echo "faile";
    }


    //types
    $id=$_GET["id"];
    $alltypes = getTypeForProduct($id,$conn);

    print_r($alltypes);
    echo "<br>";



    
    //vairants

    $numberofTypes= sizeof($alltypes);
    for ($i=0;$i<$numberofTypes;$i++){
        $info[$i] = getVariantsFromTypes($alltypes[$i],$id,$conn);
        
    };


    // for($i=-;$i<sizeof($info);$i++){
        
    // }
    $newchoicesarray=$info[0];
    $newcostsarray=$info[1];

    print_r($newchoicesarray);
    echo "<br>";
    print_r($newcostsarray);

    
?>