<?php
$servername = "localhost";
$dbusername = "root";
$password = "uwu";
$database = "mydb";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $password, $database,3307);

// Check connection
if (!$conn) {
  echo "Connection failed: " . mysqli_connect_error();
} 





