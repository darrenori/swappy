<?php
    

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';



    

    $query=$conn->prepare("SELECT product_id,product_name FROM mydb.products;");

    if($query->execute()){
        $query->bind_result($id,$name);



        while($query->fetch()){
            echo "<a href='https://www.swapamc.com/swapproj/allproducts/product?id=$id'>$name  </a>";
            echo "<br>";
        }
    }else {
        header("location: ../swapproj/allproducts?error=stmtfailed");
        exit();
    }


    




?>

<html>
        <h1>ALLSTORES</h1>
    </html>