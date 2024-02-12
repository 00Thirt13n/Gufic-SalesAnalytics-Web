<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php';
require_once "layouts/config.php";

$start_date = date('Y-m-d');
// $end_date =  $start_date; // Default to today's date
include "php/dashboard.php";
$obj = new dashboardData('daily');

if (isset($_REQUEST['start-date'])) {
    $start_date = $_REQUEST['start-date'];
}
$data;
if (isset($_GET['KAM']) && $_GET['KAM'] != "") {
    // echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";
    $emp_id = $_GET['KAM'];
    $data = $obj->GetData($link, $start_date, $start_date, $_GET['KAM']);
} else if (isset($_GET['ABM']) && $_GET['ABM'] != "") {
    // echo "<script>console.log('ABM : ".$_GET['ABM']."')</script>";
    $emp_id = $_GET['ABM'];
    $data = $obj->GetData($link, $start_date, $start_date, $_GET['ABM']);
} else if (isset($_GET['RBM']) && $_GET['RBM'] != "") {
    // echo "<script>console.log('RBM : ".$_GET['RBM']."')</script>";
    $emp_id = $_GET['RBM'];
    $data = $obj->GetData($link, $start_date, $start_date, $_GET['RBM']);
} else if (isset($_GET['ZBM']) && $_GET['ZBM'] != "") {
    // echo "<script>console.log('ZBM :  ".$_GET['ZBM']."')</script>";
    $emp_id = $_GET['ZBM'];
    $data = $obj->GetData($link, $start_date, $start_date, $_GET['ZBM']);
} else {
    // echo "<script>console.log(' user_id : ".$_SESSION['user_id']."')</script>";
    $emp_id = $_SESSION['user_id'];
    $data = $obj->GetData($link, $start_date, $start_date, $_SESSION['user_id']);
}

$order_count = $data[0];
if (!$order_count) $order_count = 0;
$order_value = $data[1];
if (!$order_value) $order_value = 0;
$net_count = $data[2];
if (!$net_count) $net_count = 0;
$net_value = $data[3];
if (!$net_value) $net_value = 0;
$approved_count = $data[4];
if (!$approved_count) $approved_count = 0;
$approved_value = $data[5];
if (!$approved_value) $approved_value = 0;
$pending_count = $data[6];
if (!$pending_count) $pending_count = 0;
$pending_value = $data[7];
if (!$pending_value) $pending_value = 0;
$declined_count = $data[8];
if (!$declined_count) $declined_count = 0;
$declined_value = $data[9];
if (!$declined_value) $declined_value = 0;

$target_value = $data[10];
if (!$target_value) $target_value = 0;
$achievement_val = $data[11];
if (!$achievement_val) $achievement_val = 0;
$ach_per = $data[12];
if (!$ach_per) $ach_per = 0;



?>





<head>
    <title>FTP Dashboard | Mediola </title>

    <?php include 'layouts/head.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-style.php'; ?>

    <link rel="image_src" href="assets/images/mediola/circle-logo.svg" />
    <meta name="twitter:image" property="og:image" content="assets/images/mediola/circle-logo.svg" />


    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- <link href="assets/css/datepicker.css" rel="stylesheet" type="text/css" /> -->


    <!-- CHART -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src='https://cdn.plot.ly/plotly-2.20.0.min.js'></script>


    <style>

        th {
            color: #495057;
            font-weight: 400;
        }

        .total-badge {
            font-size: 1.5em;
            font-weight: 500;
            line-height: 2;
        }

        .card {
            border: 0px solid black;
        }

        .salesCard {
            margin-top: 2rem;
        }

        .LightBlackColor {
            color: #495057;
            font-weight: 500;
        }

        .monthly-table,
        .yearly-table {
            display: block;
            max-width: -moz-fit-content;
            max-width: fit-content;
            margin: 0 auto;
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>


</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper" class="card">

    <?php include 'layouts/vertical-menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content bgdark">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">FTP Reports</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div class="row">
                    <div class="col-xl-12">
                        <div class="card my-0 bgdark">
                            <div class="card-body">
                                <div class="flex-wrap gap-4">

                                    
                                    <div class="row salesCard">
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">FTP Details</span>
                                    </div>
                                    <!-- CARDS -->
                                    <div class="row salesCard mt-lg-4">
                                        <!-- <div class="col-xl-3 col-md-6">
                                                    <div class="d-flex card card-h-100">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white">
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Target</span>
                                                                    <h2 class="mb-3">
                                                                        <span class="counter-value">10000
                                                                        </span>
                                                                    </h2>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div id="mini-chart1" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div>
                                                            </div>
                                                             <div class="text-nowrap">
                                                                <span class="badge bg-soft-success text-success">+200</span>
                                                                <span class="ms-1 text-muted font-size-13">last day</span>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div> -->


                                        <div class="col-lg-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block text-nowrap  h5">Net Sales</span>
                                                            <h2 class="mb-3 text-nowrap">
                                                                <span class="counter-value" data-target="<?php echo $order_count ?>"></span>
                                                            </h2>
                                                        </div>
                                                        <!-- <div class="col-6">
                                                                    <div id="mini-chart1" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $order_value ?></span>
                                                        <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>


                                        <div class="col-lg-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Out Standing</span>
                                                            <h2 class="mb-3 text-nowrap">
                                                                <span class="counter-value" data-target="<?php echo $net_count ?>"></span>
                                                            </h2>
                                                        </div>
                                                        <!-- <div class="col-6">
                                                                    <div id="mini-chart2" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $net_value ?></span>
                                                        <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Collection</span>
                                                            <h2 class="mb-3 text-nowrap">
                                                                <span class="counter-value" data-target="0"></span>
                                                            </h2>
                                                        </div>
                                                        <!-- <div class="col-6">
                                                                    <div id="mini-chart3" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span>0</span>
                                                        <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div><!--end flex-wrap-->
                            </div> <!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

            </div><!-- container-fluid -->
        </div><!-- End Page-content -->

    </div><!-- end main content-->
    <?php include 'layouts/footer.php'; ?>
</div><!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
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
