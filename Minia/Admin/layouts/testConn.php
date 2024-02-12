<?php
// $conn = mysqli_connect("database-1.cp3x1knxpfbf.ap-south-1.rds.amazonaws.com", "admin", "gstadmin123", "MELJOHN_UPLOAD_SATISH");
$conn = mysqli_connect("13.235.43.173", "root", "Globalspace@100$", "MELJOHN_UPLOAD_SATISH");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL";
    die ("Failed to connect to MySQL: " . mysqli_connect_error());
}
else{
    echo "Connected";
}
?>