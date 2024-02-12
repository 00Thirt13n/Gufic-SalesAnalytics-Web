<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php require_once "layouts/config.php"; ?>

<head>

    <title>FTP Outstanding | Mediapp</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <style>
        .form-control-sm{
            padding: .5rem;
        }

        .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        }


        #chart-container {
        position: relative;
        height: 100vh;
        overflow: hidden;
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
                            <h4 class="mb-sm-0 font-size-18">FTP Outstanding</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">FTP Reports</a></li>
                                    <li class="breadcrumb-item active">Outstanding</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                    <!--DATA TABLE-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card" style="border: none;">
                                <div class="card-body bgdark"  style="padding:0;">
                                    <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">                

                                    <thead>
                                        <tr>
                                            <?php
                                            // Get the selected date value from the date picker input field
                                            if (isset($_POST['start-date'])) {
                                                $start_date = $_POST['start-date'];
                                            } else {
                                                $start_date = date('Y-04-01'); 
                                            }
                                            if (isset($_POST['end-date'])) {
                                                $end_date = $_POST['end-date'];
                                            } else {
                                                $end_date = date('Y-m-d'); // Default to today's date
                                            }
                                            
                                            // $sql = "SELECT PRODUCT, MONTH, TOTAL FROM MELJOHN_UPLOAD_SATISH.PRODUCT_TREND_DATA where (find_in_set(MEMP_ID, ifnull((select GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))) GROUP BY PRODUCT, MONTH order by month(str_to_date(MONTH, '%M')) desc";
                                            $sql = "call GET_PRODUCT_TREND_DATA('$emp_id','$start_date','$end_date')";
                                            // echo $sql;
                                            $result = $link->query($sql);
                                            // Fetch and display table headers
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                foreach ($row as $key => $value) {
                                                    echo "<th class='text-nowrap'>" . $key . "</th>";
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                        
                                    <tbody>
                                        <?php
                                            // Fetch and display table rows
                                            if ($result->num_rows > 0) {
                                                // Rewind the result set to the beginning
                                                $result->data_seek(0);              
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    foreach ($row as $value) {
                                                        echo "<td>" . $value . "</td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                            }
                                            else echo "<img src='assets/images/no_data_found.jpg' width='650px' alt='NO DATA FOUND' class='center'>";
                                        ?>              
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

<script src="assets/js/app.js"></script>
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

</body>

</html>