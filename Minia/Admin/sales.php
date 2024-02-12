<?php
require_once "layouts/config.php";

$ftp_server = "103.205.125.116";
$ftp_user = "globalspace";
$ftp_pass = "Glb#Space@2023";
$remote_file = "/temp/sales_details_temp.csv";
$local_file = "sales_downloaded.csv";

try {
    // Establish an FTP connection
    $ftp_conn = ftp_connect($ftp_server);
    if (!$ftp_conn) {
        throw new Exception("Could not connect to $ftp_server");
    }

    // Log in to FTP server
    $login_result = ftp_login($ftp_conn, $ftp_user, $ftp_pass);
    if (!$login_result) {
        throw new Exception("Login failed");
    }

    // Set passive mode (optional, depends on server configuration)
    ftp_pasv($ftp_conn, true);


    // Download the file
    if (ftp_get($ftp_conn, $local_file, $remote_file, FTP_ASCII)) {


        // echo "Successfully downloaded $remote_file as $local_file"; echo '<br>';
        
        if(($handle = fopen($local_file, "r")) !== FALSE) {
            
            $n = 1;
            
            while(($row = fgetcsv($handle)) !== FALSE) {

                $sql = 'INSERT IGNORE INTO MELJOHN_UPLOAD_SATISH.FTP_SALES_DETAILS(
                        COMPANY_NAME,	LOCATION,	TYPE,	TXNDOCNO,	TXNDOCDT,	PARTY_CODE,	PARTY_NAME,	HOSPITAL_NAME,	
                        CITY,	STATE,	HQ,	CBA_NAME,	CBM_NAME,	CCM_NAME,	SALESMAN,	ITEMMATCODE,	ITEMMATNAME,
                        BATCHINWNO,	MRP,	BILLRATE,	GROSS_QTY,	GROSS_AMT,	RET_QTY,	RET_AMT,	PDCN,	NET_QTY,	
                        NET_SALES,	SGST,	CGST,	IGST,	TOTALAMT,	PARTYORDNO,	PARTYORDDT,	INVOICE_REMARK,	TXNDBC) 

                        VALUES ("'.$row[0].'","'.$row[1].'","'.$row[2].'","'.$row[3].'","'.$row[4].'","'.$row[5].'",
                        "'.$row[6].'","'.$row[7].'","'.$row[8].'","'.$row[9].'","'.$row[10].'","'.$row[11].'",
                        "'.$row[12].'","'.$row[13].'","'.$row[14].'","'.$row[15].'","'.$row[16].'","'.$row[17].'",
                        "'.$row[18].'","'.$row[19].'","'.$row[20].'","'.$row[21].'","'.$row[22].'","'.$row[23].'",
                        "'.$row[24].'","'.$row[25].'","'.$row[26].'","'.$row[27].'","'.$row[28].'","'.$row[29].'",
                        "'.$row[30].'","'.$row[31].'","'.$row[32].'","'.$row[33].'","'.$row[34].'")';
                
                if ($link->query($sql) === TRUE) {
                    //data successfully inserted
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

    // Close the FTP connection
    ftp_close($ftp_conn);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
echo ('####################################################### The cron job is running the PHP file: /var/www/html/gufic/mediapp/AdminWeb/Minia/Admin/sales.php #######################################################');
?>
