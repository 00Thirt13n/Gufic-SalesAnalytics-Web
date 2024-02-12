    <?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include "layouts/config.php"; ?>

<head>

    <title>Overall Sales | Mediola</title>
    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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


                <!-- <div class="row">
                    <div class="col-xl-6">

                        <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                            <i class="mdi mdi-alert-outline label-icon"></i><strong>Warning</strong> - Its today's data, Please select date accordingly!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                           
                    </div>
                </div> -->



                <form method="post">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Start Date</label>
                                    <!-- <input class="form-control" type="date" value="01/01/2023" id="start-date"> -->
                                    <input type="date" class="form-control" value=<?php echo date('Y-04-01') ?> id="datepicker" name="start-date">

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

                                <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive  nowrap w-100">
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
                                        <!-- PHP code to fetch and display data -->
                                        <?php
                                        include "layouts/config.php";

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

                                        $emp_id = $_SESSION['user_id'];

                                        $sql =  "SELECT `ORDER ID`, `ORDER BY`,`HQ`, `APPROVER`, `ORDER DATE`, `APPROVED DATE`, month, 
                                                            `PRODUCT`, `CFA APPROVER STATUS`, `ORDER APPROVER STATUS`,
                                                            `QUANTITY`, `REQUESTED SPECIAL PRICE`, `TOTAL PRICE`,
                                                            `PROD STATUS`, `REASON`, `HOSPITAL NAME`, `HOSPITAL EMAIL`,
                                                            `MOBILE`, `CONTACT PERSON`, `BILLING PARTY`, `HOSPITAL ADDRESS`,
                                                            `HOSPITAL CITY`, `HOSPITAL PINCODE`, `HOSPITAL STATE`, `DRUG_LICENE_NO`,
                                                            `GST_NUMBER`, `PAN_NUMBER`, `CFA NAME` FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA
                                                            where date(`ORDER DATE`)  between '$start_date' and '$end_date'
                                                            AND find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id')) ";


                                        $result = mysqli_query($link, $sql);
                                        ?>
                                        <?php
                                        if ($result) {
                                            $sn = 1;

                                            foreach ($result as $data) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $data['ORDER ID'] ?? ''; ?></td>
                                                    <td><?php echo $data['ORDER BY'] ?? ''; ?></td>
                                                    <td><?php echo $data['HQ'] ?? ''; ?></td>

                                                    <td><?php echo $data['APPROVER'] ?? ''; ?></td>
                                                    <td><?php echo $data['month'] ?? ''; ?></td>
                                                    <td><?php echo $data['ORDER DATE'] ?? ''; ?></td>
                                                    <td><?php echo $data['APPROVED DATE'] ?? ''; ?></td>


                                                    <td><?php echo $data['PRODUCT'] ?? ''; ?></td>
                                                    <td><?php echo $data['CFA APPROVER STATUS'] ?? ''; ?></td>
                                                    <td><?php echo $data['ORDER APPROVER STATUS'] ?? ''; ?></td>
                                                    <td><?php echo $data['QUANTITY'] ?? ''; ?></td>
                                                    <td><?php echo $data['REQUESTED SPECIAL PRICE'] ?? ''; ?></td>

                                                    <td><?php echo $data['TOTAL PRICE'] ?? ''; ?></td>
                                                    <td><?php echo $data['PROD STATUS'] ?? ''; ?></td>
                                                    <td><?php echo $data['REASON'] ?? ''; ?></td>
                                                    <td><?php echo $data['HOSPITAL NAME'] ?? ''; ?></td>
                                                    <td><?php echo $data['HOSPITAL EMAIL'] ?? ''; ?></td>

                                                    <td><?php echo $data['MOBILE'] ?? ''; ?></td>
                                                    <td><?php echo $data['CONTACT PERSON'] ?? ''; ?></td>
                                                    <td><?php echo $data['BILLING PARTY'] ?? ''; ?></td>
                                                    <td><?php echo $data['HOSPITAL ADDRESS'] ?? ''; ?></td>
                                                    <td><?php echo $data['HOSPITAL CITY'] ?? ''; ?></td>

                                                    <td><?php echo $data['HOSPITAL PINCODE'] ?? ''; ?></td>
                                                    <td><?php echo $data['HOSPITAL STATE'] ?? ''; ?></td>
                                                    <td><?php echo $data['DRUG_LICENE_NO'] ?? ''; ?></td>
                                                    <td><?php echo $data['GST_NUMBER'] ?? ''; ?></td>
                                                    <td><?php echo $data['PAN_NUMBER'] ?? ''; ?></td>

                                                    <td><?php echo $data['CFA NAME'] ?? ''; ?></td>


                                                </tr>
                                            <?php
                                                $sn++;
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="8">
                                                    <?php echo 'NO DATA FOUND'; ?>
                                                </td>
                                            <tr>
                                            <?php
                                        } ?>
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

<script>
    $(document).ready(function() {
        var table = $('#datatable-buttons').DataTable();

        // Set the value of the date picker input field to the selected date
        $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-04-01'); ?>');
        $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>');


        // Refresh the datatable when the form is submitted
        $('form').submit(function() {
            table.ajax.reload();
            $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-04-01'); ?>'); // Set the value of the date picker input field to the selected date
            $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>'); // Set the value of the date picker input field to the selected date
            return false;
        });
    });
</script>
</body>

</html>