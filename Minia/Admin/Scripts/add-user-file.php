<?php

require_once "../layouts/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_FILES['fileToUpload']['size'] <= 10000000){  //10MB MAX

        if ($_FILES['fileToUpload']['type'] == 'text/csv' || 
            $_FILES['fileToUpload']['type'] == 'application/vnd.ms-excel' || // only CSV and XLSX
            $_FILES['fileToUpload']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') { 


                $target_file = $_FILES["fileToUpload"]["tmp_name"]; // Get the temporary file path

                $file_content = file_get_contents($target_file);

                // Assuming $file_content is a CSV, convert it into an array
                $rows = array_map('str_getcsv', explode("\n", $file_content));

                // Assuming the first row contains column names
                $columns = array_shift($rows);

                // Prepare the SQL query
                // $sql = "INSERT INTO GUFIC_EMPLOYEE_UPLOAD (`DIVISION`, `EMP CODE`, `DATE OF JOINING`, `EMPLOYEE FIRST NAME`, `DESIGNATION`, 
                //                                                 `GRADE`, `HQ. NAME`, `STATE`, `ZONE`, `REPORTING MANAGER NAME`, `REPORTING TO EMP CODE`, `MOBILE NUMBER`, 
                //                                                 `PERSONAL EMAIL ID`, `OFFICIAL EMAIL ID`, `CFA NAME`, `CFA Location`) VALUES ";

                // Prepare the SQL query
                $sql = "INSERT INTO GUFIC_EMPLOYEE_UPLOAD (`" . implode("`, `", $columns) . "`) VALUES ";

                // Iterate through the rows and add them to the SQL query
                foreach ($rows as $row) {
                    // Check if the row is not empty
                    if (!empty($row) && count($row) == count($columns)) {
                        $sql .= "('" . implode("','", $row) . "'),";
                    }
                }
                
                $sql = rtrim($sql, ","); // Remove the trailing comma

                // echo $sql;
                // echo '<script>alert("Users uploaded successfully"); window.location.href="../add-users.php";</script>';

                if(mysqli_query($link, $sql)) {
                    echo '<script>alert("Users uploaded successfully"); window.location.href="../add-users.php";</script>';
                } else {
                    echo "Error: " . mysqli_error($link);
                }
                
        }
        else echo "Only CSV and XLSX files allowed.";
            
    }
    else {
        echo "Sorry, your file is too large. It should be less than 10MB";
    }
    
} 













































// $file = $_FILES["user-file"];
//     $file_name = $file["name"];
//     print_r($file_name);

    // if($_FILES["user-file"]) {
    //     $file = $_FILES["user-file"];

    //     // Process the CSV data and insert into the database
    //     $file = fopen($file, "r");

    //     // while (($data = fgetcsv($file)) !== FALSE) {
    //         // $sql = "INSERT INTO GUFIC_EMPLOYEE_UPLOAD (`DIVISION`, `EMP CODE`, `DATE OF JOINING`, `EMPLOYEE FIRST NAME`, `DESIGNATION`, 
    //         // `GRADE`, `HQ. NAME`, `STATE`, `ZONE`, `REPORTING MANAGER NAME`, `REPORTING TO EMP CODE`, `MOBILE NUMBER`, 
    //         // `PERSONAL EMAIL ID`, `OFFICIAL EMAIL ID`, `CFA NAME`, `CFA Location`) 
    //         // VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]',
    //         // '$data[6]', '$data[7]', '$data[8]', '$data[9]', '$data[10]', '$data[11]', '$data[12]', '$data[13]', '$data[14]', '$data[15]')";

    //         $sql = "LOAD DATA LOCAL INFILE '".$file."' INTO TABLE your_table_name FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES";

    //         echo $sql;
            
    //         // if(mysqli_query($link, $sql)) {
    //         //     echo "Data uploaded successfully";
    //         // } else {
    //         //     echo "Error: " . mysqli_error($link);
    //         // }
    //     // }

    //     fclose($file);
    //     $link->close();
    // } else {
    //     // Provide specific error message based on the upload error code
    //     switch ($_FILES["user-file"]["error"]) {
    //         case UPLOAD_ERR_INI_SIZE:
    //             echo "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
    //             break;
    //         case UPLOAD_ERR_FORM_SIZE:
    //             echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
    //             break;
    //         case UPLOAD_ERR_PARTIAL:
    //             echo "The uploaded file was only partially uploaded.";
    //             break;
    //         case UPLOAD_ERR_NO_FILE:
    //             echo "No file was uploaded.";
    //             break;
    //         case UPLOAD_ERR_NO_TMP_DIR:
    //             echo "Missing a temporary folder.";
    //             break;
    //         case UPLOAD_ERR_CANT_WRITE:
    //             echo "Failed to write file to disk.";
    //             break;
    //         case UPLOAD_ERR_EXTENSION:
    //             echo "A PHP extension stopped the file upload.";
    //             break;
    //         default:
    //             echo "Unknown upload error.";
    //             break;
    //     }
    // }
