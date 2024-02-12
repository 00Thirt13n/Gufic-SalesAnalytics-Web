<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php require_once "layouts/config.php"; ?>

<?php 
if(isset($_GET['KAM']) && $_GET['KAM']!="")
{
   // echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";
   $emp_id =$_GET['KAM'];
    
}else if(isset($_GET['ABM']) && $_GET['ABM']!="")
{
   // echo "<script>console.log('ABM : ".$_GET['ABM']."')</script>";
   $emp_id =$_GET['ABM'];
    
}
else if(isset($_GET['RBM']) && $_GET['RBM']!="")
{
   // echo "<script>console.log('RBM : ".$_GET['RBM']."')</script>";
   $emp_id =$_GET['RBM'];

}else if(isset($_GET['ZBM']) && $_GET['ZBM']!="")
{
   // echo "<script>console.log('ZBM :  ".$_GET['ZBM']."')</script>";
   $emp_id =$_GET['ZBM'];
   
}
else{
   // echo "<script>console.log(' user_id : ".$_SESSION['user_id']."')</script>";
   $emp_id =$_SESSION['user_id'];
}

// echo "<script>console.log('$emp_id')</script>";
?>

<?php 
$CFA = "<script>document.getElementById('AllCFA').value</script>";
?>


<head>

    <title> CFA Trend Report | Mediapp</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
                            <h4 class="mb-sm-0 font-size-18">CFA Trend Report</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item active">CFA Trend Report</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <?php //include 'layouts/trend2_dropdown.php'?>

                <!-- <div class="row">
                    <div class="col-xl-12">
                        <div class="card border">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Product report</h4> 
                            </div>
                            <div class="card-body">
                                <canvas id="speedChart" ></canvas>
                            </div>
                        </div>
                        <! --end card -- >
                    </div>
                </div> -->


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



                <?php include 'layouts/cfa_dropdown.php'; 
                
                $data = $obj->GetCFA($link,'', $emp_id);
                ?>




                    <!--DATA TABLE-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card" style="border: none;">
                                <div class="card-body bgdark"  style="padding:0;">
                                    <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">                

                                    <thead>
                                        <tr>
                                            <?php
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

                                            // $sql = "SELECT * FROM MELJOHN_UPLOAD_SATISH.CFA_TREND_DATA ";
                                            $cfa = $_GET['CFA'];
                                            $sql = "call GET_CFA_TREND_DATA('$cfa','$emp_id','$start_date','$end_date');";

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
  console.clear();
</script>


<script>
var speedCanvas = document.getElementById("speedChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var dataFirst = {
    label: "Product 1",
    data: [0, 59, 75, 20, 20, 55, 40],
    lineTension: 0,
    fill: false,
    borderColor: 'red'
  };

var dataSecond = {
    label: "Product 2",
    data: [0, 15, 60, 60, 65, 30, 70],
    lineTension: 0,
    fill: false,
  borderColor: 'blue'
  };

  var data3 = {
    label: "Product 3",
    data: [0, 9, 25, 20, 30, 45, 40],
    lineTension: 0,
    fill: false,
    borderColor: 'puple'
  };

var data4 = {
    label: "Product 4",
    data: [0, 15, 50, 40, 45, 50, 60],
    lineTension: 0,
    fill: false,
  borderColor: 'pink'
  };

  var data5 = {
    label: "Product 5",
    data: [0, 29, 35, 40, 30, 35, 40],
    lineTension: 0,
    fill: false,
    borderColor: 'green'
  };

var data6 = {
    label: "Product 6",
    data: [0, 25, 40, 50, 55, 50, 60],
    lineTension: 0,
    fill: false,
    borderColor: 'yellow'
  };

var speedData = {
  labels: ["Nov", "Dec", "Jan", "Fab", "March", "April", "May"],
  datasets: [dataFirst, dataSecond, data3, data4, data5, data6]
};

var chartOptions = {
  legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
  }
};

var lineChart = new Chart(speedCanvas, {
  type: 'line',
  data: speedData,
  options: chartOptions
});
</script>

</body>

</html>