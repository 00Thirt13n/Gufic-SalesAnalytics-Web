<?php

    include 'layouts/session.php'; 
    require_once "layouts/config.php";

    $emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : $_SESSION['user_id'];
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01');
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');

    $sql = "SELECT `ORDER ID`, `ORDER BY`, `APPROVER`,`ORDER APPROVER STATUS`, `ORDER DATE`,`MONTH`,
            `PRODUCT`, `QUANTITY`, `REQUESTED SPECIAL PRICE`,
            `TOTAL PRICE`, `HOSPITAL NAME`, `CFA NAME` FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where (`ORDER APPROVER STATUS` = 'APPROVED' 
            and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`) between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))";
    
    $stmt = mysqli_query($link, $sql);
?>

<head>

    <title>DataTables</title>   
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

</head>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ORDER ID</th>
                        <th>ORDER BY</th>
                        <th>APPROVER</th>
                        <th>ORDER APPROVER STATUS</th>
                        <th>ORDER MONTH</th>
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
                    foreach ($stmt as $data) {
                    ?>
                        <tr>
                            <td><?php echo $data['ORDER ID'] ?? ''; ?></td>
                            <td><?php echo $data['ORDER BY'] ?? ''; ?></td>
                            <td><?php echo $data['APPROVER'] ?? ''; ?></td>
                            <td><?php echo $data['ORDER APPROVER STATUS'] ?? ''; ?></td>
                            <td><?php echo $data['MONTH'] ?? ''; ?></td>
                            <td><?php echo $data['ORDER DATE'] ?? ''; ?></td>
                            <td><?php echo $data['PRODUCT'] ?? ''; ?></td>
                            <td><?php echo $data['QUANTITY'] ?? ''; ?></td>
                            <td><?php echo $data['REQUESTED SPECIAL PRICE'] ?? ''; ?></td>
                            <td><?php echo $data['TOTAL PRICE'] ?? ''; ?></td>
                            <td><?php echo $data['HOSPITAL NAME'] ?? ''; ?></td>
                            <td><?php echo $data['CFA NAME'] ?? ''; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->
           


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