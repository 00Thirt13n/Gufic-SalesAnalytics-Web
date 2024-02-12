<?php 
    include 'layouts/session.php'; 
    include 'layouts/head-main.php'; 
    include "layouts/config.php"; 

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
    
    if (isset($_REQUEST['start-date'])) { $start_date = $_REQUEST['start-date']; }else{$start_date = date('Y-04-01');}
    if (isset($_REQUEST['end-date'])) { $end_date = $_REQUEST['end-date']; } else{$end_date = date('Y-m-d');}
?>

<head>

    <title>Average Sales | Mediola</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <style>
        .form-control-sm{
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

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Average Sales Report</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item active">Average Sales</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <?php include 'layouts/avg_sales_dropdown.php'; ?>

                <!-- Date Picker -->
                <div class="row salesCard mt-lg-4">
                    <form method="post">
                        <div class="row" >

                            <div class="col-lg-3 col-md-3 col-sm-2 ">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" value= <?php echo $start_date?> id="datepicker" name="start-date">

                                    </div>      
                                </div>
                            </div>      
                            <div class="col-lg-3 col-md-3 col-sm-2 ">
                                <div class=" mt-lg-0">
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">End Date</label>
                                        <input type="date" class="form-control" value= <?php echo $end_date?> id="datepicker1" name="end-date">

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-2 ">
                                <div class=" mt-lg-0">
                                    <div class="mb-3" style="margin-top: 1.8rem;">
                                        <button type="submit" class="btn btn-primary"  style="padding :8px 16px !important">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                
                <!--DATA TABLE-->
                <div class="row mt-5 mx-2">
                    <div class="col-12">
                        <div class="card" style="border: none;">
                            <div class="card-body bgdark"  style="padding:0;">
                                <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT NAME</th>
                                            <th>QUANTITY</th>
                                            <th>AVERAGE PRICE</th>
                                            <th>MRP</th>
                                            <th>BASE PRICE</th>
                                            <th>TOTAL PRICE</th>
                                        </tr>
                                    </thead>                    
                                    <tbody>
                                            <?php
                                                $product_id = $_GET['product_id'] ;
                                                $cfa_id = $_GET['cfa_id'] ;
                                                $hq_id = $_GET['hq_id'] ;
                                                $hosp_id = $_GET['hosp_id'] ;
                                                $sql = "CALL GET_AVERAGE_PRICE_SOLD_FOR_BRANDS('TYPE', '$product_id', '$cfa_id', '$hq_id', '$emp_id', '$hosp_id','$start_date','$end_date')";
                                             
                                                
                                                $result = mysqli_query($link, $sql);

                                                foreach($result as $data){
                                                    ?>
                                                     <tr >
                                                         <td><?php echo $data['PROD_NAME']??''; ?></td>
                                                         <td><?php echo $data['QUANTITY']??''; ?></td>
                                                         <td><?php echo $data['AVG_PRICE']??''; ?></td>
                                                         <td><?php echo $data['MRP']??''; ?></td>
                                                         <td><?php echo $data['BASE_PRICE']??''; ?></td>
                                                         <td><?php echo $data['TOTAL_PRICE']??''; ?></td>
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
</script>
</body>

</html>