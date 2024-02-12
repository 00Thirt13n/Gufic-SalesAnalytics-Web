<?php
$obj = new salesreporting();


class salesreporting {

private $conn;

public function DbConnect() {
    //$this->conn = mysqli_connect("localhost", "root", "gstadmin123", "MELJOHN_UPLOAD_SATISH");
    $this->conn = mysqli_connect("database-1.cp3x1knxpfbf.ap-south-1.rds.amazonaws.com", "admin", "gstadmin123", "MELJOHN_UPLOAD_SATISH");
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
        return true;
    }
}
}
?>