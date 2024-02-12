<?php
//require_once "layouts/config.php";

$ftp_server = "103.205.125.116";
$ftp_user = "globalspace";
$ftp_pass = "Glb#Space@2023";
//$remote_file = "/temp/temp.csv";
//$local_file = "downloaded_file.csv";

try {
    // Establish an FTP connection
    $ftp_conn = ftp_connect($ftp_server);
    if (!$ftp_conn) {
        throw new Exception("Could not connect to $ftp_server");
    }else
    {
        echo("Connected");
    }

    // Log in to FTP server
    //$login_result = ftp_login($ftp_conn, $ftp_user, $ftp_pass);
    //if (!$login_result) {
    //    throw new Exception("Login failed");
    //}
    /*
    // Set passive mode (optional, depends on server configuration)
    ftp_pasv($ftp_conn, true);
    
    
    // Download the file
    if (ftp_get($ftp_conn, $local_file, $remote_file, FTP_ASCII)) {
        
        
        // echo "Successfully downloaded $remote_file as $local_file"; echo '<br>';
        
        if(($handle = fopen('downloaded_file.csv', "r")) !== FALSE) {
            
            $n = 1;
            
            while(($row = fgetcsv($handle)) !== FALSE) {
                
                $sql = 'INSERT IGNORE INTO MELJOHN_UPLOAD_SATISH.ftp_table (name, phone, email, address, city, country) VALUES ("'.$row[0].'","'.$row[1].'","'.$row[2].'","'.$row[3].'","'.$row[4].'","'.$row[5].'")';
                
                if ($link->query($sql) === TRUE) {
                    
                    
                } else {
                    echo "Error: " . $sql . "<br>" . $link->error;
                }
                
                $n++;
            }

            // Closing the file
            fclose($handle);
            
        }
    } 
    else {
        echo "Error downloading $remote_file\n";
    }
    */
    
    // Close the FTP connection
    ftp_close($ftp_conn);
    
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

//echo ('####################################################### The cron job is running the PHP file: /var/www/html/gufic/mediapp/AdminWeb/Minia/Admin/download_file.php #######################################################');
?>
