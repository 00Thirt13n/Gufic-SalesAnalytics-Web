<?php include 'layouts/session.php';?>
<?php include 'layouts/head-main.php'; 
require_once "layouts/config.php";
?>

<?php 
  
        $start_date = date('Y-01-01'); // Default to first date of month
        $end_date = date('Y-m-d'); // Default to today's date

        include "php/dashboard.php";
            $obj = new dashboardData('yearly');

            $data = $obj->GetData($link,$start_date,$end_date);

            $order_count = $data[0];
            $order_value = $data[1]; 
            $net_count = $data[2]; 
            $net_value = $data[3]; 
            $approved_count = $data[4];
            $approved_value = $data[5];
            $pending_count = $data[6]; 
            $pending_value = $data[7]; 
            $declined_count = $data[8]; 
            $declined_value = $data[9];

        




              // Top performer          


            $total = 0;
            $sql = " SELECT round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL  FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) between '$start_date' and '$end_date' ";

            $products = mysqli_query($link, $sql);
            while ($row = $products->fetch_array(MYSQLI_ASSOC)) {
                 $top_product_result = $row['APPROVED_TOTAL'];
                //  echo "<script>console.log('".print_r($row['APPROVED_TOTAL'], true)."')</script>";
              }

            

            //top 10 

            $sql8 = "SELECT DISTINCT `PRODUCT` PRODUCT, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            group by `PRODUCT`
            order by round(sum(`TOTAL PRICE`),2) desc limit 10";
            $top5_yearly_products = mysqli_query($link, $sql8);

            $sql9 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            group by `HOSPITAL NAME`,`HOSPITAL ADDRESS`
            order by round(sum(`TOTAL PRICE`),2) desc limit 10";
            $top5_yearly_hospitals = mysqli_query($link, $sql9);

            $sql10 = "SELECT DISTINCT `HOSPITAL CITY` CITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) between '$start_date' and '$end_date'
            group by `HOSPITAL CITY`
            order by round(sum(`TOTAL PRICE`),2) desc limit 10";
            $top5_yearly_area = mysqli_query($link, $sql10);



              // BOTTOM 10 
            $sql11 = "SELECT DISTINCT `PRODUCT` PRODUCT, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) between '$start_date' and '$end_date'
            group by `PRODUCT`
            order by round(sum(`TOTAL PRICE`),2) asc limit 10";
            $bottom10_yearly_products = mysqli_query($link, $sql11);

            $sql12 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            group by `HOSPITAL NAME`,`HOSPITAL ADDRESS`
            order by round(sum(`TOTAL PRICE`),2) asc limit 10";
            $bottom10_yearly_hospitals = mysqli_query($link, $sql12);

            $sql13 = "SELECT DISTINCT `HOSPITAL CITY` CITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            group by `HOSPITAL CITY`
            order by round(sum(`TOTAL PRICE`),2) asc limit 10";
            $bottom10_yearly_area = mysqli_query($link, $sql13);
      
            

?>

<head>
    <title><?php echo $language["Dashboard"]; ?> | Mediola </title>

    <?php include 'layouts/head.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    
    <?php include 'layouts/head-style.php'; ?>

    <link rel="image_src" href="assets/images/mediola/circle-logo.svg" />
    <meta name="twitter:image" property="og:image" content="assets/images/mediola/circle-logo.svg" />


    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/datepicker.css" rel="stylesheet" type="text/css" />






    <style>
        /* .bgdark, .previous, .page-link, .buttons-html5, .buttons-colvis{
            background-color:#f9f9f9;
        }

        .dt-buttons, .dataTables_filter{
            margin-top: 1rem;
        }
        .buttons-copy, .buttons-excel, .buttons-pdf, .buttons-colvis, .buttons-columnVisibility{
            float: left;
            flex: end;
            margin: .25rem .5rem;
            padding : .5rem 1rem;
            border-radius: 3px;
        }
        .buttons-copy, .buttons-colvis{margin-left :0;}
        .buttons-pdf{margin-right: 1rem;}

        .buttons-html5, .buttons-colvis{
            color: #495057;
            border: 1px solid lightgray;
        } */

        /* .filter{
            margin-top:2rem;
            line-height: 1.8;
        } */

        th{
            color: #495057;
            font-weight: 400;
        }

        .total-badge{
            font-size: 1.5em;
            font-weight: 500;
            line-height: 2;
        } 
        
        .card{
            border : 0px solid black;
        }

        .salesCard{
            margin-top : 15px;
        }

        .LightBlackColor{
            color: #495057;
            font-weight: 500;
        }
        .monthly-table, .yearly-table{
            display: block;
            max-width: -moz-fit-content;
            max-width: fit-content;
            margin: 0 auto;
            overflow-x: auto;
            white-space: nowrap;
        }
        
        
    </style>

    
</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper" class="card">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content bgdark">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Mediapp</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div class="row">
                    <div class="col-xl-12">
                        <div class="card my-0 bgdark">
                            <div class="card-body">
                                <div class="flex-wrap gap-4">

                                <!--DAILY/MONTHLY/YEARLY TABS -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item ">
                                            <a class="nav-link"  href="index.php" role="tab" >
                                                <span>Daily</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link "  href="monthly.php" role="tab" >
                                                <spa>Monthly</span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link active" href="yearly.php" role="tab" >
                                                <span>Yearly</span>
                                            </a>
                                        </li>
                                    </ul>

                                            <div class="row salesCard mt-lg-4">
                                                <form method="post">
                                                    <div class="row" >
                                                        <div class="col-md-3 col-lg-2">
                                                            <div>
                                                                <div class="mb-3">
                                                                    <label for="example-date-input" class="form-label">Start Date</label>
                                                                    <!-- <input class="form-control" type="date" value="01/01/2023" id="start-date"> -->
                                                                    <input type="date" class="form-control" value= <?php echo date('Y-m-d')?> id="datepicker" name="start-date">

                                                                </div>      
                                                            </div>
                                                        </div>      
                                                        <div class="col-md-3 col-lg-2">
                                                            <div class=" mt-lg-0">
                                                                <div class="mb-3">
                                                                    <label for="example-date-input" class="form-label">End Date</label>
                                                                    <!-- <input class="form-control" type="date" value="" id="end-date"> -->
                                                                    <input type="date" class="form-control" value= <?php echo date('Y-m-d')?> id="datepicker1" name="end-date">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-2">
                                                            <div class=" mt-lg-0">
                                                                <div class="mb-3" style="margin-top: 1.8rem;">
                                                                    <!-- <button type="button" class="btn btn-primary waves-effect waves-light fetch">Fetch</button> -->
                                                                    <button type="submit" class="btn btn-primary"  style="padding :10.9px 16.9px !important">Submit</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div id="user-data">
                                                <?php  include 'layouts/dropdown1.php'; ?>
                                                <?php  //include 'layouts/dropdown_test.php'; ?>

                                            </div>


                                            <!-- CARDS -->
                                            <div class="row salesCard mt-lg-4">
                                                <!-- <div class="col-xl-3 col-md-6">
                                                    <div class="d-flex card card-h-100">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white">
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Target</span>
                                                                    <h2 class="mb-3">
                                                                        <span class="counter-value" data-target="865000">0</span>
                                                                    </h2>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div id="mini-chart1" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div>
                                                            </div>
                                                            <div class="text-nowrap">
                                                                <span class="badge bg-soft-success text-success">+2000</span>
                                                                <span class="ms-1 text-muted font-size-13">last day</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
            
                                                
                                                <div class="col-xl-4 col-md-4">
                                                    <div class="d-flex card card-h-100">
                                                        <!-- card body -->
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" >
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <span class="text-muted mb-3 lh-1 d-block  h5">Hospital Order Bookings</span>
                                                                    <h2 class="mb-3 text-nowrap">
                                                                        <span class="counter-value" data-target="<?php echo $order_count + 36 ?>"></span>
                                                                        <!-- <span class="counter-value" data-target="1099"></span>  -->
                                                                    </h2>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div id="mini-chart1" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div>
                                                            </div>
                                                            <div class="text-nowrap">
                                                                <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $order_value ?></span>
                                                                <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div><!-- end card -->
                                                </div>
            
                                                
                                                <div class="col-xl-4 col-md-4">
                                                    <div class="d-flex card card-h-100">
                                                        <!-- card body -->
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" >
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <span class="text-muted mb-3 lh-1 d-block  h5">Net Sales</span>
                                                                    <h2 class="mb-3 text-nowrap">
                                                                        <span class="counter-value" data-target="<?php echo $net_count; ?>"></span>
                                                                    </h2>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div id="mini-chart2" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div>
                                                            </div>
                                                            <div class="text-nowrap">
                                                                <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $net_value ?></span>
                                                                <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4">
                                                    <div class="d-flex card card-h-100">
                                                        <!-- card body -->
                                                        <div class="card-body shadow-lg border rounded bg-soft-white">
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <span class="text-muted mb-3 lh-1 d-block text-truncate h5">Collection</span>
                                                                    <h2 class="mb-3">
                                                                        <span class="counter-value" data-target="0"></span>
                                                                    </h2>
                                                                </div>
                                                                <div class="col-6 text-nowrap">
                                                                    <div id="mini-chart3" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div>
                                                            </div>
                                                            <div class="text-nowrap">
                                                                <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span></span>
                                                                <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <!-- CARDS -->
                                            <div class="row salesCard">
                                                <div class="col-xl-4 col-md-4">
                                                    <div class="d-flex card card-h-100">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white">
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <span class="text-muted mb-3 lh-1 d-block text-truncate h5">Approved</span>
                                                                    <h1 class="mb-3 text-nowrap">
                                                                        <span class="counter-value" data-target="<?php echo $approved_count ?>"></span>
                                                                    </h1>
                                                                </div>
                                                                <!-- <div class="col-6">
                                                                    <div id="mini-chart5" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
                                                            </div>
                                                            <div class="text-nowrap">
                                                                <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $approved_value ?></span>
                                                                <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
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
                                                                    <span class="text-muted mb-3 lh-1 d-block text-truncate h5">Pending</span>
                                                                    <h1 class="mb-3 text-nowrap">
                                                                        <span class="counter-value" data-target="<?php echo $pending_count ?>">0</span>
                                                                    </h1>
                                                                </div>
                                                                <!-- <div class="col-6">
                                                                    <div id="mini-chart6" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
                                                            </div>
                                                            <div class="text-nowrap">
                                                                <span class="badge bg-soft-warning text-warning total-badge"><span>&#8377</span><?php echo $pending_value ?></span>
                                                                <!-- <span class="ms-1 text-muted font-size-13">last Day</span> -->
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
                                                                    <span class="text-muted mb-3 lh-1 d-block text-truncate h5">Declined</span>
                                                                    <h1 class="mb-3 text-nowrap">
                                                                        <span class="counter-value " data-target="<?php echo $declined_count ?>"></span>
                                                                    </h1>
                                                                </div>
                                                                <!-- <div class="col-6">
                                                                    <div id="mini-chart7" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
                                                            </div>
                                                            <div class="text-nowrap">
                                                                <span class="badge bg-soft-danger text-danger total-badge"><span>&#8377</span><?php echo $declined_value ?></span>
                                                                <!-- <span class="ms-1 text-muted font-size-13">last day</span> -->
                                                            </div>
                                                        </div><!-- end card body -->
                                                    </div>
                                                </div>
                                            </div>
                                             

                                            <?php include 'layouts/chart-yearly.php'; ?>

                                            <!--DATA TABLE-->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">

                                                            <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">
                                                            <thead>
                                                                    <tr>
                                                                        <th>ORDER ID</th>
                                                                        <th>ORDER BY</th>
                                                                        <th>APPROVER</th>
                                                                        <th>ORDER DATE</th>
                                                                        <!-- <th>APPROVED DATE</th> -->
                                                                        <th>PRODUCT</th>
                                                                        <!-- <th>CFA APPROVER STATUS</th> -->
                                                                        <!-- <th>ORDER APPROVER STATUS</th> -->
                                                                        <th>QUANTITY</th>
                                                                        <th>REQUESTED SPECIAL PRICE</th>
                                                                        <th>TOTAL PRICE</th>
                                                                        <!-- <th>PROD STATUS</th>
                                                                        <th>REASON</th> -->
                                                                        <th>HOSPITAL NAME</th>
                                                                        <!-- <th>HOSPITAL EMAIL</th>
                                                                        <th>MOBILE</th>
                                                                        <th>CONTACT PERSON</th>
                                                                        <th>BILLING PARTY</th>
                                                                        <th>HOSPITAL ADDRESS</th>
                                                                        <th>HOSPITAL CITY</th>
                                                                        <th>HOSPITAL PINCODE</th>
                                                                        <th>HOSPITAL STATE</th>
                                                                        <th>DRUG_LICENE_NO</th>
                                                                        <th>GST_NUMBER</th>
                                                                        <th>PAN_NUMBER</th> -->
                                                                        <th>CFA NAME</th>
                                                                    </tr>
                                                                </thead>


                                                                <tbody>
                                                                        <?php
                                                                            $sql = "SELECT `ORDER ID`, `ORDER BY`, `APPROVER`, `ORDER DATE`,
                                                                                            `PRODUCT`, `QUANTITY`, `REQUESTED SPECIAL PRICE`,
                                                                                            `TOTAL PRICE`, `HOSPITAL NAME`, `CFA NAME` FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) between '$start_date' and '$end_date';";
                                                                            $stmt = mysqli_query($link, $sql);

                                                                            foreach($stmt as $data){
                                                                                ?>
                                                                                 <tr >
                                                                                     <td><?php echo $data['ORDER ID']??''; ?></td>
                                                                                     <td><?php echo $data['ORDER BY']??''; ?></td>
                                                                                     <td><?php echo $data['APPROVER']??''; ?></td>
                                                                                     <td><?php echo $data['ORDER DATE']??''; ?></td>
                                                                                     <td><?php echo $data['PRODUCT']??''; ?></td>
                                                                                     <td><?php echo $data['QUANTITY']??''; ?></td>
                                                                                     <td><?php echo $data['REQUESTED SPECIAL PRICE']??''; ?></td>
                                                                                     <td><?php echo $data['TOTAL PRICE']??''; ?></td>
                                                                                     <td><?php echo $data['HOSPITAL NAME']??''; ?></td>
                                                                                     <td><?php echo $data['CFA NAME']??''; ?></td>
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
  


                                    

                                    
                                </div><!--end flex-wrap-->
                            </div> <!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->

            </div><!-- container-fluid -->
        </div><!-- End Page-content -->

    </div><!-- end main content-->
    <?php include 'layouts/footer.php'; ?>
</div><!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
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