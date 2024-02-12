<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include "layouts/config.php"; ?>


<?php
//echo(print_r($_REQUEST,true));

                 if(isset($_GET['KAM']) && $_GET['KAM']!="")
                 {
                    // echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";
                    $emp_id =$_GET['KAM'];
                    //  $data = $obj->GetData($link,$start_date,$start_date,$_GET['KAM']);
                 }else if(isset($_GET['ABM']) && $_GET['ABM']!="")
                 {
                    // echo "<script>console.log('ABM : ".$_GET['ABM']."')</script>";
                    $emp_id =$_GET['ABM'];
                    //  $data = $obj->GetData($link,$start_date,$start_date,$_GET['ABM']);
                 }
                 else if(isset($_GET['RBM']) && $_GET['RBM']!="")
                 {
                    // echo "<script>console.log('RBM : ".$_GET['RBM']."')</script>";
                    $emp_id =$_GET['RBM'];
                    //  $data = $obj->GetData($link,$start_date,$start_date,$_GET['RBM']);
                 }else if(isset($_GET['ZBM']) && $_GET['ZBM']!="")
                 {
                    // echo "<script>console.log('ZBM :  ".$_GET['ZBM']."')</script>";
                    $emp_id =$_GET['ZBM'];
                    // $data = $obj->GetData($link,$start_date,$start_date,$_GET['ZBM']);
                 }
                 else{
                    // echo "<script>console.log(' user_id : ".$_SESSION['user_id']."')</script>";
                    $emp_id =$_SESSION['user_id'];
                    // $data = $obj->GetData($link,$start_date,$start_date,$_SESSION['user_id']);
                 }

                        //  echo "<script>console.log('emp_id :  $emp_id  ')</script>";

?>

<head>

    <title>Product Wise Sales</title>
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
                            <h4 class="mb-sm-0 font-size-18">Product Wise Sales</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                                    <li class="breadcrumb-item active">Product Wise</li>
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
                                    <!-- <input class="form-control" type="date" value="01/01/2023" id="start-date"> -->
                                    <input type="date" class="form-control" value= <?php echo date('Y-04-01')?> id="datepicker" name="start-date">

                                </div>      
                            </div>
                        </div>      
                        <div class="col-lg-3 col-md-4 col-sm-4">
                            <div class=" mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">End Date</label>
                                    <!-- <input class="form-control" type="date" value="" id="end-date"> -->
                                    <input type="date" class="form-control" value= <?php echo date('Y-m-d')?> id="datepicker1" name="end-date">

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
                <?php include 'layouts/dropdown1.php'; ?>


            <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                            <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th>MRP</th>
                                            <th>BASE PRICE</th>
                                            <th>AVG PRICE</th>
                                            <th>QUANTITY</th>
                                            <th>TOTAL PRICE</th>
                                            <th>STATUS</th>
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

                                            $sql =  "SELECT distinct dpob.product,
                                                            sum(dpob.`QUANTITY`) quantity, 
                                                            amf.MRP as mrp, 
                                                            amf.`BASE PRICE` as base_price,
                                                            avg(dpob.`REQUESTED SPECIAL PRICE`) avg_price,
                                                            sum(dpob.`TOTAL PRICE`) total, 
                                                            dpob.`ORDER APPROVER STATUS` as status  
                                                            FROM MELJOHN_UPLOAD_SATISH.DashboardPOBData as dpob 
                                                            inner join approval_matrix_final as amf on dpob.product = amf.`Finalised Brand Name`
                                                            where date(`ORDER DATE`)  between '$start_date' and '$end_date'
                                                            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
                                                            group by dpob.`product` ,dpob.`ORDER APPROVER STATUS`,amf.`BASE PRICE`,amf.MRP ";


                                            $result = mysqli_query($link, $sql);
                                            ?>
                                        <?php
                                            if($result){      
                                            $sn=1;
                                            
                                            foreach($result as $data){
                                            ?>
                                            <tr>
                                                <td><?php echo $data['product']??''; ?></td>
                                                <td><?php echo $data['mrp']??''; ?></td>
                                                <td><?php echo $data['base_price']??''; ?></td>
                                                <td><?php echo round($data['avg_price'],2)??''; ?></td>
                                                <td><?php echo $data['quantity']??''; ?></td>
                                                <td><?php echo $data['total']??''; ?></td>
                                                <td><?php echo $data['status']??''; ?></td>
                                            </tr>
                                            <?php
                                            $sn++;}}else{ ?>
                                            <tr>
                                                <td colspan="8">
                                                    <?php  echo 'NO DATA FOUND'; ?>
                                                </td>
                                            <tr>
                                        <?php
                                        }?>
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
      $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>'); // Set the value of the date picker input field to the selected date
      $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>'); // Set the value of the date picker input field to the selected date
      return false;
    });
  });
</script>
</body>

</html>