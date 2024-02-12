<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include "layouts/config.php"; ?>

<head>

    <title>Overall Sales | Mediola</title>
    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <!-- <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" /> -->

    <!-- Responsive datatable examples -->
    <!-- <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
 -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <?php include 'layouts/head-style.php'; ?>




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
                            <h4 class="mb-sm-0 font-size-18">Overall Sales Report</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item active">Overall Sales Report</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <form method="post">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Start Date</label>
                                    <!-- <input class="form-control" type="date" value="01/01/2023" id="start-date"> -->
                                    <input type="date" class="form-control" value=<?php echo date('Y-m-d') ?> id="datepicker" name="start-date">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class=" mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">End Date</label>
                                    <!-- <input class="form-control" type="date" value="" id="end-date"> -->
                                    <input type="date" class="form-control" value=<?php echo date('Y-m-d') ?> id="datepicker1" name="end-date">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class=" mt-lg-0">
                                <div class="mb-3" style="margin-top: 1.8rem;">
                                    <!-- <button type="button" class="btn btn-primary waves-effect waves-light fetch">Fetch</button> -->
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row mt-1">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="example13" class="table table-striped table-hover table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ORDER ID</th>
                                            <th>ORDER BY</th>
                                            <th>HQ</th>

                                            <th>APPROVER</th>
                                            <th>ORDER MONTH</th>
                                            <th>ORDER DATE</th>
                                            <th>APPROVED DATE</th>

                                            <th>PRODUCT</th>
                                            <th>CFA APPROVER STATUS</th>
                                            <th>ORDER APPROVER STATUS</th>
                                            <th>QUANTITY</th>
                                            <th>REQUESTED SPECIAL PRICE</th>

                                            <th>TOTAL PRICE</th>
                                            <th>PROD STATUS</th>
                                            <th>REASON</th>
                                            <th>HOSPITAL NAME</th>
                                            <th>HOSPITAL EMAIL</th>

                                            <th>MOBILE</th>
                                            <th>CONTACT PERSON</th>
                                            <th>BILLING PARTY</th>
                                            <th>HOSPITAL ADDRESS</th>
                                            <th>HOSPITAL CITY</th>

                                            <th>HOSPITAL PINCODE</th>
                                            <th>HOSPITAL STATE</th>
                                            <th>DRUG_LICENE_NO</th>
                                            <th>GST_NUMBER</th>
                                            <th>PAN_NUMBER</th>

                                            <th>CFA NAME</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                            if (isset($_POST['start-date'])) {
                                                $start_date = $_POST['start-date'];
                                            } else {
                                                $start_date = date('Y-m-d');
                                            }
                                            if (isset($_POST['end-date'])) {
                                                $end_date = $_POST['end-date'];
                                            } else {
                                                $end_date = date('Y-m-d'); // Default to today's date
                                            }

                                            $emp_id = $_SESSION['user_id'];

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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatable-buttons').DataTable();

        // Set the value of the date picker input field to the selected date
        $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>');
        $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>');


        // Refresh the datatable when the form is submitted
        $('form').submit(function() {
            table.ajax.reload();
            $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>'); // Set the value of the date picker input field to the selected date
            $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>'); // Set the value of the date picker input field to the selected date
            return false;
        });
    });

    $(document).ready(function() {
	$('#example13').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "overall_sales_temp.php"
	} );
} );

</script>

</body>

</html>

