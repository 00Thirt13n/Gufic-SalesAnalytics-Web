<?php 
    include '../layouts/session.php';
    require_once "../layouts/config.php";

    $start_date = date('Y-m-d');
    include "../php/dashboard.php";
    $obj = new dashboardData('daily');

    if (isset($_REQUEST['start-date'])) {
        $start_date = $_REQUEST['start-date'];
    }
    $data;
    if (isset($_GET['KAM']) && $_GET['KAM'] != "") {
        $emp_id = $_GET['KAM'];
        $data = $obj->GetData($link, $start_date, $start_date, $_GET['KAM']);
    } else if (isset($_GET['ABM']) && $_GET['ABM'] != "") {
        $emp_id = $_GET['ABM'];
        $data = $obj->GetData($link, $start_date, $start_date, $_GET['ABM']);
    } else if (isset($_GET['RBM']) && $_GET['RBM'] != "") {
        $emp_id = $_GET['RBM'];
        $data = $obj->GetData($link, $start_date, $start_date, $_GET['RBM']);
    } else if (isset($_GET['ZBM']) && $_GET['ZBM'] != "") {
        $emp_id = $_GET['ZBM'];
        $data = $obj->GetData($link, $start_date, $start_date, $_GET['ZBM']);
    } else {
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

<div class="row salesCard">
    <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Order Details</span>
</div>

<div class="row salesCard mt-lg-4">
    <div class="col-lg-4 col-md-4">
        <div class="d-flex card card-h-100">
            <!-- card body -->
            <div class="card-body shadow-lg border rounded bg-soft-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap  h5">Hospital Order Booking</span>
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
    <div class="col-lg-4 col-md-4">
        <div class="d-flex card card-h-100">
            <!-- card body -->
            <div class="card-body shadow-lg border rounded bg-soft-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Net Sales</span>
                        <h2 class="mb-3 text-nowrap">
                            <span class="counter-value" data-target="<?php echo $net_count ?>"></span>
                        </h2>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $net_value ?></span>
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
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span>0</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row salesCard">
    <div class="col-xl-4 col-md-4">
        <div class="d-flex card card-h-100">
            <div class="card-body shadow-lg border rounded bg-soft-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Approved <span class="bx bx-check-circle "></span></span>
                        <h1 class="mb-3 text-nowrap">
                            <span class="counter-value" data-target="<?php echo $approved_count ?>"></span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Pending<span class="bx bx-time-five px-2"></span></span>
                        <h1 class="mb-3 text-nowrap">
                            <span class="counter-value" data-target="<?php echo $pending_count ?>"></span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Declined <span class=" bx bx-error-circle "></span></span>
                        <h1 class="mb-3 text-nowrap">
                            <span class="counter-value " data-target="<?php echo $declined_count ?>"></span>
                        </h1>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-soft-danger text-danger total-badge"><span>&#8377</span><?php echo $declined_value ?></span>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
</div>

<div class="row salesCard">
    <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Target & Achievement </span>
</div>
<div class="row salesCard">
    <div class="col-xl-4 col-md-4">
        <div class="d-flex card card-h-100">
            <div class="card-body shadow-lg border rounded bg-soft-white">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Target</span>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-soft-primary text-primary total-badge"><span>&#8377</span><?php echo $target_value ?></span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Achievement</span>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $achievement_val ?></span>
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
                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Achievement Percentage</span>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="badge bg-soft-warning text-warning total-badge"><?php echo $ach_per ?><span>&#x00025</span></span>
                </div>
            </div><!-- end card body -->
        </div>
    </div>
</div>