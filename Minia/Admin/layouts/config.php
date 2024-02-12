<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//define('DB_SERVER', 'database-1.cp3x1knxpfbf.ap-south-1.rds.amazonaws.com');
// ("13.235.43.173", "root", "Globalspace@100$", "MELJOHN_UPLOAD_SATISH")
// define('DB_SERVER', 'database-1.cp3x1knxpfbf.ap-south-1.rds.amazonaws.com');
// define('DB_USERNAME', 'admin');
// define('DB_PASSWORD', 'gstadmin123');
// define('DB_NAME', 'MELJOHN_UPLOAD_SATISH');
define('DB_SERVER', '13.235.43.173');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Globalspace@100$');
define('DB_NAME', 'MELJOHN_UPLOAD_SATISH');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    // echo "DB LINK ERROR <br>";
    // die("ERROR: Could not connect. " . mysqli_connect_error());
    header("location: pages-maintenance.php");
}
else{
    // echo "DB Connected Successfully <br>";
    // $sql = "select * from GSTMED_ACCOUNT limit 1";
    // $result = mysqli_query($link, $sql);
    // echo gettype($result);
    // // print_r($result);
    // while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    //     // $records[] = $row;
    //     print_r(json_encode($row));
    // }

}
    

$gmailid = 'example@email.com'; // YOUR gmail email
$gmailpassword = 'Example@123'; // YOUR gmail password
$gmailusername = ''; // YOUR gmail User name

?>
