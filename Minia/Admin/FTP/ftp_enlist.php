<?php
/*
echo("==================================================================================================================================================<br>");
// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// MySQL Database Credentials
$mysql_host = "13.235.43.173";
$mysql_username = "root";
$mysql_password = "Globalspace@100$";
$mysql_database = "MELJOHN_UPLOAD_SATISH";

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Create MySQL connection
$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

// Check MySQL connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    echo "DB Connected Successfully <br>";
}

// Get the list of files/directories in the current directory
$contents = ftp_nlist($ftp_conn, '.');

// Output the list
if ($contents) {
    echo "Directory listing:<br>";
    foreach ($contents as $file) {
        echo "$file<br>";
    }
} else {
    echo "Failed to get directory listing<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
/*echo("==================================================================================================================================================<br>");
// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// MySQL Database Credentials
$mysql_host = "13.235.43.173";
$mysql_username = "root";
$mysql_password = "Globalspace@100$";
$mysql_database = "MELJOHN_UPLOAD_SATISH";

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Create MySQL connection
$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

// Check MySQL connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    echo "DB Connected Successfully <br>";
}

// Set FTP server directory (optional, if you want to list a specific directory)
ftp_chdir($ftp_conn, '/path/to/your/ftp/directory');

// Get the list of files/directories in the current directory
$contents = ftp_nlist($ftp_conn, '.');

// Output the list
if ($contents) {
    echo "Directory listing:<br>";
    foreach ($contents as $file) {
        echo "$file<br>";
    }
} else {
    echo "Failed to get directory listing: " . ftp_error($ftp_conn);
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>

<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Get detailed directory listing using ftp_rawlist
$files = ftp_rawlist($ftp_conn, '.');

// Output the list
if ($files) {
    echo "Directory listing:<br>";
    foreach ($files as $file) {
        echo "$file<br>";
    }
} else {
    echo "Failed to get directory listing<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Get detailed directory listing using ftp_rawlist
$files = ftp_rawlist($ftp_conn, '.');

// Parse file and folder names from raw list
$fileNames = [];
foreach ($files as $file) {
    // Parse each line to extract file/folder names
    $parts = preg_split("/\s+/", $file);
    $name = end($parts);
    
    // Ignore parent and current directory entries
    if ($name !== '.' && $name !== '..') {
        $fileNames[] = $name;
    }
}

// Output the file and folder names
if ($fileNames) {
    echo "File and folder names:<br>";
    foreach ($fileNames as $name) {
        echo "$name<br>";
    }
} else {
    echo "No files or folders found<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Get detailed directory listing using ftp_rawlist
$files = ftp_rawlist($ftp_conn, '.');

// Parse file names and filter CSV files
$csvFiles = [];
foreach ($files as $file) {
    // Parse each line to extract file/folder names
    $parts = preg_split("/\s+/", $file);
    $name = end($parts);
    
    // Ignore parent and current directory entries
    if ($name !== '.' && $name !== '..') {
        // Check if the file has .csv extension
        if (pathinfo($name, PATHINFO_EXTENSION) === 'csv') {
            $csvFiles[] = $name;
        }
    }
}

// Output the CSV file names
if ($csvFiles) {
    echo "CSV Files:<br>";
    foreach ($csvFiles as $csvFile) {
        echo "$csvFile<br>";
    }
} else {
    echo "No CSV files found<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Change directory to "csv"
$ftp_directory = 'csv';
if (ftp_chdir($ftp_conn, $ftp_directory)) {
    echo "Changed directory to $ftp_directory <br>";
    
    // Get the list of files/folders in the current directory
    $contents = ftp_nlist($ftp_conn, '.');

    // Output the list
    if ($contents) {
        echo "File and folder names in '$ftp_directory':<br>";
        foreach ($contents as $file) {
            echo "$file<br>";
        }
    } else {
        echo "No files or folders found in '$ftp_directory'<br>";
    }
} else {
    echo "Failed to change directory to '$ftp_directory'<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Change directory to "csv"
$ftp_directory = 'csv';
if (ftp_chdir($ftp_conn, $ftp_directory)) {
    echo "Changed directory to $ftp_directory <br>";
    
    // Get the list of files/folders in the current directory
    $contents = ftp_nlist($ftp_conn, '.');

    // Output the list
    if ($contents) {
        echo "File names without extensions in '$ftp_directory':<br>";
        foreach ($contents as $file) {
            // Extract filename without extension
            $filenameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);
            echo "$filenameWithoutExtension<br>";
        }
    } else {
        echo "No files or folders found in '$ftp_directory'<br>";
    }
} else {
    echo "Failed to change directory to '$ftp_directory'<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';
$ftp_directory = 'csv'; // Specify the directory containing CSV files

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Change directory to specified directory
if (ftp_chdir($ftp_conn, $ftp_directory)) {
    echo "Changed directory to $ftp_directory <br>";
    
    // Get the list of CSV files in the directory
    $csvFiles = ftp_nlist($ftp_conn, '*.csv');

    // Read and define data types for each CSV file
    foreach ($csvFiles as $csvFile) {
        $handle = fopen("ftp://$ftp_username:$ftp_password@$ftp_server/$ftp_directory/$csvFile", "r");
        if ($handle) {
            echo "Columns and data types for '$csvFile':<br>";

            // Read the first row to get column names
            $headerRow = fgetcsv($handle);
            if ($headerRow) {
                // Define data types for each column
                foreach ($headerRow as $columnName) {
                    // Infer data type based on sample values (you may need more complex logic for accurate data type inference)
                    $dataType = 'VARCHAR'; // Default data type is VARCHAR
                    if (is_numeric($columnName)) {
                        $dataType = 'INT'; // If the column name is numeric, assume INT data type
                    } elseif (filter_var($columnName, FILTER_VALIDATE_FLOAT)) {
                        $dataType = 'FLOAT'; // If the column name is float, assume FLOAT data type
                    }

                    echo "Column: $columnName - Data Type: $dataType <br>";
                }
            } else {
                echo "Empty CSV file: $csvFile<br>";
            }

            fclose($handle);
        } else {
            echo "Failed to open CSV file: $csvFile<br>";
        }
    }
} else {
    echo "Failed to change directory to '$ftp_directory'<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';
$ftp_directory = 'csv'; // Specify the directory containing CSV files

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Change directory to specified directory
if (ftp_chdir($ftp_conn, $ftp_directory)) {
    echo "Changed directory to $ftp_directory <br>";
    
    // Get the list of CSV files in the directory
    $csvFiles = ftp_nlist($ftp_conn, '*.csv');

    // Read and define data types for each CSV file
    foreach ($csvFiles as $csvFile) {
        $handle = fopen("ftp://$ftp_username:$ftp_password@$ftp_server/$ftp_directory/$csvFile", "r");
        if ($handle) {
            echo "Columns and data types for '$csvFile':<br>";

            // Read the first row to get column names
            $headerRow = fgetcsv($handle);
            $columnDataTypes = [];

            if ($headerRow) {
                // Initialize data type guesses based on the first row
                foreach ($headerRow as $columnName) {
                    $columnDataTypes[$columnName] = 'VARCHAR'; // Default data type is VARCHAR
                }

                // Read a sample of rows and infer data types for each column
                $sampleSize = 10; // Adjust the sample size as needed
                for ($i = 0; $i < $sampleSize; $i++) {
                    $rowData = fgetcsv($handle);
                    if ($rowData) {
                        foreach ($rowData as $index => $value) {
                            // Attempt to infer data type based on the sample values
                            if (is_numeric($value)) {
                                if (strpos($value, '.') !== false) {
                                    $columnDataTypes[$headerRow[$index]] = 'FLOAT';
                                } else {
                                    $columnDataTypes[$headerRow[$index]] = 'INT';
                                }
                            }
                        }
                    }
                }

                // Output column names and inferred data types
                foreach ($columnDataTypes as $columnName => $dataType) {
                    echo "Column: $columnName - Data Type: $dataType <br>";
                }
            } else {
                echo "Empty CSV file: $csvFile<br>";
            }

            fclose($handle);
        } else {
            echo "Failed to open CSV file: $csvFile<br>";
        }
    }
} else {
    echo "Failed to change directory to '$ftp_directory'<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");

*/
?>
<?php
/*
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';
$ftp_directory = 'csv'; // Specify the directory containing CSV files on the FTP server

// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Change directory to specified directory
if (ftp_chdir($ftp_conn, $ftp_directory)) {
    echo "Changed directory to $ftp_directory <br>";

    // Get the list of CSV files in the directory
    $csvFiles = ftp_nlist($ftp_conn, '*.csv');

    // Download CSV files and read columns with data types
    foreach ($csvFiles as $csvFile) {
        // Download CSV file from FTP to current directory
        if (ftp_get($ftp_conn, $csvFile, $csvFile, FTP_BINARY)) {
            echo "Downloaded: $csvFile <br>";

            // Read CSV file and infer data types
            if (($handle = fopen($csvFile, "r")) !== FALSE) {
                echo "Columns and data types for '$csvFile':<br>";

                // Read the first row to get column names
                $headerRow = fgetcsv($handle);
                if ($headerRow) {
                    // Infer data types for each column
                    foreach ($headerRow as $columnName) {
                        $columnDataTypes[$columnName] = 'VARCHAR'; // Default data type is VARCHAR
                    }

                    // Read a sample of rows and infer data types for each column
                    $sampleSize = 10; // Adjust the sample size as needed
                    for ($i = 0; $i < $sampleSize; $i++) {
                        $rowData = fgetcsv($handle);
                        if ($rowData) {
                            foreach ($rowData as $index => $value) {
                                // Attempt to infer data type based on the sample values
                                if (is_numeric($value)) {
                                    if (strpos($value, '.') !== false) {
                                        $columnDataTypes[$headerRow[$index]] = 'FLOAT';
                                    } else {
                                        $columnDataTypes[$headerRow[$index]] = 'INT';
                                    }
                                }
                            }
                        }
                    }

                    // Output column names and inferred data types
                    foreach ($columnDataTypes as $columnName => $dataType) {
                        echo "Column: $columnName - Data Type: $dataType <br>";
                    }
                } else {
                    echo "Empty CSV file: $csvFile<br>";
                }

                fclose($handle);
            } else {
                echo "Failed to open CSV file: $csvFile<br>";
            }
        } else {
            echo "Failed to download: $csvFile<br>";
        }
    }
} else {
    echo "Failed to change directory to '$ftp_directory'<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
*/
?>
<?php
echo("==================================================================================================================================================<br>");

// FTP Server Credentials
$ftp_server = '103.205.125.116';
$ftp_username = 'globalspace';
$ftp_password = 'Glb#Space@2023';
$ftp_directory = 'csv'; // Specify the directory containing CSV files on the FTP server

// Local Directory to Save CSV Files
$localDirectory = './'; // Current directory where this PHP script is located
echo   $localDirectory;
// Connect to FTP server
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");
ftp_login($ftp_conn, $ftp_username, $ftp_password);
ftp_pasv($ftp_conn, true); // Enable passive mode

// Check FTP connection
if (!$ftp_conn) {
    die("FTP Connection Failed <br>");
} else {
    echo("GUFIC FTP: connection established <br>");
}

// Change directory to specified directory
if (ftp_chdir($ftp_conn, $ftp_directory)) {
    echo "Changed directory to $ftp_directory <br>";

    // Get the list of CSV files in the directory
    $csvFiles = ftp_nlist($ftp_conn, '*.csv');

    // Download CSV files and read columns with data types
    foreach ($csvFiles as $csvFile) {
        // Download CSV file from FTP to local directory
        $localFilePath = $localDirectory . $csvFile;
        if (ftp_get($ftp_conn, $localFilePath, $csvFile, FTP_BINARY)) {
            echo "Downloaded: $csvFile <br>";

            // Read CSV file and infer data types
            if (($handle = fopen($localFilePath, "r")) !== FALSE) {
                echo "Columns and data types for '$csvFile':<br>";

                // Read the first row to get column names
                $headerRow = fgetcsv($handle);
                $columnDataTypes = [];

                if ($headerRow) {
                    // Initialize data type guesses based on the first row
                    foreach ($headerRow as $columnName) {
                        $columnDataTypes[$columnName] = 'VARCHAR'; // Default data type is VARCHAR
                    }

                    // Read a sample of rows and infer data types for each column
                    $sampleSize = 10; // Adjust the sample size as needed
                    for ($i = 0; $i < $sampleSize; $i++) {
                        $rowData = fgetcsv($handle);
                        if ($rowData) {
                            foreach ($rowData as $index => $value) {
                                // Attempt to infer data type based on the sample values
                                if (is_numeric($value)) {
                                    if (strpos($value, '.') !== false) {
                                        $columnDataTypes[$headerRow[$index]] = 'FLOAT';
                                    } else {
                                        $columnDataTypes[$headerRow[$index]] = 'INT';
                                    }
                                }
                            }
                        }
                    }

                    // Output column names and inferred data types
                    foreach ($columnDataTypes as $columnName => $dataType) {
                        echo "Column: $columnName - Data Type: $dataType <br>";
                    }
                } else {
                    echo "Empty CSV file: $csvFile<br>";
                }

                fclose($handle);
            } else {
                echo "Failed to open CSV file: $csvFile<br>";
            }
        } else {
            echo "Failed to download: $csvFile<br>";
        }
    }
} else {
    echo "Failed to change directory to '$ftp_directory'<br>";
}

// Close FTP connection
ftp_close($ftp_conn);
echo("==================================================================================================================================================<br>");
?>



