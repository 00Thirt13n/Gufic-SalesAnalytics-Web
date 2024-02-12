<?php 
    include "layouts/config.php";
    $start_date; // Default to today's date
    $end_date; // Default to today's date

    if (isset($_REQUEST['start-date'])) { $start_date = $_REQUEST['start-date']; } 
    if (isset($_REQUEST['end-date'])) { $end_date = $_REQUEST['end-date']; }


class dashboardData {

    public function __construct($type)
    {
        if($type =="daily"){
            $start_date = date('Y-m-d');
            $end_date = $start_date;
        }
        else if($type =="monthly"){
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
        }
        else if($type =="yearly"){
            $start_date = date('Y-04-01');
            $end_date =date('Y-m-d');
        }
    }
  

    public function GetData($link,$start_date,$end_date, $cfa, $emp_id) {

        //Daily Order Booking
        // $sql = "SELECT COUNT(DISTINCT `ORDER ID`)  ORDER_COUNT, round(sum(`TOTAL PRICE`),2) as ORDERS 
        //         from  MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) between '$start_date' and '$end_date'
        //         AND (CFA_ID like '%$cfa%') and date(`ORDER DATE`) between '$start_date' and '$end_date'
        //         and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))";

        $sql = "SELECT 
                    COUNT(DISTINCT ORD.ORDER_ID) ORDER_COUNT,
                    ROUND(SUM(OLI.PRICE), 2) AS ORDERS
                FROM
                    GSTMED_ORDER ORD
                JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
                JOIN GSTMED_ACCOUNT STK ON STK.ACCOUNT_ID = ORD.ORG_ID
                JOIN GSTMED_EMPLOYEE CFA ON STK.ACCOUNT_ID = CFA.ORG_ID
                
                WHERE DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
                AND CFA.EMPLOYEE_ID LIKE '%$cfa%'
                AND FIND_IN_SET(ORD.BA_ID,
                            IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),
                                    '$emp_id'))";

        $daily_order_booking = mysqli_query($link, $sql);
        while ($row = $daily_order_booking->fetch_array(MYSQLI_ASSOC)) {
            $order_count = $row['ORDER_COUNT'];
            $order_value = $row['ORDERS'];  
        }

        // APPROVED
        // $sql31 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
        //         where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and CFA_ID like '%$cfa%') 
        //         and date(`ORDER DATE`) between '$start_date' and '$end_date'
        //         and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))";


        $approved_sql = "SELECT COUNT(DISTINCT ORD.ORDER_ID)  APPROVED_COUNT, ROUND(SUM(OLI.PRICE), 2) APPROVED_TOTAL 
                        FROM GSTMED_ORDER ORD
                        JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
                        JOIN GSTMED_ACCOUNT STK ON STK.ACCOUNT_ID = ORD.ORG_ID
                        JOIN GSTMED_EMPLOYEE CFA ON STK.ACCOUNT_ID = CFA.ORG_ID
                        
                        WHERE 
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
                                END) = 'APPROVED'
                        
                        AND 
                            (CASE
                                    WHEN (`OLI`.`ORDER_STATUS` = 'LOV_17') THEN 'PENDING'
                                    ELSE (CASE
                                        WHEN (`OLI`.`ORDER_STATUS` = 'LOV_16') THEN 'APPROVED'
                                        ELSE (CASE
                                            WHEN (`OLI`.`ORDER_STATUS` = 'LOV_21') THEN 'CANCELLED'
                                        END)
                                    END)
                                END) != 'CANCELLED' 
                        
                        
                        AND CFA.EMPLOYEE_ID LIKE '%$cfa%'
                        AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
                        AND FIND_IN_SET(ORD.BA_ID,
                                    IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),
                                            '$emp_id'))";
        
        $result = mysqli_query($link, $approved_sql);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $net_count = $approved_count = $row['APPROVED_COUNT'];
            $net_value = $approved_value = $row['APPROVED_TOTAL'];
        }
        

        // PENDING
        // $sql32 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
        //         where (`ORDER APPROVER STATUS` = 'PENDING' and CFA_ID like '%$cfa%') and date(`ORDER DATE`)  between '$start_date' and '$end_date'
        //         and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))";

        $pending_sql = "SELECT COUNT(DISTINCT ORD.ORDER_ID)  APPROVED_COUNT, ROUND(SUM(OLI.PRICE), 2) APPROVED_TOTAL 
                        FROM GSTMED_ORDER ORD
                        JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
                        JOIN GSTMED_ACCOUNT STK ON STK.ACCOUNT_ID = ORD.ORG_ID
                        JOIN GSTMED_EMPLOYEE CFA ON STK.ACCOUNT_ID = CFA.ORG_ID
                        
                        WHERE 
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
                                END) = 'PENDING'
                        
                        AND CFA.EMPLOYEE_ID LIKE '%$cfa%'
                        AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
                        AND FIND_IN_SET(ORD.BA_ID,
                                    IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),
                                            '$emp_id'))";

        $result = mysqli_query($link, $pending_sql);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $pending_count = $row['APPROVED_COUNT'];
            $pending_value = $row['APPROVED_TOTAL'];
        }
        
        //DECLINED

        // $sql33 ="SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
        //         where (`ORDER APPROVER STATUS` = 'CANCELLED' or `CFA APPROVER STATUS` = 'CANCELLED') and CFA_ID like '%$cfa%' 
        //         and date(`ORDER DATE`) between '$start_date' and '$end_date'
        //         and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))";


        $declined_sql = "SELECT COUNT(DISTINCT ORD.ORDER_ID)  APPROVED_COUNT, ROUND(SUM(OLI.PRICE), 2) APPROVED_TOTAL 
                        FROM GSTMED_ORDER ORD
                        JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
                        JOIN GSTMED_ACCOUNT STK ON STK.ACCOUNT_ID = ORD.ORG_ID
                        JOIN GSTMED_EMPLOYEE CFA ON STK.ACCOUNT_ID = CFA.ORG_ID
                        
                        WHERE 
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
                                END) = 'CANCELLED'

                        AND 
                                (CASE
                                        WHEN (`OLI`.`ORDER_STATUS` = 'LOV_17') THEN 'PENDING'
                                        ELSE (CASE
                                            WHEN (`OLI`.`ORDER_STATUS` = 'LOV_16') THEN 'APPROVED'
                                            ELSE (CASE
                                                WHEN (`OLI`.`ORDER_STATUS` = 'LOV_21') THEN 'CANCELLED'
                                            END)
                                        END)
                                    END) = 'CANCELLED' 
                        
                        AND CFA.EMPLOYEE_ID LIKE '%$cfa%'
                        AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
                        AND FIND_IN_SET(ORD.BA_ID,
                                    IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),
                                            '$emp_id'))";

        $result = mysqli_query($link, $declined_sql);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $declined_count = $row['APPROVED_COUNT'];
            $declined_value = $row['APPROVED_TOTAL'];
        }


        $data = array($order_count, $order_value, $net_count, $net_value, $approved_count, $approved_value, $pending_count, $pending_value, $declined_count, $declined_value);
        // print_r($data); die;
        return $data;
        
        
    }
}

?>