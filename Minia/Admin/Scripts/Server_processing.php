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
 
 


// DB table to use
// $table =  '';
$table = <<<EOT
 (
    SELECT 
            *
        FROM
            (SELECT 
                ORD.ORDER_ID AS ORDER_ID,
                    CONCAT(MEMP.FST_NAME, ' ', MEMP.LST_NAME) AS ORDER_BY,
                    HQ.HQ AS HQ,
                    CONCAT(MEMP.FST_NAME, ' ', MEMP.LST_NAME) AS APPROVER,
                    ORD.CREATED AS ORDER_DATE,
                    (CASE
                        WHEN (OLI.SP_APPROVED_DATE IS NOT NULL) THEN OLI.SP_APPROVED_DATE
                        ELSE (CASE
                            WHEN
                                ((OLI.LAST_MODIFIED IS NOT NULL)
                                    AND (OLI.LAST_MODIFIED >= ORD.CREATED))
                            THEN
                                OLI.LAST_MODIFIED
                            ELSE (CASE
                                WHEN (ORD.APPROVED_DATE IS NULL) THEN ORD.CREATED
                                ELSE ORD.APPROVED_DATE
                            END)
                        END)
                    END) AS APPROVED_DATE,
                    DATE_FORMAT(ORD.CREATED, '%b') AS MONTH,
                    PROD.PROD_NAME AS PRODUCT,
                    (CASE
                        WHEN (OLI.ORDER_STATUS = 'LOV_17') THEN 'PENDING'
                        ELSE (CASE
                            WHEN (OLI.ORDER_STATUS = 'LOV_16') THEN 'APPROVED'
                            ELSE (CASE
                                WHEN (OLI.ORDER_STATUS = 'LOV_21') THEN 'CANCELLED'
                            END)
                        END)
                    END) AS CFA_APPROVER_STATUS,
                    (CASE
                        WHEN
                            (((ORD.APPROVED_DATE IS NOT NULL)
                                AND (OLI.SP_REJECTED_DATE IS NULL))
                                OR (OLI.ORDER_STATUS = 'LOV_16')
                                OR ((OLI.SP_ORDER_STATUS = 'LOV_16')
                                AND (OLI.SP_ORDER_STATUS <> 'LOV_21')))
                        THEN
                            'APPROVED'
                        ELSE (CASE
                            WHEN
                                ((OLI.ORDER_STATUS <> 'LOV_21')
                                    AND (OLI.SP_ORDER_STATUS <> 'LOV_21'))
                            THEN
                                'PENDING'
                            ELSE 'CANCELLED'
                        END)
                    END) AS ORDER_APPROVER_STATUS,
                    OLI.ORDER_QUANTITY AS QUANTITY,
                    OLI.UNIT_PRICE AS REQUESTED_SPECIAL_PRICE,
                    OLI.PRICE AS TOTAL_PRICE,
                    OLI.ORDER_STATUS AS PROD_STATUS,
                    OLI.REASON AS REASON,
                    CHM.NAME AS HOSPITAL_NAME,
                    RET.EMAIL AS HOSPITAL_EMAIL,
                    RET.MOBILE_PHONE AS MOBILE,
                    RET.FST_NAME AS CONTACT_PERSON,
                    RET.BILLING_PARTY AS BILLING_PARTY,
                    RET.BILLING_ADDRESS AS HOSPITAL_ADDRESS,
                    HQ.HQ AS HOSPITAL_CITY,
                    RET.BILLING_CODE AS HOSPITAL_PINCODE,
                    RET.BILLING_STATE AS HOSPITAL_STATE,
                    CHM.DRUG_LICENE_NO AS DRUG_LICENE_NO,
                    CHM.GST_NUMBER AS GST_NUMBER,
                    CHM.PAN_NUMBER AS PAN_NUMBER,
                    STK.NAME AS CFA_NAME
            FROM
                GSTMED_ORDER ORD
            JOIN MILJON_EMPLOYEE MEMP ON MEMP.MEMPLOYEE_ID = ORD.BA_ID
            JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
            JOIN GSTMED_PRODUCT PROD ON PROD.PRODUCT_ID = OLI.SKU_ID
            JOIN GSTMED_RETAILER_MASTER RET ON RET.CHEMIST_ID = ORD.CREATED_BY
            JOIN GSTMED_ACCOUNT CHM ON CHM.ACCOUNT_ID = RET.ORG_ID
            JOIN GSTMED_ACCOUNT STK ON STK.ACCOUNT_ID = ORD.ORG_ID
            JOIN GUFIC_EMPLOYEE HQ ON MEMP.EMPLOYEE_CODE = HQ.`EMP CODE`
            WHERE
                FIND_IN_SET(MEMP.MEMPLOYEE_ID, IFNULL(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'), '$emp_id'))
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
    array( 'db' => 'HQ', 'dt' => 2 ),
    array( 'db' => 'APPROVER',     'dt' => 3 ),
    array( 'db' => 'MONTH',   'dt' => 4 ),
    
    array( 'db' => 'ORDER_DATE',   'dt' => 5 ),
    array( 'db' => 'APPROVED_DATE', 'dt' => 6 ),
    array( 'db' => 'PRODUCT', 'dt' => 7 ),
    array( 'db' => 'CFA_APPROVER_STATUS',  'dt' => 8 ),
    array( 'db' => 'ORDER_APPROVER_STATUS', 'dt' => 9 ),

    array( 'db' => 'QUANTITY',  'dt' => 10 ),
    array( 'db' => 'REQUESTED_SPECIAL_PRICE',  'dt' => 11 ),
    array( 'db' => 'TOTAL_PRICE',  'dt' => 12 ),
    array( 'db' => 'PROD_STATUS',  'dt' => 13 ),
    array( 'db' => 'REASON',   'dt' => 14 ),

    array( 'db' => 'HOSPITAL_NAME',     'dt' => 15 ),
    array( 'db' => 'HOSPITAL_EMAIL', 'dt' => 16 ),
    array( 'db' => 'MOBILE',     'dt' => 17 ),
    array( 'db' => 'CONTACT_PERSON', 'dt' => 18 ),
    array( 'db' => 'BILLING_PARTY',   'dt' => 19 ),

    array( 'db' => 'HOSPITAL_ADDRESS',   'dt' => 20 ),
    array( 'db' => 'HOSPITAL_CITY',  'dt' => 21 ),
    array( 'db' => 'HOSPITAL_PINCODE',  'dt' => 22 ),
    array( 'db' => 'HOSPITAL_STATE',     'dt' => 23 ),
    array( 'db' => 'DRUG_LICENE_NO', 'dt' => 24 ),

    array( 'db' => 'GST_NUMBER',     'dt' => 25 ),
    array( 'db' => 'PAN_NUMBER', 'dt' => 26 ),
    array( 'db' => 'CFA_NAME',   'dt' => 27 )
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
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "ORDER_DATE  between '$start_date' and '$end_date'")
);

