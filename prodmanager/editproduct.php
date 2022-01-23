<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';
$image = new Image();

if(isset($_GET['id'])&&$_GET['id']!=null){
    $prodid=$_GET['id'];

    if(badInputTwo([$prodid])==true){
        header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;
    }
    try {
        $query = $conn->prepare("SELECT product_name,product_about,product_picone,product_pictwo,product_picthree FROM mydb.products WHERE product_id = '$prodid';");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(productedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }


    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Preparation failed(productedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }
} else {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;

}

$query->bind_result($name,$about,$picone,$pictwo,$picthree);

if($query->fetch()){
    echo "<form action='https://www.swapamc.com/swapproj/productmanager/editproductinc?id=$prodid' enctype='multipart/form-data' method='POST'>";

    echo "Name: $name<br><br>";
    echo "About:<br> <textarea rows='4' cols='50' name='about'>$about</textarea><br>";

    
    

    if($picone!=null){
        echo "<p>Pic one:</p>";
        $src = $image->show($picone);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<p>Image one:</p>";
        echo "<input type='file' name='imageone'>";

    } else {
        echo "<p>Image one:</p>";
        echo "<input type='file' name='imageone'>";
    }


    if($pictwo!=null){
        echo "<p>Pic two:</p>";
        $src = $image->show($pictwo);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<p>Image two:</p>";
        echo "<input type='file' name='imagetwo'>";

    } else {
        echo "<p>Image two:</p>";
        echo "<input type='file' name='imagetwo'>";
    }


    if($picthree!=null){
        echo "<p>Pic three:</p>";
        $src = $image->show($picthree);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<p>Image three:</p>";
        echo "<input type='file' name='imagethree'>";

    } else {
        echo "<p>Image three:</p>";
        echo "<input type='file' name='imagethree'>";
    }

    echo "<br><br>";

    echo "<input type='submit'>";

    echo "<br>";


   
    
    
    

    echo "</form>";
    echo "<a href='https://www.swapamc.com/swapproj/productmanager/deleteproductinc?id=$prodid'><button type='button'>Delete</button></a>";

} else {
    //dosent exist
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;
}


?>