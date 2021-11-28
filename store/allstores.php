<?php
    

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';



    

    $query=$conn->prepare("SELECT store_id,store_name FROM mydb.store;");

    if($query->execute()){
        $query->bind_result($id,$name);



        while($query->fetch()){
            echo "<a href='https://www.swapamc.com/swapproj/allstores/store?id=$id'>$name</a>";
            echo "<br>";
            

            
        }
    }

    




?>

<html>
        <h1>ALLSTORES</h1>
    </html>