<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include "layouts/config.php"; ?>



<head>

    <title>Leader Dashboard | Mediappp</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>




    <?php 
    $start_date = date('Y-m-01'); // Default to first date of month
    $end_date = date('Y-m-d'); // Default to today's date

    $total = 0;
    $sql0 = "SELECT SUM(`TOTAL PRICE`) TOTAL FROM DashboardPOBData";
    $products = mysqli_query($link, $sql0);
    while ($row = $products->fetch_array(MYSQLI_ASSOC)) {
        $total = $row['TOTAL'];
     }


     $employeeArray = Array();
     $salesArray = Array();


    $sql1 = "SELECT MEMP_ID, `ORDER BY` EMPLOYEE, HQ  FROM DashboardPOBData limit 900";
    
    $result =$link -> query($sql1);


    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($employeeArray, $row['EMPLOYEE']);
        array_push($salesArray, rand(1, 20));
    }
     
    
    ?>






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

<?php 
// echo $sql1; 

// while($row = $result -> fetch_assoc()){
//     echo $row['MEMP_ID'];
// }
?>
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
                                <input type="date" class="form-control" value= <?php echo $start_date?> id="datepicker" name="start-date">              
                                
                            </div>      
                            <div class="col-4 mx-5">
                                <label for="example-date-input" class="form-label">End Date</label>
                                <input type="date" class="form-control" value= <?php echo $end_date ?> id="datepicker1" name="end-date">             
                                    
                            </div>
                            <div class="col-4 " style="margin-top: 1.7rem; margin-right:0;">
                                <button type="submit" class="btn btn-primary"  style="padding :8px 16px !important">Submit</button>                  
                            </div>
                        </div>
                    </form>
                </div>
                    <div class="col-8 mx-auto">
                        <div class="card border">
                            <div class="card-header bg-soft-success">
                                <h4 class='card-title'>Contribution</h4> 
                            </div>
                            <div class="card-body">
                                <div id="myPlot" ></div> 
                            </div>
                        </div>
                        <!--end card-->
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
const xArray = JSON.parse('<?=json_encode($employeeArray)?>');
const yArray = JSON.parse('<?=json_encode($salesArray)?>');

const layout = {title:""};

const data = [{labels:xArray, values:yArray, hole:.4, type:"pie"}];

Plotly.newPlot("myPlot", data, layout);

document.getElementsByClassName('main-svg')[0].setAttribute("height", "750");
</script>
</body>

</html>