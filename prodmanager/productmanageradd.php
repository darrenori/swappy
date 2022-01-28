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
echo "<div class='triangle'><div class='container5'>";
echo "<div class='item' id='example2'>";
echo "<div class='static'>Add New Product</div>";

echo "<form class='form5' method=POST enctype='multipart/form-data' action='https://www.swapamc.com/swapproj/productmanageraddinc'>";

    echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Product Name:</p></div>";
        echo "<div class='pairing2'><input type='text' name='name' placeholder='Torchlight'></div>";
    echo "</div>";


    echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Product Price:</p></div>";
        echo "<div class='pairing2'><input type='number' step='any' name='price' placeholder='1.99'></div>";
    echo "</div>";

echo "<div class='pairing'>";
    echo "<div class='pairing1'><p>About:</p></div>";
    echo "<div class='pairing2'><textarea required type='text' name='about' placeholder='text' rows='4' cols='50'>";
    echo "</textarea></div>";
echo "</div>";

echo "<div class='pairing'>";
    echo "<div class='pairing1'><p>Store id:</p></div>";
    echo "<div class='pairing2'><input style='height:100px' type='text' name='storeid' placeholder=''></div>";
echo "</div>";

echo "<div class='pairing'>";
    echo "<div class='pairing1'><p>Image one:</p></div>";
    echo "<div class='pairing2'><input type='file' name='imageone'></div>";
echo "</div>";

echo "<div class='pairing'>";
    echo "<div class='pairing1'><p>Image two:</p></div>";
    echo "<div class='pairing2'><input type='file' name='imagetwo'></div>";
echo "</div>";

echo "<div class='pairing55'>";
    echo "<div class='pairing1'><p>Image three:</p></div>";
    echo "<div class='pairing2'><input type='file' name='imagethree'></div>";
echo "</div>";
echo "<input type='submit'>";


echo "</form></div></div></div>";



?>

<html>

    <style>
        textarea {
            resize:none;
        }
        <?php include 'storemanager/addstore.css'; ?>
    </style>
</html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

