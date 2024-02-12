<?php
// FTP server configuration
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// Connect to FTP server
$ftp_connection = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");

// Login to FTP server
$login = ftp_login($ftp_connection, $ftp_username, $ftp_password);
echo ("HIIIII");
/*
// Check connection
if ($ftp_connection && $login) {
    // Directory to list files from
    $directory = "103.205.125.116/csv/files/";

    // Get file list
    $file_list = ftp_nlist($ftp_connection, $directory);

    // Output the file list
    echo "Files in $directory:<br>";
    foreach ($file_list as $file) {
        echo $file . "<br>";
    }

    // Close FTP connection
    ftp_close($ftp_connection);
} else {
    echo "Could not connect to FTP server";
}
*/
?>
