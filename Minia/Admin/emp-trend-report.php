<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php require_once "layouts/config.php"; ?>

<?php 
if(isset($_GET['KAM']) && $_GET['KAM']!="")
   $emp_id =$_GET['KAM'];
    
else if(isset($_GET['ABM']) && $_GET['ABM']!="")
   $emp_id =$_GET['ABM'];
    
else if(isset($_GET['RBM']) && $_GET['RBM']!="")
    $emp_id =$_GET['RBM'];

else if(isset($_GET['ZBM']) && $_GET['ZBM']!="") 
   $emp_id =$_GET['ZBM'];
   
else
   $emp_id =$_SESSION['user_id'];


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

    if (strtotime($start_date) > strtotime($end_date)) {
        $start_date = date('Y-m-d', strtotime('-1 year', strtotime($start_date)));
    }

?>

<head>

    <title>Employee Trend Report | Mediapp</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
                            <h4 class="mb-sm-0 font-size-18">Employee Trend Report</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item active">Employee Trend Report</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <form method="post">
                    <div class="row" >
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" value= <?php echo $start_date?> id="datepicker" name="start-date">

                                </div>      
                            </div>
                        </div>      
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class=" mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">End Date</label>
                                    <input type="date" class="form-control" value= <?php echo $end_date?> id="datepicker1" name="end-date">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class=" mt-lg-0">
                                <div class="mb-3" style="margin-top: 1.8rem;">
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <?php include 'layouts/dropdown1.php'; ?>




                    <!--DATA TABLE-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card" style="border: none;">
                                <div class="card-body bgdark"  style="padding:0;">
                                    <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">                

                                    <thead>
                                        <tr>
                                            <?php

                                            

                                          
                                            // $sql = "SELECT `ORDER BY`,  MONTH, `TOTAL ACHIEVEMENT` FROM MELJOHN_UPLOAD_SATISH.EMPLOYEE_TREND_DATA where (find_in_set(MEMP_ID, ifnull((select GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id')))";
                                            $sql = "call GET_EMPLOYEE_TREND_DATA('$emp_id','$start_date','$end_date')";
                                            // echo $sql; die();
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
                                            }else echo "<img src='assets/images/no_data_found.jpg' width='650px' alt='NO DATA FOUND' class='center'>";
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



<script>
  $(document).ready(function() {
    var table = $('#datatable-buttons').DataTable();
    
    // Set the value of the date picker input field to the selected date
    $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-04-01'); ?>');
    $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>');


    // Refresh the datatable when the form is submitted
    $('form').submit(function() {
      table.ajax.reload();
      $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>'); // Set the value of the date picker input field to the selected date
      $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>'); // Set the value of the date picker input field to the selected date
      return false;
    });
  });

</body>

</html>