<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include "layouts/config.php"; ?>


<head>

    <title>Leader Dashboard | Mediappp</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
    </style>

</head>
    
<?php
    session_start();
    $user_id = $_SESSION['user_id'];

    $start_date = date('Y-04-01'); // Default to first date of month
    $end_date = date('Y-m-d'); // Default to today's date

    if (strtotime($start_date) > strtotime($end_date)) {
        $start_date = date('Y-m-d', strtotime('-1 year', strtotime($start_date)));
    }


    if (isset($_REQUEST['start-date'])) {
        $start_date = $_REQUEST['start-date'];
    }
    if (isset($_REQUEST['end-date'])) {
        $end_date = $_REQUEST['end-date'];
    }


    $sql =" SELECT SUM(`TOTAL PRICE`) TOTAL FROM DashboardPOBData
            WHERE DATE(`ORDER DATE`) between '$start_date' and '$end_date' ";
    
    // echo $sql; die;
    $total;
    $result = mysqli_query($link, $sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $total = $row['TOTAL'];
    }


    $sql2 = "SELECT dpd.MEMP_ID, dpd.`ORDER BY` EMPLOYEE,dpd.HQ, SUM(dpd.`TOTAL PRICE`) TOTAL_SALES, 
            (SUM(dpd.`TOTAL PRICE`)*100/$total) PERCENTAGE 
            FROM DashboardPOBData as dpd
            inner join MILJON_EMPLOYEE as me on me.MEMPLOYEE_ID = dpd.MEMP_ID 
            WHERE DATE(dpd.`ORDER DATE`) between '$start_date' and '$end_date' 
            and me.H_ID = 'MEDM_13' GROUP BY dpd.`ORDER BY`,dpd.MEMP_ID,dpd.HQ ORDER BY PERCENTAGE desc";

    // echo $sql2; die;

    $result = mysqli_query($link, $sql2);

    $employeeArray = array();
    $salesArray = array();

?>


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
                            <h4 class="mb-sm-0 font-size-18">Leader Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Mediappp</a></li>
                                    <li class="breadcrumb-item active">Leader Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <!-- Date Picker -->
                <div class="col-8 mx-auto">
                    <form action="leader-dashboard.php" method="post" class="">
                        <div class="d-flex justify-content-between mb-4 ">
                            <div class="col-4 ">
                                <label for="example-date-input" class="form-label">Start Date</label>
                                <input type="date" class="form-control" value=<?php echo $start_date ?> id="datepicker" name="start-date">

                            </div>
                            <div class="col-4 mx-5">
                                <label for="example-date-input" class="form-label">End Date</label>
                                <input type="date" class="form-control" value=<?php echo $end_date ?> id="datepicker1" name="end-date">

                            </div>
                            <div class="col-4 " style="margin-top: 1.7rem; margin-right:0;">
                                <button type="submit" class="btn btn-primary" style="padding :8px 16px !important">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-10 col-lg-12 mx-auto">
                    <div class="card border ">
                        <div class="card-header bg-soft-success">
                            <h4 class='card-title'>Contribution</h4>
                        </div>
                        <div class="card-body table-container">
                            <div id="myPlot"></div>
                        </div>
                    </div>
                    <!--end card-->
                </div>



                <div class="row mt-2">
                    <div class="col-xl-8 col-lg-12 mx-auto">
                        <div class="card border">
                            <div class="card-header bg-soft-success">
                                <h4 class="card-title mb-0">Top Performers</h4>
                            </div>
                            <div class="card-body table-container">
                            <table id="datatable-buttons" class="table table-bordered nowrap w-200 overflow-x-scroll">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>NAME</th>
                                        <th>HQ</th>
                                        <th>SALES</th>
                                    </tr>
                                </thead>                                
                                <tbody>
                                    <?php                       
                                    $rank = 1;       
                                    foreach ($result as $data) {
                                    ?>
                                        <tr <?php if ($rank < 6) echo "class='bg-soft-success'"; ?> >
                                            <td><?php echo '#' . '' . $rank;  $rank++;?></td>
                                            <td>
                                                <?php
                                                    if ($rank <= 6) echo "<img src='assets/images/icons8-crown-65.png' alt='icon' width='35px'> ";
                                                    echo $data['EMPLOYEE'] ?? ''; array_push($employeeArray, $data['EMPLOYEE']); 
                                                ?>
                                            </td>
                                            <td><?php echo $data['HQ'] ?? ''; ?></td>
                                            <td><?php echo $data['TOTAL_SALES'] ?? ''; array_push($salesArray, $data['TOTAL_SALES']);?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!--end card-->
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
<!-- <script src="assets/js/pages/datatables.init.js"></script> -->

<script>
    const xArray = JSON.parse('<?= json_encode($employeeArray) ?>');
    const yArray = JSON.parse('<?= json_encode($salesArray) ?>');

    const layout = {
        title: "",
        width: "1000",
        height: "700",
        hovermode: 'closest',
    };

    const data = [{
        type: "pie",
        labels: xArray,
        values: yArray,
        automargin: true,
        hole: .4,
        
    }];

    Plotly.newPlot("myPlot", data, layout);

    // document.getElementsByClassName('main-svg')[0].setAttribute("height", "1000");
</script>

<script>
    $(document).ready(function() {


        // HIDING PYPLOT SITE ICON

        var elements = document.querySelectorAll('.modebar-group');

        if (elements.length >= 3) {
            elements[2].style.display = 'none';
        }

        // FOR SORT NET_SALES COLUMN, COMMENTED ABOVE DATATABLE.INIT.JS FILE

        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'colvis'],
            order: [[3, 'desc']],
            pageLength: 100 
                
        });
    
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        $(".dataTables_length select").addClass('form-select form-select-sm');


        // FOR DATATABLE REFRESH WITH DATE

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