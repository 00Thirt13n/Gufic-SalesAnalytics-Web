
<?php
    include '../layouts/session.php';
    require_once "../layouts/config.php";
    
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d');
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');
    $emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : $_SESSION['user_id'];
    $cfa = isset($_POST['cfa']) ? $_POST['cfa'] : '';
    

    
    // TOP PERFORMERS
       
    // $sql = "SELECT round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL  FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
    //         where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' 
    //         and date(`ORDER DATE`)between '$start_date' and '$end_date' AND  CFA_ID like '%$cfa%'";

    $sql = "SELECT COUNT(DISTINCT ORD.ORDER_ID)  APPROVED_COUNT, ROUND(SUM(OLI.PRICE), 2) APPROVED_TOTAL 
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
            
            
            AND ORD.STOKIEST_ID LIKE '%$cfa%'
            AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
            AND FIND_IN_SET(ORD.BA_ID,IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),'$emp_id'))";

    $products = mysqli_query($link, $sql);

    while ($row = $products->fetch_array(MYSQLI_ASSOC)) {
         $top_product_result = $row['APPROVED_TOTAL'];
      }

    echo "<script>console.log('total')</script>";

    // $sql2 = "SELECT DISTINCT `PRODUCT` PRODUCT, SUM(QUANTITY) AS QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
    //         where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
    //         AND  CFA_ID like '%$cfa%'and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
    //         group by `PRODUCT` order by round(sum(`TOTAL PRICE`),2) desc limit 10";


    $sql2 = "SELECT DISTINCT PROD.PROD_NAME AS PRODUCT, 
                OLI.ORDER_QUANTITY AS QUANTITY, 
                ROUND(SUM(OLI.PRICE), 2) AS TOTAL, 
                ROUND(((SUM(OLI.PRICE)/ $top_product_result)*100),2) PERCENTAGE
            FROM GSTMED_ORDER ORD
            JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
            JOIN GSTMED_PRODUCT PROD ON PROD.PRODUCT_ID = OLI.SKU_ID 
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


            AND ORD.STOKIEST_ID LIKE '%$cfa%'
            AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
            AND FIND_IN_SET(ORD.BA_ID,
            IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),'$emp_id'))
            GROUP BY PRODUCT ORDER BY ROUND(SUM(OLI.PRICE), 2) DESC LIMIT 10";

    $top_products = mysqli_query($link, $sql2);

    echo "<script>console.log('top product')</script>";

    // for chart
    $product = mysqli_query($link, $sql2);
    $top_products_name = array(); 
    $top_products_per = array();
      
    $total_per=0; $i=5;
    if($top_products)
        while ($row = $product->fetch_array(MYSQLI_ASSOC)) {
            if($i==0) break; else $i--;
            array_push($top_products_name, strtoupper($row['PRODUCT']) );
            array_push($top_products_per, $row['PERCENTAGE']);
            $total_per +=$row['PERCENTAGE'];
        }

    array_push($top_products_name, 'OTHER');
    array_push($top_products_per, 100-$total_per);

    // $sql3 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL,HQ ,round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
    //         where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
    //         AND  CFA_ID like '%$cfa%' and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
    //         group by `HOSPITAL NAME`,`HOSPITAL ADDRESS` order by round(sum(`TOTAL PRICE`),2) desc limit 10";

    $sql3 = "SELECT DISTINCT CHM.NAME AS HOSPITAL, HQ.HQ AS HQ,
                ROUND(SUM(OLI.PRICE), 2) AS TOTAL, 
                ROUND(((SUM(OLI.PRICE)/ $top_product_result)*100),2) PERCENTAGE
            FROM GSTMED_ORDER ORD
            JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
            JOIN GSTMED_RETAILER_MASTER RET ON RET.CHEMIST_ID = ORD.CREATED_BY
            JOIN GSTMED_ACCOUNT CHM ON CHM.ACCOUNT_ID = RET.ORG_ID
            JOIN MILJON_EMPLOYEE MEMP ON MEMP.MEMPLOYEE_ID = ORD.BA_ID
            JOIN GUFIC_EMPLOYEE HQ ON MEMP.EMPLOYEE_CODE = HQ.`EMP CODE`
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


            AND ORD.STOKIEST_ID LIKE '%$cfa%'
            AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
            AND FIND_IN_SET(ORD.BA_ID,
            IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),'$emp_id'))
            GROUP BY HOSPITAL, BILLING_ADDRESS ORDER BY ROUND(SUM(OLI.PRICE), 2) DESC LIMIT 10";

    $top_hospitals = mysqli_query($link, $sql3);

    echo "<script>console.log('top hospital')</script>";
    
    // for chart
    $hospitals = mysqli_query($link, $sql3);
    $top_hospitals_name = array(); 
    $top_hospitals_per = array();   
    $total_hospital_per=0; $i=5;

    if($top_hospitals)
        while ($row = $hospitals->fetch_array(MYSQLI_ASSOC)) {
            if($i==0) break; else $i--;
            array_push($top_hospitals_name, strtoupper($row['HOSPITAL']));
            array_push($top_hospitals_per, $row['PERCENTAGE']);
            $total_hospital_per +=$row['PERCENTAGE'];
        }
    array_push($top_hospitals_name, 'OTHER');
    array_push($top_hospitals_per, 100-$total_hospital_per);

    // $sql4 = "SELECT DISTINCT `HOSPITAL CITY` CITY, `ORDER BY`, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
    //         where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
    //         AND  CFA_ID like '%$cfa%' and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
    //         group by `HOSPITAL CITY` order by round(sum(`TOTAL PRICE`),2) desc limit 10";

    $sql4 = "SELECT DISTINCT HQ.HQ AS CITY,
                CONCAT(MEMP.FST_NAME,' ',MEMP.LST_NAME) AS `ORDER BY`,
                ROUND(SUM(OLI.PRICE), 2) AS TOTAL, 
                            ROUND(((SUM(OLI.PRICE) / $top_product_result)*100),2) PERCENTAGE
            FROM GSTMED_ORDER ORD
            JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
            JOIN GSTMED_RETAILER_MASTER RET ON RET.CHEMIST_ID = ORD.CREATED_BY
            JOIN GSTMED_ACCOUNT CHM ON CHM.ACCOUNT_ID = RET.ORG_ID
            JOIN MILJON_EMPLOYEE MEMP ON MEMP.MEMPLOYEE_ID = ORD.BA_ID
            JOIN GUFIC_EMPLOYEE HQ ON MEMP.EMPLOYEE_CODE = HQ.`EMP CODE`
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


            AND ORD.STOKIEST_ID LIKE '%$cfa%'
            AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
            AND FIND_IN_SET(ORD.BA_ID,
            IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),'$emp_id'))
            GROUP BY CITY ORDER BY ROUND(SUM(OLI.PRICE), 2) DESC LIMIT 10";

    $top_area = mysqli_query($link, $sql4);

    echo "<script>console.log('top city')</script>";

  // BOTTOM PERFORMERS

   $bottom_total = $top_product_result;

//    $sql11 = "SELECT DISTINCT `PRODUCT` PRODUCT, SUM(QUANTITY) AS QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $bottom_total)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
//             where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
//             and CFA_ID like '%$cfa%' and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
//             group by `PRODUCT` order by round(sum(`TOTAL PRICE`),2) asc limit 10";



        $sql11 = "SELECT DISTINCT PROD.PROD_NAME AS PRODUCT, 
        OLI.ORDER_QUANTITY AS QUANTITY, 
        ROUND(SUM(OLI.PRICE), 2) AS TOTAL, 
        ROUND(((SUM(OLI.PRICE)/ $top_product_result)*100),2) PERCENTAGE
        FROM GSTMED_ORDER ORD
        JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
        JOIN GSTMED_PRODUCT PROD ON PROD.PRODUCT_ID = OLI.SKU_ID 
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


        AND ORD.STOKIEST_ID LIKE '%$cfa%'
        AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
        AND FIND_IN_SET(ORD.BA_ID,
        IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),'$emp_id'))
        GROUP BY PRODUCT ORDER BY ROUND(SUM(OLI.PRICE), 2) ASC LIMIT 10";

    $bottom_products = mysqli_query($link, $sql11);

    echo "<script>console.log('bottom product')</script>";

    // $sql12 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, HQ, SUM(QUANTITY) AS QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $bottom_total)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
    //         where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
    //         and CFA_ID like '%$cfa%'and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
    //         group by `HOSPITAL NAME`order by round(sum(`TOTAL PRICE`),2) asc limit 10";


    $sql12 = "SELECT DISTINCT CHM.NAME AS HOSPITAL, HQ.HQ AS HQ,
                ROUND(SUM(OLI.PRICE), 2) AS TOTAL, 
                ROUND(((SUM(OLI.PRICE)/ $top_product_result)*100),2) PERCENTAGE
            FROM GSTMED_ORDER ORD
            JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
            JOIN GSTMED_RETAILER_MASTER RET ON RET.CHEMIST_ID = ORD.CREATED_BY
            JOIN GSTMED_ACCOUNT CHM ON CHM.ACCOUNT_ID = RET.ORG_ID
            JOIN MILJON_EMPLOYEE MEMP ON MEMP.MEMPLOYEE_ID = ORD.BA_ID
            JOIN GUFIC_EMPLOYEE HQ ON MEMP.EMPLOYEE_CODE = HQ.`EMP CODE`
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


            AND ORD.STOKIEST_ID LIKE '%$cfa%'
            AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
            AND FIND_IN_SET(ORD.BA_ID,
            IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),'$emp_id'))
            GROUP BY HOSPITAL, BILLING_ADDRESS ORDER BY ROUND(SUM(OLI.PRICE), 2) ASC LIMIT 10";

    $bottom_hospitals = mysqli_query($link, $sql12);

    echo "<script>console.log('bottom hospital')</script>";

    // $sql13 = "SELECT DISTINCT `HOSPITAL CITY` CITY,  `ORDER BY`,round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $bottom_total)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
    //         where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
    //         and CFA_ID like '%$cfa%'and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
    //         group by `HOSPITAL CITY`order by round(sum(`TOTAL PRICE`),2) asc limit 10";


    $sql13 = "SELECT DISTINCT HQ.HQ AS CITY,
                CONCAT(MEMP.FST_NAME,' ',MEMP.LST_NAME) AS `ORDER BY`,
                ROUND(SUM(OLI.PRICE), 2) AS TOTAL, 
                ROUND(((SUM(OLI.PRICE) / $top_product_result)*100),2) PERCENTAGE
            FROM GSTMED_ORDER ORD
            JOIN GSTMED_ORDER_LINEITEM OLI ON ORD.ORDER_ID = OLI.ORDER_ID
            JOIN GSTMED_RETAILER_MASTER RET ON RET.CHEMIST_ID = ORD.CREATED_BY
            JOIN GSTMED_ACCOUNT CHM ON CHM.ACCOUNT_ID = RET.ORG_ID
            JOIN MILJON_EMPLOYEE MEMP ON MEMP.MEMPLOYEE_ID = ORD.BA_ID
            JOIN GUFIC_EMPLOYEE HQ ON MEMP.EMPLOYEE_CODE = HQ.`EMP CODE`
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


            AND ORD.STOKIEST_ID LIKE '%$cfa%'
            AND DATE(ORD.CREATED) BETWEEN '$start_date' AND '$end_date'
            AND FIND_IN_SET(ORD.BA_ID,
            IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')),'$emp_id'))
            GROUP BY CITY ORDER BY ROUND(SUM(OLI.PRICE), 2) ASC LIMIT 10";
            
    $bottom_area = mysqli_query($link, $sql13);

    echo "<script>console.log('bottom city')</script>";

?>

<div class="row mt-5">
    <div class="col-xl-6">
        <div class="card border">
            <div class="card-header">
                <h4 class="card-title mb-0">TOP PROUCTS</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <!--end card-->
    </div>
    <div class="col-xl-6">
        <div class="card border">
            <div class="card-header">
                <h4 class="card-title mb-0">TOP HOSPITALS</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart3"></canvas>
            </div>
        </div>
        <!--end card-->
    </div>
</div>


 <!--COLLAPSEABLE TABLE FOR TOP 10-->
 <div class="row">
    <div class="col-xl-4">
        <div class="card ">
            <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                Top 10 Performing Products
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse " aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-muted" style="padding:0;">
                                <table class="table align-middle mb-0 bg-white border">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>% of Sales / Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:#f9f9f9;">
                                        <?php
                                        if ($top_products)
                                            while ($row = $top_products->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">
                                                                <?php
                                                                echo $row['PRODUCT'];
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['QUANTITY'] ?></p>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                </td>
                                            </tr>
                                        <?php
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne2">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne2" aria-expanded="true" aria-controls="flush-collapseOne2">
                                Top 10 Performing HQ
                            </button>
                        </h2>
                        <div id="flush-collapseOne2" class="accordion-collapse collapse " aria-labelledby="flush-headingOne2" data-bs-parent="#accordionFlushExample2">
                            <div class="accordion-body text-muted" style="padding:0;">
                                <table class="table align-middle mb-0 bg-white border">
                                    <thead class="bg-light ">
                                        <tr>
                                            <th>HQ Name</th>
                                            <th>% of Sales / Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:#f9f9f9;">
                                        <?php
                                        if ($top_area)
                                            while ($row = $top_area->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">
                                                                <?php
                                                                echo $row['CITY'];
                                                                ?>
                                                            </p>
                                                            <p class="text-muted mb-0"><?php echo '(' . $row['ORDER BY'] . ')' ?> </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                </td>
                                            </tr>
                                        <?php
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                <div class="accordion accordion-flush" id="accordionFlushExample3">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne3">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne3" aria-expanded="true" aria-controls="flush-collapseOne3">
                                Top 10 Performing Hospitals
                            </button>
                        </h2>
                        <div id="flush-collapseOne3" class="accordion-collapse collapse " aria-labelledby="flush-headingOne3" data-bs-parent="#accordionFlushExample3">
                            <div class="accordion-body text-muted" style="padding:0;">
                                <table class="table align-middle mb-0 bg-white border">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Hospital Name</th>
                                            <th>% of Sales / Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:#f9f9f9;">
                                        <?php
                                        if ($top_hospitals)
                                            while ($row = $top_hospitals->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">
                                                                <?php
                                                                echo $row['HOSPITAL'];
                                                                ?>
                                                            </p>
                                                            <p class="text-muted mb-0"><?php echo '(' . $row['HQ'] . ')' ?> </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                </td>
                                            </tr>
                                        <?php
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!--end row-->
<!--COLLAPSEABLE TABLE FOR BOTTOM 10-->
<div class="row">
    <div class="col-xl-4">
        <div class="card ">
            <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                <div class="accordion accordion-flush" id="accordionFlushExample4">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne4">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne4" aria-expanded="true" aria-controls="flush-collapseOne4">
                                Bottom 10 Performing Products
                            </button>
                        </h2>
                        <div id="flush-collapseOne4" class="accordion-collapse collapse " aria-labelledby="flush-headingOne4" data-bs-parent="#accordionFlushExample4">
                            <div class="accordion-body text-muted" style="padding:0;">
                                <table class="table align-middle mb-0 bg-white border">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>% of Sales / Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:#f9f9f9;">
                                        <?php
                                        if ($bottom_products)
                                            while ($row = $bottom_products->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">
                                                                <?php
                                                                echo $row['PRODUCT'];
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['QUANTITY'] ?></p>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                </td>
                                            </tr>
                                        <?php
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                <div class="accordion accordion-flush" id="accordionFlushExample5">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne5">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne5" aria-expanded="true" aria-controls="flush-collapseOne5">
                                Bottom 10 Performing HQ
                            </button>
                        </h2>
                        <div id="flush-collapseOne5" class="accordion-collapse collapse " aria-labelledby="flush-headingOne5" data-bs-parent="#accordionFlushExample5">
                            <div class="accordion-body text-muted" style="padding:0;">
                                <table class="table align-middle mb-0 bg-white border">
                                    <thead class="bg-light ">
                                        <tr>
                                            <th>HQ Name</th>
                                            <th>% of Sales / Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:#f9f9f9;">
                                        <?php
                                        if ($bottom_area)
                                            while ($row = $bottom_area->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">
                                                                <?php
                                                                echo $row['CITY'];
                                                                ?>
                                                            </p>
                                                            <p class="text-muted mb-0"><?php echo '(' . $row['ORDER BY'] . ')' ?> </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                </td>
                                            </tr>
                                        <?php
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                <div class="accordion accordion-flush" id="accordionFlushExample6">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne6">
                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne6" aria-expanded="true" aria-controls="flush-collapseOne6">
                                Bottom 10 Performing Hospitals
                            </button>
                        </h2>
                        <div id="flush-collapseOne6" class="accordion-collapse collapse " aria-labelledby="flush-headingOne6" data-bs-parent="#accordionFlushExample6">
                            <div class="accordion-body text-muted" style="padding:0;">
                                <table class="table align-middle mb-0 bg-white border">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Hospital Name</th>
                                            <th>% of Sales / Total</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:#f9f9f9;">
                                        <?php
                                        if ($bottom_hospitals)
                                            while ($row = $bottom_hospitals->fetch_array(MYSQLI_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td class="col-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="ms-3">
                                                            <p class="fw-bold mb-1">
                                                                <?php
                                                                echo $row['HOSPITAL'];
                                                                ?>
                                                            </p>
                                                            <p class="text-muted mb-0"><?php echo '(' . $row['HQ'] . ')' ?> </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="col-3">
                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                </td>
                                            </tr>
                                        <?php
                                            } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!--end row-->


<!--  TARGET VS ACHIEVEMENT BAR GRAPH -->
<script>

    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + '...';
        }
        return text;
    }

    var xValues = JSON.parse('<?= json_encode($top_products_name) ?>');
    var yValues = JSON.parse('<?= json_encode($top_products_per) ?>');
    var barColors = [
        "#80b34a",
        "#b4da75",
        "#dde993",
        "#ff549a",
        "#ffaacd",
        "#715a92",
        "#d25dfb",
        "#ffd871",
        "#935d5d",
        "#f6e0d5"
    ];

    // Truncate legend labels to 15 characters
    var truncatedLabels = xValues.map(label => truncateText(label, 15));
    

var chart = new Chart("myChart2", {
        type: "pie",
        data: {
            labels: truncatedLabels,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend:{
                position : "right",
                align: "middle",
            },
            title: {
                display: false,
                text: "TOP PRODUCTS"
            },
        },
    });

chart.getDatasetMeta(0).data[5].hidden = true;    
chart.update();

</script>


<script>
        
    function truncateText(text, maxLength) {
        if (text.length > maxLength) {
            return text.substring(0, maxLength) + '...';
        }
        return text;
    }

    var xValues = JSON.parse('<?= json_encode($top_hospitals_name) ?>');
    var yValues = JSON.parse('<?= json_encode($top_hospitals_per) ?>');
    var barColors = [
        "#80b34a",
        "#b4da75",
        "#dde993",
        "#ff549a",
        "#ffaacd",
        "#715a92",
        "#d25dfb",
        "#ffd871",
        "#935d5d",
        "#f6e0d5"
    ];

    // Truncate legend labels to 15 characters
    var truncatedLabels = xValues.map(label => truncateText(label, 15));

var chart = new Chart("myChart3", {
        type: "pie",
        data: {
            labels: truncatedLabels,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend:{
                position : "right",
                align: "middle",
            },
            title: {
                display: false,
                text: "TOP PRODUCTS"
            },
        },
    });

chart.getDatasetMeta(0).data[5].hidden = true;    
chart.update();

</script>