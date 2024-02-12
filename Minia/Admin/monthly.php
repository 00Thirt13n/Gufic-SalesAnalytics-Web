<?php 
    include 'layouts/session.php';
    include 'layouts/head-main.php';
    include "layouts/config.php";

    $start_date = date('Y-m-01'); // Default to first date of month
    $end_date = date('Y-m-d'); // Default to today's date

    include "Scripts/dashboard.php";
    $obj = new dashboardData('monthly');

    $data;
    if (isset($_GET['KAM']) && $_GET['KAM'] != "") {
        $emp_id = $_GET['KAM'];
        $data = $obj->GetData($link, $start_date, $end_date, $_GET['KAM']);
    } else if (isset($_GET['ABM']) && $_GET['ABM'] != "") {
        $emp_id = $_GET['ABM'];
        $data = $obj->GetData($link, $start_date, $end_date, $_GET['ABM']);
    } else if (isset($_GET['RBM']) && $_GET['RBM'] != "") {
        $emp_id = $_GET['RBM'];
        $data = $obj->GetData($link, $start_date, $end_date, $_GET['RBM']);
    } else if (isset($_GET['ZBM']) && $_GET['ZBM'] != "") {
        $emp_id = $_GET['ZBM'];
        $data = $obj->GetData($link, $start_date, $end_date, $_GET['ZBM']);
    } else {
        $emp_id = $_SESSION['user_id'];
        $data = $obj->GetData($link, $start_date, $end_date, $_SESSION['user_id']);
    }


    $order_count = $data[0];               if(!$order_count) $order_count=0;
    $order_value = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data[1]);         if(!$order_value) $order_value=0;
    $net_count = $data[2];                 if(!$net_count) $net_count=0;
    $net_value = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data[3]);         if(!$net_value) $net_value=0;
    $approved_count = $data[4];            if(!$approved_count) $approved_count=0;
    $approved_value = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data[5]);         if(!$approved_value) $approved_value=0;
    $pending_count = $data[6];             if(!$pending_count) $pending_count=0;
    $pending_value = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data[7]);         if(!$pending_value) $pending_value=0;
    $declined_count = $data[8];            if(!$declined_count) $declined_count=0;
    $declined_value = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $data[9]);         if(!$declined_value) $declined_value=0;

 
?>

<head>
    <title>Monthly Dashboard</title>

    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="image_src" href="assets/images/mediola/circle-logo.svg" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <meta name="twitter:image" property="og:image" content="assets/images/mediola/circle-logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
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
            /* line-height: 2.5; */
        }

        .card {
            border: 0px solid black;
        }

        .salesCard {
            margin-top: 15px;
        }
    </style>

</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper" class="card">

    <?php include 'layouts/menu.php'; ?>

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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Mediapp</a></li>
                                    <li class="breadcrumb-item active">Monthly Dashboard</li>
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

                                    <!--DAILY/MONTHLY/YEARLY TABS -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="index.php" role="tab">
                                                <span>Daily</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="monthly.php" role="tab">
                                                <spa>Monthly</span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link " href="yearly.php" role="tab">
                                                <span>Yearly</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Date Picker -->
                                    <div class="row salesCard mt-lg-4">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-4 ">
                                                    <div>
                                                        <div class="mb-3">
                                                            <label for="example-date-input" class="form-label">Start Date</label>
                                                            <input type="date" class="form-control" value=<?php echo $start_date ?> id="datepicker" name="start-date">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-4 ">
                                                    <div class=" mt-lg-0">
                                                        <div class="mb-3">
                                                            <label for="example-date-input" class="form-label">End Date</label>
                                                            <input type="date" class="form-control" value=<?php echo $end_date ?> id="datepicker1" name="end-date">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-4 ">
                                                    <div class=" mt-lg-0">
                                                        <div class="mb-3" style="margin-top: 1.8rem;">
                                                            <button type="submit" class="btn btn-primary" style="padding :10.9px 16.9px !important">Submit</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Dropdown layout for user selection -->
                                    <?php include 'layouts/dropdown1.php'; ?>

                                    <div class="row salesCard">
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Order Details </span>
                                    </div>
                                    <!-- CARDS -->
                                    <div class="row salesCard mt-lg-4">

                                        <div class="col-xl-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Hospital Order Booking</span>
                                                            <h2 class="mb-3 text-nowrap">
                                                                <span class="counter-value" data-target="<?php echo $order_count ?>"></span>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $order_value ?></span>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>


                                        <div class="col-xl-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Net Sales</span>
                                                            <h2 class="mb-3 text-nowrap">
                                                                <span class="counter-value" data-target="<?php echo  $net_count ?>"></span>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $net_value ?></span>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Collection</span>
                                                            <h2 class="mb-3 text-nowrap">
                                                                <span class="counter-value" data-target="0">0</span>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- CARDS -->
                                    <div class="row salesCard">
                                        <div class="col-xl-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block h5">Approved</span>
                                                            <h1 class="mb-3 text-nowrap">
                                                                <span class="counter-value " data-target="<?php echo $approved_count ?>">0</span>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $approved_value ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block h5 ">Pending</span>
                                                            <h1 class="mb-3 text-nowrap">
                                                                <span class="counter-value" data-target="<?php echo $pending_count ?>">0</span>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-warning text-warning total-badge"><span>&#8377</span><?php echo $pending_value ?></span>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>


                                        <div class="col-xl-4 col-md-4">
                                            <div class="d-flex card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body shadow-lg border rounded bg-soft-white">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <span class="text-muted mb-3 lh-1 d-block  h5">Declined</span>
                                                            <h1 class="mb-3 text-nowrap">
                                                                <span class="counter-value " data-target="<?php echo $declined_count ?>"></span>
                                                            </h1>
                                                        </div>
                                                    </div>
                                                    <div class="text-nowrap">
                                                        <span class="badge bg-soft-danger text-danger total-badge"><span>&#8377</span><?php echo $declined_value ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                <div id="total-target-achievement"></div>
                                <div id="target_achievement"></div>
                                <div id="top_bottom"></div>
                                <div id='datatable-result'></div>
                                <div id="loader">
                                    <?php include 'layouts/loader.php' ?>
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
<script>
    $(document).ready(function() {
        var table = $('#datatable-buttons').DataTable();

        $('#form').submit(function(event) {
            event.preventDefault();

            var startDate = $('#datepicker').val();
            var endDate = $('#datepicker1').val();
            // Reload the DataTable with the new date
            table.destroy(); // Destroy the existing DataTable instance
            table = $('#datatable-buttons').DataTable(); // Reinitialize DataTable

            return false;
        });

        get_total_target_achievement();
    });

    function get_total_target_achievement() {
        $.ajax({
            url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Total_Target_Achievement.php",
            data:{"start_date":"<?php echo $start_date ?>", "end_date":"<?php echo $end_date ?>", "emp_id":"<?php echo $emp_id ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                get_target_achievement();
            },
            success: function(data) {
                $("#total-target-achievement").append(data);
            },
            error: function() { }
        });
    }

    function get_target_achievement() {
        $.ajax({
            url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Target_Achievement.php",
            data:{"emp_id":"<?php echo $emp_id ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                get_top_bottom();
            },
            success: function(data) {
                $("#target_achievement").append(data);
            },
            error: function() { }
        });
    }

    function get_top_bottom() {
        $.ajax({
            url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Top_Bottom.php",
            data:{"start_date":"<?php echo $start_date ?>", "end_date":"<?php echo $end_date ?>", "emp_id":"<?php echo $emp_id ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                get_datatable_result();
            },
            success: function(data) {
                $("#top_bottom").append(data);
            },
            error: function() { }
        });
    }

    function get_datatable_result() {
        $.ajax({
            url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Datatable.php",
            data:{"start_date":"<?php echo $start_date ?>", "end_date":"<?php echo $end_date ?>", "emp_id":"<?php echo $emp_id ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                $("#loader-icon").hide();
            },
            success: function(data) {
                $("#datatable-result").append(data);
            },
            error: function() { alert('datatable error') }
        });
    }
</script>





</body>

</html>
