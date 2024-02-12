<?php   
    include 'layouts/session.php';
    include 'layouts/head-main.php';   
    require_once "layouts/config.php";

    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
    $emp_id = isset($_GET['emp_id']) ? $_GET['emp_id'] : $_SESSION['user_id'];
    
?>



<head>
    <title>Daily Dashboard | Mediola </title>
    <link rel="image_src" href="assets/images/mediola/circle-logo.svg" />
    <link rel="shortcut icon" href="assets/images/mediola/circle-logo.svg">
    <link href="assets/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
    
    <meta name="twitter:image" property="og:image" content="assets/images/mediola/circle-logo.svg" />

    <script src='https://cdn.plot.ly/plotly-2.20.0.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


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

        .card{border:none}

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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Mediapp</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->



                

        <!--DAILY/MONTHLY/YEARLY TABS -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active" href="index2.php">
                    <span>Daily</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="monthly2.php">
                    <spa>Monthly</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="yearly.php">
                    <span>Yearly</span>
                </a>
            </li>
        </ul>   
        
        <div id="start-date"></div>
        <div id="user-dropdown"></div>
        <div id="order-details"></div>
        <div id="target_achievement"></div>
        <div id="top_bottom"></div>
        
        <!--DATA TABLE-->
        <!-- <div> -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body bgdark">
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
                                    
                                    $sql = "SELECT `ORDER ID`, `ORDER BY`, `APPROVER`,`ORDER APPROVER STATUS`, `ORDER DATE`,`MONTH`,
                                            `PRODUCT`, `QUANTITY`, `REQUESTED SPECIAL PRICE`,
                                            `TOTAL PRICE`, `HOSPITAL NAME`, `CFA NAME` FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`) = '$start_date'
                                            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
                                            ;";
                                    $stmt = mysqli_query($link, $sql);  
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
                    </div>
                </div>
            </div>
        <!-- </div> -->
                              
                               
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

<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<script>
    $(document).ready(function() {

        $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>');
        $('form').submit(function() {
            // table.ajax.reload();
            $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>');
            return false;
        });
    });
</script>

<script>
    // console.log('<?php // echo $emp_id; ?>');
    get_start_date();
    function get_start_date() {
        $.ajax({
            url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Start_Date.php",
            data:{"start_date":"<?php echo $start_date ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                get_dropdown();
            },
            success: function(data) {
                // console.log(data);
                $("#start-date").append(data);
            },
            error: function(data) {console.log(data); }
        });
    }


    function get_dropdown() {
        $.ajax({
            url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Dropdown.php",
            data:{"emp_id":"<?php echo $emp_id ?>", "start_date":"<?php echo $start_date ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                get_order_details();
            },
            success: function(data) {
                $("#user-dropdown").append(data);
            },
            error: function() { }
        });
    }




    function get_order_details() {
        $.ajax({
            url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Order_Details.php",
            data:{"start_date":"<?php echo $start_date ?>", "emp_id":"<?php echo $emp_id ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                get_target_achievement();
            },
            success: function(data) {
                $("#order-details").append(data);
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
            data:{"start_date":"<?php echo $start_date ?>", "emp_id":"<?php echo $emp_id ?>"},
            type: "POST",
            beforeSend: function() {
               
            },
            complete: function() {
                // get_datatable();
            },
            success: function(data) {
                $("#top_bottom").append(data);
            },
            error: function() { }
        });
    }


    
</script>


</body>

</html>
