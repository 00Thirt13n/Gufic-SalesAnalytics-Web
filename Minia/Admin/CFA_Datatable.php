<?php 
    
    include 'layouts/session.php'; 
    require_once "layouts/config.php";

    $emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : $_SESSION['user_id'];
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d');
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');
    $cfa = isset($_POST['cfa']) ? $_POST['cfa'] : '';

    // $sql = "SELECT `ORDER ID`, `ORDER BY`, `APPROVER`, `ORDER DATE`,`PRODUCT`, `QUANTITY`, `REQUESTED SPECIAL PRICE`,`TOTAL PRICE`, `HOSPITAL NAME`, `CFA NAME` 
    //         FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) between '$start_date' and '$end_date'
    //         AND `CFA_ID` like '%$cfa%'
    //         AND find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))";

    $sql = "SELECT ORD.ORDER_ID, 
                CONCAT(MEMP.FST_NAME,' ',MEMP.LST_NAME) AS `ORDER BY`,
                CONCAT(APR.FST_NAME, ' ', APR.LST_NAME) AS APPROVER,
                ORD.CREATED AS `ORDER DATE`,
                PROD.PROD_NAME AS PRODUCT,
                OLI.ORDER_QUANTITY AS QUANTITY,
                OLI.UNIT_PRICE AS `REQUESTED SPECIAL PRICE`,
                OLI.PRICE AS `TOTAL PRICE`,
                CHM.NAME AS `HOSPITAL NAME`,
                STK.NAME AS `CFA NAME`
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
            AND find_in_set(ORD.BA_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))";
    
    $stmt = mysqli_query($link, $sql);
    ?>
<head>
    <title>CFA DataTables</title>   
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
</head>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body bgdark" style="padding:0;">
                <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ORDER ID</th>
                            <th>ORDER BY</th>
                            <th>APPROVER</th>
                            <th>ORDER DATE</th>
                            <th>PRODUCT</th>
                            <th>QUANTITY</th>
                            <th>REQUESTED SPECIAL PRICE</th>
                            <th>TOTAL PRICE</th>
                            <th>HOSPITAL NAME</th>
                            <th>CFA NAME</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($stmt as $data){
                        ?>
                        <tr >
                            <td><?php echo $data['ORDER_ID']??''; ?></td>
                            <td><?php echo $data['ORDER BY']??''; ?></td>
                            <td><?php echo $data['APPROVER']??''; ?></td>
                            <td><?php echo $data['ORDER DATE']??''; ?></td>
                            <td><?php echo $data['PRODUCT']??''; ?></td>
                            <td><?php echo $data['QUANTITY']??''; ?></td>
                            <td><?php echo $data['REQUESTED SPECIAL PRICE']??''; ?></td>
                            <td><?php echo $data['TOTAL PRICE']??''; ?></td>
                            <td><?php echo $data['HOSPITAL NAME']??''; ?></td>
                            <td><?php echo $data['CFA NAME']??''; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>