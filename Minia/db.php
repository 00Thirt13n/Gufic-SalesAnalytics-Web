<?php
$servername = "database-1.cp3x1knxpfbf.ap-south-1.rds.amazonaws.com";
$username = "admin";
$password = "gstadmin123";
$dbname = "MELJOHN_UPLOAD_SATISH";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    echo "DB LINK ERROR <br>";
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>
