<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

session_start();

if(isset($_SESSION['addproduct'])&&$_SESSION['addproduct']!=null){
    if($_SESSION['addproduct']=='A'){
        //type
        header("location: https://www.swapamc.com/swapproj/productmanagertypes");


    } else if ($_SESSION['addproduct']=='B'){
        //variants
        header("location: https://www.swapamc.com/swapproj/productmanagervariants");


    }
}

echo "<form method=POST enctype='multipart/form-data' action='https://www.swapamc.com/swapproj/productmanageraddinc'>";

echo "<p>Product Name:</p>";
echo "<input type='text' name='name' placeholder='Torchlight'>";

echo "<p>Product Price:</p>";
echo "<input type='number' step='any' name='price' placeholder='1.99'>";



echo "<p>About:</p>";
echo "<textarea required type='text' name='about' placeholder='text' rows='4' cols='50'>";

echo "</textarea>";


echo "<p>Store id:</p>";
echo "<input type='text' name='storeid' placeholder='Cisco'>";

echo "<p>Image one:</p>";
echo "<input type='file' name='imageone'>";


echo "<p>Image two:</p>";
echo "<input type='file' name='imagetwo'>";

echo "<p>Image three:</p>";
echo "<input type='file' name='imagethree'>";
echo "<br><br>";
echo "<input type='submit'>";


echo "</form>";


?>

<html>

    <style>
        textarea {
            resize:none;
        }
    </style>
</html>
