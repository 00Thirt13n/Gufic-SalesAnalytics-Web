<?php
echo("==================================================================================================================================================<br>");
// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// MySQL Database Credentials
$servername = "13.235.43.173";
$username = "root";
$password = "Globalspace@100$";
$dbname = "MELJOHN_UPLOAD_SATISH";

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
}
else{
    echo("GUFIC FTP : conection established <br> $ftp_conn <br> $ftp_server <br>"); 
}

// Create MySQL connection
$mysqli = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database);

// Check MySQL connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
else{
    echo "DB Connected Successfully <br>";
}

// Get the list of files/directories in the current directory
$contents = ftp_nlist($ftp_conn, '.');

// Output the list
if ($contents) {
    echo "Directory listing:\n";
    foreach ($contents as $file) {
        echo "$file\n";
    }
} else {
    echo "Failed to get directory listing\n";
}


// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");

?>
