<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php require_once "layouts/config.php"; ?>
<?php
if (isset($_GET['KAM']) && $_GET['KAM'] != "") {
    // echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";
    $emp_id = $_GET['KAM'];
} else if (isset($_GET['ABM']) && $_GET['ABM'] != "") {
    // echo "<script>console.log('ABM : ".$_GET['ABM']."')</script>";
    $emp_id = $_GET['ABM'];
} else if (isset($_GET['RBM']) && $_GET['RBM'] != "") {
    // echo "<script>console.log('RBM : ".$_GET['RBM']."')</script>";
    $emp_id = $_GET['RBM'];
} else if (isset($_GET['ZBM']) && $_GET['ZBM'] != "") {
    // echo "<script>console.log('ZBM :  ".$_GET['ZBM']."')</script>";
    $emp_id = $_GET['ZBM'];
} else {
    // echo "<script>console.log(' user_id : ".$_SESSION['user_id']."')</script>";
    $emp_id = $_SESSION['user_id'];
}

// echo "<script>console.log('$emp_id')</script>";
?>

<head>

    <title>Target Report | Mediapp</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->
    <script src='https://cdn.plot.ly/plotly-2.24.1.min.js'></script>
    <style>
        .form-control-sm {
            padding: .5rem;
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


                <div class="row ">
                    <h4 class="card-title mb-0">Target - Achivement Report</h4>

                    <!-- <div class="row ">
                    <div class="col-xl-12">
                        <div class="card border">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Target - Achivement Report</h4> 
                            </div>
                            <div class="card-body">
                                <canvas id="speedChart" ></canvas>
                            </div>
                        </div>
                        <!- -end card- ->
                    </div>
                </div> -->





                    <!--DATA TABLE-->
                    <!-- <div class="row mt-4">
                        <div class="col-12">
                            <div class="card" style="border: none;">
                                <div class="card-body bgdark"  style="padding:0;">
                                    <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">                

                                    <thead>
                                        <tr>
                                            <?php /*
                                            $sql = "SELECT * FROM MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA";
                                            $result = $link->query($sql);
                                            // Fetch and display table headers
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                foreach ($row as $key => $value) {
                                                    echo "<th class='text-nowrap'>" . $key . "</th>";
                                                }
                                            }*/
                                            ?>
                                        </tr>
                                    </thead>
                                        
                                    <tbody>
                                        <?php /*
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
                                            }*/
                                        ?>              
                                    </tbody>                
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>  -->
                    <?php include 'layouts/dropdown1.php'; ?>

                    <div id='myDiv' style="overflow:auto;"><!-- Plotly chart will be drawn inside this DIV --></div>


                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th>
                                                <th>CODE</th> -->
                                                <th>EMPLOYEE</th>
                                                <th>YEAR</th>
                                                <th>MONTH</th>
                                                <th>AREA</th>
                                                <th>HQ</th>
                                                <th>TARGET</th>
                                                <th>ACHIEVEMENT</th>
                                                <th>PERCENTAGE</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <!-- PHP code to fetch and display data -->
                                            <?php

                                            $name_array = $target_array = $achievement_array = $value_percentage_array = [];
                                            // include "layouts/config.php";

                                            // Get the selected date value from the date picker input field
                                            // if (isset($_POST['start-date'])) {
                                            //     $start_date = $_POST['start-date'];
                                            // } else {
                                            //     $start_date = date('Y-m-01'); 
                                            // }
                                            // if (isset($_POST['end-date'])) {
                                            //     $end_date = $_POST['end-date'];
                                            // } else {
                                            //     $end_date = date('Y-m-d'); // Default to today's date
                                            // }
                                            // $emp_id =$_SESSION['user_id'];
                                            $sql =  "SELECT ID,CODE,EMPLOYEE,YEAR,MONTH,AREA,HQ,TARGET,ACHIEVEMENT FROM MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA 
                                                where (find_in_set(ID, ifnull((select GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id')))";


                                            $result = mysqli_query($link, $sql);
                                            ?>
                                            <?php
                                            if ($result) {
                                                $sn = 1;

                                                foreach ($result as $data) {
                                            ?>
                                                    <tr>
                                                        <?php
                                                        if ($data['MONTH'] == date('F')) {
                                                            array_push($name_array, $data['EMPLOYEE']);
                                                            array_push($target_array, $data['TARGET']);
                                                            array_push($achievement_array, $data['ACHIEVEMENT']);



                                                            $per = number_format(($data['ACHIEVEMENT'] * 100) / $data['TARGET'], 2);
                                                            if ($per == 'inf')
                                                                $per = 'NO TARGET';
                                                            else
                                                                $per .= "%";

                                                            echo "<script>console.log('" . $data['ACHIEVEMENT'] . "')</script>";
                                                            echo "<script>console.log('" . $data['TARGET'] . "')</script>";
                                                            array_push($value_percentage_array, strval($data['ACHIEVEMENT'] . '<br>' . $per));
                                                        }
                                                        ?>

                                                        <!-- <td><?php // echo $data['ID']??''; 
                                                                    ?></td>
                                                    <td><?php // echo $data['CODE']??''; 
                                                        ?></td> -->
                                                        <td><?php echo $data['EMPLOYEE'] ?? ''; ?></td>
                                                        <td><?php echo $data['YEAR'] ?? ''; ?></td>
                                                        <td><?php echo $data['MONTH'] ?? ''; ?></td>
                                                        <td><?php echo $data['AREA'] ?? ''; ?></td>
                                                        <td><?php echo $data['HQ'] ?? ''; ?></td>
                                                        <td><?php echo $data['TARGET'] ?? ''; ?></td>
                                                        <td><?php echo $data['ACHIEVEMENT'] ?? ''; ?></td>
                                                        <td><?php echo $per ?? ''; ?></td>



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

                    <?php // print(date('F')); 
                    ?>


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

<script>
    // var link = document.getElementsByClassName('modebar-container').[0];
    // link.style.display = 'none';

    var trace1 = {
        x: JSON.parse('<?= json_encode($name_array) ?>'),
        y: JSON.parse('<?= json_encode($target_array) ?>'),
        text: JSON.parse('<?= json_encode($target_array) ?>'),
        name: 'Target',
        type: 'bar',
        marker: {
            color: 'rgba(0,0,240,.6)',
        }
    };

    var trace2 = {
        x: JSON.parse('<?= json_encode($name_array) ?>'),
        y: JSON.parse('<?= json_encode($achievement_array) ?>'),

        text: JSON.parse('<?= json_encode($value_percentage_array) ?>'),

        marker: {
            color: 'rgba(0,240,0,.6)',
        },

        name: 'Achievement',
        type: 'bar'
    };

    var data = [trace1, trace2];

    var layout = {
        barmode: 'group'
    };

    Plotly.newPlot('myDiv', data, layout);
</script>

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
</script>
</body>

</html>