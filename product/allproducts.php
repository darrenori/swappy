<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
=

    

    // $jwtarray = jwtdecrypt();
    // if(isset($jwtarray)&&$jwtarray==true){
        
    //     $jwtarrayinformation = $jwtarray['array'];
    
    // } else {
        
    //     header("location: https://www.swapamc.com/swapproj/logout");
    //     exit();
    // }
        

    

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';



    

    $query=$conn->prepare("SELECT product_id,product_name FROM mydb.products;");

    if($query->execute()){
        $query->bind_result($id,$name);



        while($query->fetch()){
            echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$id'>$name  </a>";
            echo "<br>";
            

            
        }
    }

    




?>

<html>
        <h1>ALL PRODUCTS</h1>
    </html>