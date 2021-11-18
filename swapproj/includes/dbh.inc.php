<?php
$servername = "localhost";
$dbusername = "root";
$password = "";
$database = "mydb";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $password, $database,3307);

// Check connection
if (!$conn) {
  echo "Connection failed: " . mysqli_connect_error();
} else {
  //echo "Connected successfully";
}



// $sql="SELECT user_id, user_fname, user_lname FROM mydb.users";
// $result =mysqli_query($conn, $sql);



?>


