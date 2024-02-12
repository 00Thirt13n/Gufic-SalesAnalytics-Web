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
    echo("GUFIC FTP : conection established <br>"); 
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





/*
$directory = "/csv/files/";


foreach (ftp_nlist($ftp_conn,$directory) as $csvFile) {
    // Extract table name from CSV file name
    //$tableName = pathinfo($csvFile, PATHINFO_FILENAME);
    echo "Files in $directory:<br>";
    // foreach ($file_list as $file) {
    //     echo $file . " hello <br>";
    // }
    // //echo($tableName); 
    // echo($csvFile); 
    /*
    // Check if table already exists
    $checkTableQuery = "SHOW TABLES LIKE ?";
    $stmt = $mysqli->prepare($checkTableQuery);
    $stmt->bind_param("s", $tableName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        // Table does not exist, create it
        $localFile = tempnam(sys_get_temp_dir(), 'csv_');
        if (ftp_get($ftp_conn, $localFile, $csvFile, FTP_ASCII)) {
            // Read first 5 rows of CSV to determine data types
            $sampleRows = [];
            if (($handle = fopen($localFile, "r")) !== FALSE) {
                for ($i = 0; $i < 5; $i++) {
                    $sampleRow = fgetcsv($handle, 0, ",");
                    if ($sampleRow) {
                        $sampleRows[] = $sampleRow;
                    }
                }
                fclose($handle);
            }

            // Generate CREATE TABLE query based on sample rows
            $createTableQuery = "CREATE TABLE $tableName (";

            // Determine column data types
            if (!empty($sampleRows)) {
                foreach ($sampleRows[0] as $columnIndex => $cellValue) {
                    $columnDataType = 'VARCHAR(300)'; // Default data type
                    foreach ($sampleRows as $sampleRow) {
                        if (!empty($sampleRow[$columnIndex])) {
                            $columnDataType = 'VARCHAR(300)';
                            break;
                        }
                    }
                    $createTableQuery .= "`$cellValue` $columnDataType, ";
                }
                $createTableQuery = rtrim($createTableQuery, ", ") . ")";
            } else {
                // No sample rows found, create an empty table with a single VARCHAR column
                $createTableQuery .= "`placeholder_column` VARCHAR(300))";
            }
            error_log("---------------Create Table Query---------------");
            error_log($createTableQuery);
            error_log("---------------Create Table Query End---------------");

            // Execute CREATE TABLE query
            if ($mysqli->query($createTableQuery)) {
                echo "Table $tableName created successfully.\n";
            } else {
                echo "Error creating table: " . $mysqli->error . "\n";
            }

            // Clean up temp file
            unlink($localFile);
        } else {
            echo "Error downloading CSV file: $csvFile\n";
        }
    } else {
        echo "Table $tableName already exists.\n";
    }
    * /   
    //$stmt->close();
}
*/
// Close MySQL connection
//$mysqli->close();

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");

?>
