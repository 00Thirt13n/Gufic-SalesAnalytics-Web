<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include "layouts/config.php"; ?>

<head>

    <title>Approval Matrix</title>
    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-style.php'; ?>

    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
    </style>

    

</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Approval Matrix</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0"> 
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                                    <li class="breadcrumb-item active">Approval Matrix</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


            <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-container ">

                                <table id="datatable-buttons" class="table table-striped table-hover table-bordered  table-container  nowrap w-100">
                                    <thead>
                                        <tr>
                                                <th>SI NO</th>
                                                <th>MOLECULE</th>
                                                <th>STRENGTH</th>
                                                <th>FINALISED BRAND NAME</th>
                                                <th>MRP</th>
                                                <th>BASE PRICE</th>
                                                <th>ABM FROM</th>
                                                <th>ABM TO</th>
                                                <th>RBM FROM</th>
                                                <th>RBM TO</th>
                                                <th>ZBM FROM</th>
                                                <th>ZBM TO</th>
                                                <th>BU FROM</th>
                                                <th>BU TO</th>
                                                <th>HO</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                         <!-- PHP code to fetch and display data -->
                                            <?php
                                                include "layouts/config.php";
                                            $sql =  "SELECT `approval_matrix_final`.`Sl No` as `SI NO`,
                                                            `approval_matrix_final`.`MOLECULE`,
                                                            `approval_matrix_final`.`STRENGTH`,
                                                            `approval_matrix_final`.`Finalised Brand Name` as `FINALISED BRAND NAME` ,
                                                            `approval_matrix_final`.`MRP`,
                                                            `approval_matrix_final`.`BASE PRICE`,
                                                            `approval_matrix_final`.`ABM_FROM` as `ABM FROM`,
                                                            `approval_matrix_final`.`ABM_TO` as `ABM TO`, 
                                                            `approval_matrix_final`.`RBM_FROM` as `RBM FROM`,
                                                            `approval_matrix_final`.`RBM_TO` as `RBM TO`,
                                                            `approval_matrix_final`.`ZBM_FROM` as `ZBM FROM`,
                                                            `approval_matrix_final`.`ZBM_TO` as `ZBM TO`,
                                                            `approval_matrix_final`.`BU_FROM` as `BU FROM`,
                                                            `approval_matrix_final`.`BU_TO` as `BU TO`,
                                                            `approval_matrix_final`.`HO`
                                                        FROM `MELJOHN_UPLOAD_SATISH`.`approval_matrix_final`";

                                            // echo ($sql);

                                            $result = mysqli_query($link, $sql);
                                            ?>
                                        <?php
                                            if($result){      
                                            $sn=1;
                                            
                                            foreach($result as $data){
                                            ?>
                                            <tr>
                                                <td><?php echo $data['SI NO']??''; ?></td>
                                                <td><?php echo $data['MOLECULE']??''; ?></td>
                                                <td><?php echo $data['STRENGTH']??''; ?></td>
                                                <td><?php echo $data['FINALISED BRAND NAME']??''; ?></td>
                                                <td><?php echo $data['MRP']??''; ?></td>
                                                <td><?php echo $data['BASE PRICE']??''; ?></td>
                                                <td><?php echo $data['ABM FROM']??''; ?></td>
                                                <td><?php echo $data['ABM TO']??''; ?></td>
                                                <td><?php echo $data['RBM FROM']??''; ?></td>
                                                <td><?php echo $data['RBM TO']??''; ?></td>
                                                <td><?php echo $data['ZBM FROM']??''; ?></td>
                                                <td><?php echo $data['ZBM TO']??''; ?></td>
                                                <td><?php echo $data['BU FROM']??''; ?></td>
                                                <td><?php echo $data['BU TO']??''; ?></td>
                                                <td><?php echo $data['HO']??''; ?></td>

                                            </tr>
                                            <?php
                                            $sn++;}}else{ ?>
                                            <tr>
                                                <td colspan="8">
                                                    <?php  echo 'NO DATA FOUND'; ?>
                                                </td>
                                            <tr>
                                        <?php
                                        }?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> 
                </div> 


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

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

<script src="assets/js/app.js"></script>


</body>

</html>