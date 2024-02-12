<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See https://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - https://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

 include '../layouts/session.php';
 $start_date = isset($_COOKIE['start_date']) ? $_COOKIE['start_date'] : date('Y-04-01');
 $end_date = isset($_COOKIE['end_date']) ? $_COOKIE['end_date'] : date('Y-m-d');
 $emp_id = isset($_COOKIE['emp_id']) ? $_COOKIE['emp_id'] : $_SESSION['user_id'];
 $cfa = isset($_COOKIE['cfa_id']) ? $_COOKIE['cfa_id'] : '';
 


// DB table to use
// $table =  '';
$table = <<<EOT
 (
    SELECT 
            *
        FROM(
    SELECT ORD.ORDER_ID, 
                CONCAT(MEMP.FST_NAME,' ',MEMP.LST_NAME) AS ORDER_BY,
                CONCAT(APR.FST_NAME, ' ', APR.LST_NAME) AS APPROVER,
                ORD.CREATED AS ORDER_DATE,
                PROD.PROD_NAME AS PRODUCT,
                OLI.ORDER_QUANTITY AS QUANTITY,
                OLI.UNIT_PRICE AS REQUESTED_SPECIAL_PRICE,
                OLI.PRICE AS TOTAL_PRICE,
                CHM.NAME AS HOSPITAL_NAME,
                STK.NAME AS CFA_NAME
            FROM GSTMED_ORDER ORD
            JOIN MILJON_EMPLOYEE MEMP ON MEMP.MEMPLOYEE_ID = ORD.BA_ID
            JOIN MILJON_EMPLOYEE APR ON APR.MEMPLOYEE_ID = ORD.ORDER_BY
            JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
            JOIN GSTMED_PRODUCT PROD ON PROD.PRODUCT_ID = OLI.SKU_ID 
            JOIN GSTMED_RETAILER_MASTER RET ON RET.CHEMIST_ID = ORD.CREATED_BY
            JOIN GSTMED_ACCOUNT CHM ON CHM.ACCOUNT_ID = RET.ORG_ID
            JOIN GSTMED_ACCOUNT STK ON STK.ACCOUNT_ID = ORD.ORG_ID

            WHERE  DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
            AND ORD.STOKIEST_ID LIKE '%$cfa%'
            AND find_in_set(ORD.BA_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))
    ) AS subquery
 ) temp
EOT;



// Table's primary key
$primaryKey = 'ORDER_ID';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'ORDER_ID',     'dt' => 0 ),
    array( 'db' => 'ORDER_BY', 'dt' => 1 ),
    array( 'db' => 'APPROVER',     'dt' => 2 ),
    array( 'db' => 'ORDER_DATE',   'dt' => 3 ),
    array( 'db' => 'PRODUCT', 'dt' => 4 ),

    array( 'db' => 'QUANTITY',  'dt' => 5 ),
    array( 'db' => 'REQUESTED_SPECIAL_PRICE',  'dt' => 6 ),
    array( 'db' => 'TOTAL_PRICE',  'dt' => 7 ),
    array( 'db' => 'HOSPITAL_NAME',     'dt' => 8 ),
    array( 'db' => 'CFA_NAME',   'dt' => 9 )
);


// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' =>  'Globalspace@100$',
    'db'   => 'MELJOHN_UPLOAD_SATISH',
    'host' => '13.235.43.173'
);

require( 'ssp.class.php' );

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, null)
);

