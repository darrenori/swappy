<?php
$servername = "localhost";
$dbusername = "root";
$password = "";
$database = "mydb";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $password, $database,3306);

// Check connection
if (!$conn) {
  echo "Connection failed: " . mysqli_connect_error();
} else {
  echo "Connected successfully";
}
?>





