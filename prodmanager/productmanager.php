<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


echo "<form method=POST enctype='multipart/form-data' action=''>";

echo "<p>Product Name:</p>";
echo "<input type='text' name='Product name' placeholder='Torchlight'>";

echo "<p>Product Price:</p>";
echo "<textarea required type='text' name='about' placeholder='text' rows='4' cols='50'>";

echo "</textarea>";

echo "<p>Image one:</p>";
echo "<input type='file' name='image'>";


echo "<p>Image two:</p>";
echo "<input type='file' name='image'>";

echo "<p>Image three:</p>";
echo "<input type='file' name='image'>";
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
