<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
$target = 619;
$achivement = 463;
$remaining = 156;

$current_runrate = 40;
$required_runrate = 58;
$incentive_runrate = 80;

$remaining_days = 14;

$total_achivement = 2390;

$incentive_target = 619;
$incentive_achivement = 463;
$incentive_remaining = 156;

$value_wise_incentive = 2032.01;
$product_wise_incentive = 4102.38;
$total_incentive = 6134.39;


?>

<head>

    <title>Incentive-Dashboard | Mediola</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <!-- <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> -->
    <script src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

    <style>
        #chart-container1 {
            position: relative;
            height: 40vh;
            overflow: hidden;
        }

        #chart-container2 {
            position: relative;
            height: 40vh;
            overflow: hidden;
        }

        #chart-container3 {
            position: relative;
            height: 40vh;
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
                            <h4 class="mb-sm-0 font-size-18">Incentive-Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Incentive</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <?php include 'layouts/incentive-dropdown.php'; ?>




                <!-- CARDS -->
                <div class="row salesCard mt-lg-4">

                    <div class="col-lg-4 col-md-4">
                        <div class="d-flex card card-h-100">
                            <!-- card body -->
                            <div class="card-body shadow-lg border rounded bg-soft-white">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap  h5">Target</span>
                                        <h1 class="mb-3 text-nowrap">
                                            <span class="counter-value text-primary" style="padding:30%; font-size:60px;" data-target="<?php echo $target; ?>"></span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success total-badge"><?php   ?></span>
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
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Achivement</span>
                                        <h1 class="mb-3 text-nowrap">
                                            <span class="counter-value text-primary" style="padding:30%; font-size:60px;" data-target="<?php echo $achivement; ?>"></span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success total-badge"><?php  ?></span>
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
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Remaining</span>
                                        <h1 class="mb-3 text-nowrap">
                                            <span class="counter-value text-primary" style="padding:30%; font-size:60px;" data-target="<?php echo $remaining; ?>"></span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success total-badge"><?php  ?></span>
                                    <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- CARDS RUN RATE-->
                <div class="row salesCard mt-lg-4">

                    <div class="col-lg-8 col-md-12">
                        <div class="d-flex card card-h-100">
                            <!-- card body -->
                            <div class="card-body shadow-lg border rounded bg-soft-white">
                                <div class="row align-items-center">
                                    <div class="col-12 ">
                                        <span class="text-muted text-center mb-3 lh-1 d-block text-nowrap h4">Run rate</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- card -->
                                            <div class="card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body">

                                                    <div class="row align-items-center">
                                                        <div class="col-sm">
                                                            <div id="chart-container1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- card -->
                                            <div class="card card-h-100">
                                                <!-- card body -->
                                                <div class="card-body">

                                                    <div class="row align-items-center">
                                                        <div class="col-sm">
                                                            <div id="chart-container2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>


                    <div class="col-lg-4 col-md-12">
                        <div class="d-flex card card-h-100">
                            <!-- card body -->
                            <div class="card-body shadow-lg border rounded bg-soft-white">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">No. of Days</span>
                                        <h1 class="text-nowrap m-auto" style="padding:34%; font-size:100px;">
                                            <span class="counter-value text-primary" data-target="<?php echo $remaining_days; ?>"></span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success total-badge"><?php  ?></span>
                                    <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div>

                </div>


                <div class="row salesCard mt-lg-4">

                    <div class="col-lg-10 col-md-12 mx-auto">
                        <div class="d-flex card card-h-100">
                            <!-- card body -->
                            <div class="card-body shadow-lg border rounded bg-primary bg-gradient">
                                <div class="row align-items-center">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row align-items-center">
                                                <div class="col-sm h3 text-white text-center">
                                                    <span>Total Achivements</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row align-items-center">
                                                <div class="col-sm h3 text-white text-center">
                                                    <span class="bx bx-rupee"></span>
                                                    <span class="counter-value" data-target="<?php echo $total_achivement; ?>"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>

                </div>


                <!-- CARDS INCENTIVE-->
                <div class="row salesCard mt-lg-4">

                    <div class="col-lg-4 col-md-4">
                        <div class="d-flex card card-h-100">
                            <!-- card body -->
                            <div class="card-body shadow-lg border rounded bg-soft-white">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap  h5">Incentive Target</span>
                                        <h1 class="mb-3 text-nowrap">
                                            <span class="counter-value text-primary" style="padding:30%; font-size:60px;" data-target="<?php echo $incentive_target; ?>"></span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success total-badge"><?php   ?></span>
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
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Incentive Achivement</span>
                                        <h1 class="mb-3 text-nowrap">
                                            <span class="counter-value text-primary" style="padding:30%; font-size:60px;" data-target="<?php echo $incentive_achivement; ?>"></span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success total-badge"><?php  ?></span>
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
                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Incentive Remaining</span>
                                        <h1 class="mb-3 text-nowrap">
                                            <span class="counter-value text-primary" style="padding:30%; font-size:60px;" data-target="<?php echo $incentive_remaining; ?>"></span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success total-badge"><?php  ?></span>
                                    <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>







                <div class="row">
                    <div class="col-lg-8">
                        <!-- card -->
                        <div class="card card-h-150">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="card-title me-2">Total Incentive Amount</h5>
                                    <!-- <div class="ms-auto">
                                        <select class="form-select form-select-sm">
                                            <option value="MAY" selected="">May</option>
                                            <option value="AP">April</option>
                                            <option value="MA">March</option>
                                            <option value="FE">February</option>
                                            <option value="JA">January</option>
                                            <option value="DE">December</option>
                                        </select>
                                    </div> -->
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div id="chart-container3"></div>
                                    </div>
                                    <div class="col-lg-4 align-self-center">
                                        <div class="mt-4 mt-sm-0">
                                            <p class="mb-1">Total Earned</p>
                                            <h4><?php echo $total_incentive ?></h4>
                                            <!-- <p class="text-muted mb-4"> + 0.0012.23 ( 0.2 % ) <i class="mdi mdi-arrow-up ms-1 text-success"></i></p>                 -->
                                            <div class="row g-0">
                                                <div class="col-lg-6">
                                                    <div>
                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Value Wise</p>
                                                        <h5 class="fw-medium"><?php echo $value_wise_incentive ?></h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div>
                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Product Wise</p>
                                                        <h5 class="fw-medium"><?php echo $product_wise_incentive ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="#" class="btn btn-primary btn-sm">View more <i class="mdi mdi-arrow-right ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
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






<script>
    // gauge chart1
    var dom = document.getElementById('chart-container1');
    var myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    var app = {};

    var option;

    option = {
        tooltip: {
            formatter: '{a} <br/>{b} : {c}%'
        },
        series: [{
            name: 'Pressure',
            type: 'gauge',
            progress: {
                show: true
            },
            detail: {
                valueAnimation: true,
                formatter: '{value}'
            },
            data: [{
                value: <?php echo $current_runrate; ?>,
                name: 'Current'
            }]
        }]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>



<script>
    // gauge chart2
    var dom = document.getElementById('chart-container2');
    var myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    var app = {};

    var option;

    option = {
        tooltip: {
            formatter: '{a} <br/>{b} : {c}%'
        },
        series: [{
            name: 'Pressure',
            type: 'gauge',
            progress: {
                show: true
            },
            detail: {
                valueAnimation: true,
                formatter: '{value}'
            },
            data: [{
                value: <?php echo $required_runrate; ?>,
                name: 'Required'
            }]
        }]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>


<script>
    // gauge chart3
    var dom = document.getElementById('chart-container3');
    var myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    var app = {};

    var option;

    option = {
        tooltip: {
            formatter: '{a} <br/>{b} : {c}%'
        },
        series: [{
            name: 'Pressure',
            type: 'gauge',
            progress: {
                show: true
            },
            detail: {
                valueAnimation: true,
                formatter: '{value}'
            },
            data: [{
                value: <?php echo $incentive_runrate; ?>,
                name: 'run rate'
            }]
        }]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>

</body>

</html>