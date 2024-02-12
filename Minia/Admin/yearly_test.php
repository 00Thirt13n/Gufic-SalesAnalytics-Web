<?php include 'layouts/session.php';?>
<?php include 'layouts/head-main.php'; 
require_once "layouts/config.php";
?>

<?php 
  
        $start_date = date('Y-01-01'); // Default to first date of month
        $end_date = date('Y-m-d'); // Default to today's date

        include "php/dashboard_new.php";
            $obj = new dashboardData('yearly');

            // TO PRINT DATES
        // echo "<script>console.log('------------------------------------------')</script>";
        // echo "<script>console.log('$start_date')</script>";
        // echo "<script>console.log('$end_date')</script>";
        // echo "<script>console.log('------------------------------------------')</script>";


            $data;
            /*
            if(isset($_GET['KAM']))
            {
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['KAM']);
            }else if(isset($_GET['ABM']))
            {
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['ABM']);
            }
            else if(isset($_GET['RBM']))
            {
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['RBM']);
            }else if(isset($_GET['ZBM']))
            {
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['ZBM']);
            }
            else{
                $data = $obj->GetData($link,$start_date,$end_date,$_SESSION['user_id']);
            }
            */
            if(isset($_GET['KAM']) && $_GET['KAM']!=""){
                $emp_id =$_GET['KAM'];
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['KAM']);
            }
            else if(isset($_GET['ABM']) && $_GET['ABM']!=""){
                $emp_id =$_GET['ABM'];
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['ABM']);
            }
            else if(isset($_GET['RBM']) && $_GET['RBM']!=""){
                $emp_id =$_GET['RBM'];
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['RBM']);
            }
            else if(isset($_GET['ZBM']) && $_GET['ZBM']!=""){
                $emp_id =$_GET['ZBM'];
                $data = $obj->GetData($link,$start_date,$end_date,$_GET['ZBM']);
            }
            else{                  
                $emp_id =$_SESSION['user_id'];
                $data = $obj->GetData($link,$start_date,$end_date,$_SESSION['user_id']);
            }
            die();

                $order_count = $data[0];               if(!$order_count) $order_count=0;
                $order_value = $data[1];               if(!$order_value) $order_value=0;
                $net_count = $data[2];                 if(!$net_count) $net_count=0;
                $net_value = $data[3];                 if(!$net_value) $net_value=0;
                $approved_count = $data[4];            if(!$approved_count) $approved_count=0;
                $approved_value = $data[5];            if(!$approved_value) $approved_value=0;
                $pending_count = $data[6];             if(!$pending_count) $pending_count=0;
                $pending_value = $data[7];             if(!$pending_value) $pending_value=0;
                $declined_count = $data[8];            if(!$declined_count) $declined_count=0;
                $declined_value = $data[9];            if(!$declined_value) $declined_value=0;

                $target_value = $data[10];             if(!$target_value) $target_value=0;
                $achievement_val = $data[11];          if(!$achievement_val) $achievement_val=0;
                $ach_per = $data[12];                  if(!$ach_per) $ach_per=0;

            // echo $order_count,'order_count',
            // $order_value ,
            // $net_count ,
            // $net_value,
            // $approved_count ,
            // $approved_value,
            // $pending_count ,
            // $pending_value,
            // $declined_count ,
            // $declined_value;die;




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

            $sql8 = "SELECT DISTINCT `PRODUCT` PRODUCT, SUM(QUANTITY) QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
            group by `PRODUCT`
            order by round(sum(`TOTAL PRICE`),2) desc limit 10";
            $top5_yearly_products = mysqli_query($link, $sql8);


                $top_products = mysqli_query($link, $sql8);
                $top_products_name = array(); 
                $top_products_per = array();
                
                $total_per=0; $i=5;
                if($top_products)
                while ($row = $top_products->fetch_array(MYSQLI_ASSOC)) {
                    if($i==0) break; else $i--;
                    array_push($top_products_name, strtoupper(strtok($row['PRODUCT'], " ") ));
                    array_push($top_products_per, $row['PERCENTAGE']);
                    $total_per +=$row['PERCENTAGE'];
                }
                array_push($top_products_name, 'OTHER');
                array_push($top_products_per, 100-$total_per);



            $sql9 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
            group by `HOSPITAL NAME`,`HOSPITAL ADDRESS`
            order by round(sum(`TOTAL PRICE`),2) desc limit 10";
            $top5_yearly_hospitals = mysqli_query($link, $sql9);


            $top_hospitals = mysqli_query($link, $sql9);
                $top_hospitals_name = array(); 
                $top_hospitals_per = array();

                $total_hospital_per=0; $i=5;
                if($top_hospitals)
                while ($row = $top_hospitals->fetch_array(MYSQLI_ASSOC)) {
                    if($i==0) break; else $i--;
                    array_push($top_hospitals_name, strtoupper(strtok($row['HOSPITAL'], " ")));
                    array_push($top_hospitals_per, $row['PERCENTAGE']);
                    $total_hospital_per +=$row['PERCENTAGE'];
                }
                array_push($top_hospitals_name, 'OTHER');
                array_push($top_hospitals_per, 100-$total_hospital_per);


            $sql10 = "SELECT DISTINCT `HOSPITAL CITY` CITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
            group by `HOSPITAL CITY`
            order by round(sum(`TOTAL PRICE`),2) desc limit 10";
            $top5_yearly_area = mysqli_query($link, $sql10);



              // BOTTOM 10 
            $sql11 = "SELECT DISTINCT `PRODUCT` PRODUCT,SUM(QUANTITY) QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
            group by `PRODUCT`
            order by round(sum(`TOTAL PRICE`),2) asc limit 10";
            $bottom10_yearly_products = mysqli_query($link, $sql11);

            $sql12 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
            group by `HOSPITAL NAME`,`HOSPITAL ADDRESS`
            order by round(sum(`TOTAL PRICE`),2) asc limit 10";
            $bottom10_yearly_hospitals = mysqli_query($link, $sql12);

            $sql13 = "SELECT DISTINCT `HOSPITAL CITY` CITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
            where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)  between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
            group by `HOSPITAL CITY`
            order by round(sum(`TOTAL PRICE`),2) asc limit 10";
            $bottom10_yearly_area = mysqli_query($link, $sql13);
      
            


            //for bar chart

            $achivements = array();

            $sql14 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`)between date('20230401') and date('20240401')
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('MEMP_G_13'), ('MEMP_G_13')))
               ";
            $result14 = mysqli_query($link, $sql14);
            while ($row = $result14->fetch_array(MYSQLI_ASSOC)) {
                $Deepak_Singh = $row['APPROVED_TOTAL'];
            }
            if($Deepak_Singh == null) $Deepak_Singh ='0';
            
            array_push($achivements, $Deepak_Singh);

            $sql15 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`)between date('20230401') and date('20240401')
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('MEMP_G_12'), ('MEMP_G_12')))
               ";
            $result15 = mysqli_query($link, $sql15);
            while ($row = $result15->fetch_array(MYSQLI_ASSOC)) {
                $Jasvinder_Singh = $row['APPROVED_TOTAL'];
            }
            array_push($achivements, $Jasvinder_Singh);

            $sql16 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`)between date('20230401') and date('20240401')
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('MEMP_G_30'), ('MEMP_G_30')))
               ";
            $result16 = mysqli_query($link, $sql16);
            while ($row = $result16->fetch_array(MYSQLI_ASSOC)) {
                $Shailender_Raghuwanshi = $row['APPROVED_TOTAL'];
            }
            array_push($achivements, $Shailender_Raghuwanshi);

            $sql17 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`)between date('20230401') and date('20240401')
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('MEMP_G_14'), ('MEMP_G_14')))
               ";
            $result17 = mysqli_query($link, $sql17);
            while ($row = $result17->fetch_array(MYSQLI_ASSOC)) {
                $Umesh_Sehgal = $row['APPROVED_TOTAL'];
            }
            // echo "<script>console.log('$Deepak_Singh')</script>";
            array_push($achivements, $Umesh_Sehgal);

            $sql18 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`)between date('20230401') and date('20240401')
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('MEMP_G_24'), ('MEMP_G_24')))
               ";
            $result18 = mysqli_query($link, $sql18);
            while ($row = $result18->fetch_array(MYSQLI_ASSOC)) {
                $Ved_Pathak = $row['APPROVED_TOTAL'];
            }
            array_push($achivements, $Ved_Pathak);


            $sql19 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`)between date('20230401') and date('20240401')
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('MEMP_G_15'), ('MEMP_G_15')))
               ";
            $result19 = mysqli_query($link, $sql19);
            while ($row = $result19->fetch_array(MYSQLI_ASSOC)) {
                $Yogesh_Lokwani = $row['APPROVED_TOTAL'];
            }
            array_push($achivements, $Yogesh_Lokwani);



            

            //TARGET VS ACHIEVEMENT GRAPH

            $name_array = $target_array = $achievement_array = $percentage_array= [];

            $sql =  "SELECT ID,CODE,EMPLOYEE,YEAR,MONTH,AREA,HQ,TARGET,ACHIEVEMENT FROM MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA 
            where (find_in_set(ID, ifnull((select GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id')))";

            $result = mysqli_query($link, $sql);

            if($result){      
            $sn=1;
            
            foreach($result as $data){
            ?>
            <tr>
                <?php
                    // if($data['MONTH'] == date('F')){
                        array_push($name_array, $data['EMPLOYEE']);
                        array_push($target_array, $data['TARGET']); 
                        array_push($achievement_array, $data['ACHIEVEMENT']);
                        $per = number_format(($data['ACHIEVEMENT'] * 100)/ $data['TARGET'], 2);
                        $per .= "%";
                        array_push($percentage_array, strval($per)); 
                    // }
                ?>
            </tr>
            <?php }} 


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


    <!-- CHART -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src='https://cdn.plot.ly/plotly-2.20.0.min.js'></script>




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
                                                        <div class="col-lg-3 col-md-3 col-sm-4 ">
                                                            <div>
                                                                <div class="mb-3">
                                                                    <label for="example-date-input" class="form-label">Start Date</label>
                                                                    <!-- <input class="form-control" type="date" value="01/01/2023" id="start-date"> -->
                                                                    <input type="date" class="form-control" value= <?php echo date('Y-m-d')?> id="datepicker" name="start-date">

                                                                </div>      
                                                            </div>
                                                        </div>      
                                                        <div class="col-lg-3 col-md-3 col-sm-4 ">
                                                            <div class=" mt-lg-0">
                                                                <div class="mb-3">
                                                                    <label for="example-date-input" class="form-label">End Date</label>
                                                                    <!-- <input class="form-control" type="date" value="" id="end-date"> -->
                                                                    <input type="date" class="form-control" value= <?php echo date('Y-m-d')?> id="datepicker1" name="end-date">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-4 ">
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

                                            <div class="row salesCard">
                                                <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Order Details </span>
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
                                                                        <span class="counter-value" data-target="<?php echo $order_count?>"></span>
                                                                        <!-- <span class="counter-value" data-target="1099"></span>  -->
                                                                    </h2>
                                                                </div>
                                                                <!-- <div class="col-6">
                                                                    <div id="mini-chart1" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
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
                                                                <!-- <div class="col-6">
                                                                    <div id="mini-chart2" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
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
                                                                <!-- <div class="col-6 text-nowrap">
                                                                    <div id="mini-chart3" data-colors='["#0077ff"]' class="apex-charts mb-2"></div>
                                                                </div> -->
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
                                            <div class="row salesCard">
                                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Target & Achivement </span>
                                            </div>
                                                <div class="row salesCard">

                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="d-flex card card-h-100">
                                                            <div class="card-body shadow-lg border rounded bg-soft-white">
                                                                <div class="row align-items-center">
                                                                    <div class="col-6">
                                                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Target</span>
                                                                    </div>
                                                                </div>
                                                                <div class="text-nowrap">
                                                                    <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo $target_value ?></span>
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
                                                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Acchievement</span>
                                                                    </div>
                                                                </div>
                                                                <div class="text-nowrap">
                                                                    <span class="badge bg-soft-warning text-warning total-badge"><span>&#8377</span><?php echo $achievement_val ?></span>
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
                                                                        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Achievement Percentage </span>
                                                                    </div>
                                                                </div>
                                                                <div class="text-nowrap">
                                                                    <span class="badge bg-soft-danger text-danger total-badge"><?php echo $ach_per ?><span>&#x00025</span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            <!-- TARGET VS ACHIEVEMENT BAR GRAPH -->
                                            <div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>

                                             

                                            <!--  CHARTS -->
                                           
                                          <div class="row mt-5">
                                                <div class="col-xl-6">
                                                    <div class="card border">
                                                        <div class="card-header">
                                                            <h4 class="card-title mb-0">TOP PROUCTS</h4>
                                                        </div>
                                                        <div class="card-body" >
                                                        <canvas id="myChart2" ></canvas>
                                                        </div>
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="card border">
                                                        <div class="card-header">
                                                            <h4 class="card-title mb-0">TOP HOSPITALS</h4>
                                                        </div>
                                                        <div class="card-body" >
                                                        <canvas id="myChart3"></canvas>
                                                        </div>
                                                    </div>
                                                    <!--end card-->
                                                </div>
                                            </div>

                                            <!-- <div class="row ">
                                                <div class="col-xl-12">
                                                    <div class="card border">
                                                        <div class="card-header">
                                                            <h4 class="card-title mb-0">Yearly Target Bar Graph</h4> 
                                                        </div>
                                                        <div class="card-body">
                                                            <div id='myDiv'><div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <!--COLLAPSEABLE TABEL TOP 10-->                        
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="card ">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                                                            <div class="accordion accordion-flush" id="accordionFlushExample7">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="flush-headingOne7">
                                                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne7" aria-expanded="true" aria-controls="flush-collapseOne7">
                                                                            Top 10 Performing Products
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapseOne7" class="accordion-collapse collapse " aria-labelledby="flush-headingOne7" data-bs-parent="#accordionFlushExample7">
                                                                        <div class="accordion-body text-muted" style="padding:0;">
                                                                                <table class="table align-middle mb-0 bg-white border">
                                                                                    <thead class="bg-light">
                                                                                        <tr>
                                                                                        <th>Product Name</th>
                                                                                        <th>Quantity</th>
                                                                                        <th>% of Sales / Total</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody style="background-color:#f9f9f9;">

                                                                                        <?php
                                                                                            if($top5_yearly_products)
                                                                                                while ($row = $top5_yearly_products->fetch_array(MYSQLI_ASSOC)) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td class="col-3">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <div class="ms-3">
                                                                                                            <p class="fw-bold mb-1">
                                                                                                                <?php
                                                                                                                    echo $row['PRODUCT'];
                                                                                                                ?>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['QUANTITY'] ?></p>
                                                                                                </td>
                                                                                            
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end accordion -->
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div><!-- end col -->

                                                <div class="col-xl-4">
                                                    <div class="card">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                                                            <div class="accordion accordion-flush" id="accordionFlushExample8">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="flush-headingOne8">
                                                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne8" aria-expanded="true" aria-controls="flush-collapseOne8">
                                                                            Top 10 Performing HQ
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapseOne8" class="accordion-collapse collapse " aria-labelledby="flush-headingOne8" data-bs-parent="#accordionFlushExample8">
                                                                        <div class="accordion-body text-muted" style="padding:0;">
                                                                                <table class="table align-middle mb-0 bg-white border">
                                                                                    <thead class="bg-light ">
                                                                                        <tr>
                                                                                        <th>HQ Name</th>
                                                                                        <th>% of Sales / Total</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody style="background-color:#f9f9f9;">

                                                                                        <?php
                                                                                            if($top5_yearly_area)
                                                                                                while ($row = $top5_yearly_area->fetch_array(MYSQLI_ASSOC)) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td class="col-3">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <div class="ms-3">
                                                                                                            <p class="fw-bold mb-1">
                                                                                                                <?php
                                                                                                                    echo $row['CITY'];
                                                                                                                ?>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        } ?>
                                                                                        </tbody>
                                                                                </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end accordion -->
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div><!-- end col -->


                                                <div class="col-xl-4">
                                                    <div class="card">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                                                            <div class="accordion accordion-flush" id="accordionFlushExample9">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="flush-headingOne9">
                                                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne9" aria-expanded="true" aria-controls="flush-collapseOne9">
                                                                            Top 10 Performing Hospitals
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapseOne9" class="accordion-collapse collapse" aria-labelledby="flush-headingOne9" data-bs-parent="#accordionFlushExample9">
                                                                        <div class="accordion-body text-muted" style="padding:0;">
                                                                                <table class="table align-middle mb-0 bg-white border">
                                                                                    <thead class="bg-light">
                                                                                        <tr>
                                                                                        <th>Hospital Name</th>
                                                                                        <th>% of Sales / Total</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody style="background-color:#f9f9f9;">

                                                                                        <?php
                                                                                            if($top5_yearly_hospitals)
                                                                                                while ($row = $top5_yearly_hospitals->fetch_array(MYSQLI_ASSOC)) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td class="col-3">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <div class="ms-3">
                                                                                                            <p class="fw-bold mb-1">
                                                                                                                <?php
                                                                                                                    echo $row['HOSPITAL'];
                                                                                                                ?>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end accordion -->
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div><!-- end col -->

                                            </div><!--end row-->
                                            </div>




                                            <!--COLLAPSEABLE TABEL TOP 10-->                        
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="card ">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                                            Bottom 10 Performing Products
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapseOne" class="accordion-collapse collapse " aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                                        <div class="accordion-body text-muted" style="padding:0;">
                                                                                <table class="table align-middle mb-0 bg-white border">
                                                                                    <thead class="bg-light">
                                                                                        <tr>
                                                                                        <th>Product Name</th>
                                                                                        <th>Quantity</th>
                                                                                        <th>% of Sales / Total</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody style="background-color:#f9f9f9;">

                                                                                        <?php
                                                                                            if($bottom10_yearly_products)
                                                                                                while ($row = $bottom10_yearly_products->fetch_array(MYSQLI_ASSOC)) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td class="col-3">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <div class="ms-3">
                                                                                                            <p class="fw-bold mb-1">
                                                                                                                <?php
                                                                                                                    echo $row['PRODUCT'];
                                                                                                                ?>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['QUANTITY'] ?></p>
                                                                                                </td>
                                                                                            
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end accordion -->
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div><!-- end col -->

                                                <div class="col-xl-4">
                                                    <div class="card">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                                                            <div class="accordion accordion-flush" id="accordionFlushExample2">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="flush-headingOne2">
                                                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne2" aria-expanded="true" aria-controls="flush-collapseOne2">
                                                                            Bottom 10 Performing HQ
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapseOne2" class="accordion-collapse collapse " aria-labelledby="flush-headingOne2" data-bs-parent="#accordionFlushExample2">
                                                                        <div class="accordion-body text-muted" style="padding:0;">
                                                                                <table class="table align-middle mb-0 bg-white border">
                                                                                    <thead class="bg-light ">
                                                                                        <tr>
                                                                                        <th>HQ Name</th>
                                                                                        <th>% of Sales / Total</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody style="background-color:#f9f9f9;">

                                                                                        <?php
                                                                                            if($bottom10_yearly_area)
                                                                                                while ($row = $bottom10_yearly_area->fetch_array(MYSQLI_ASSOC)) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td class="col-3">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <div class="ms-3">
                                                                                                            <p class="fw-bold mb-1">
                                                                                                                <?php
                                                                                                                    echo $row['CITY'];
                                                                                                                ?>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        } ?>
                                                                                        </tbody>
                                                                                </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end accordion -->
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div><!-- end col -->


                                                <div class="col-xl-4">
                                                    <div class="card">
                                                        <div class="card-body shadow-lg border rounded bg-soft-white" style="padding:0;">
                                                            <div class="accordion accordion-flush" id="accordionFlushExample3">
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="flush-headingOne3">
                                                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne3" aria-expanded="true" aria-controls="flush-collapseOne3">
                                                                            Bottom 10 Performing Hospitals
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapseOne3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne3" data-bs-parent="#accordionFlushExample3">
                                                                        <div class="accordion-body text-muted" style="padding:0;">
                                                                                <table class="table align-middle mb-0 bg-white border">
                                                                                    <thead class="bg-light">
                                                                                        <tr>
                                                                                        <th>Hospital Name</th>
                                                                                        <th>% of Sales / Total</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody style="background-color:#f9f9f9;">

                                                                                        <?php
                                                                                            if($bottom10_yearly_hospitals)
                                                                                                while ($row = $bottom10_yearly_hospitals->fetch_array(MYSQLI_ASSOC)) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td class="col-3">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <div class="ms-3">
                                                                                                            <p class="fw-bold mb-1">
                                                                                                                <?php
                                                                                                                    echo $row['HOSPITAL'];
                                                                                                                ?>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            
                                                                                                <td class="col-3">
                                                                                                    <p class="fw-normal mb-1"><?php echo $row['PERCENTAGE'] ?> <span>&#x00025</span></p>
                                                                                                    <p class="text-muted mb-0"><span>&#8377</span> <?php echo $row['TOTAL'] ?> </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                        } ?>
                                                                                    </tbody>
                                                                                </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end accordion -->
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div><!-- end col -->

                                            </div><!--end row-->
                                            </div>

              
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
                                                                                            `TOTAL PRICE`, `HOSPITAL NAME`, `CFA NAME` FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) between '$start_date' and '$end_date' 
                                                                                            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
                                                                                            order by date(`ORDER DATE`) desc";
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



<script>


//  console.log('1000');

// // Get references to the dropdowns
// var dropdowns = document.querySelectorAll(".dropdown-item");

// // Add event listeners to the dropdowns
// dropdowns.forEach(function(dropdown) {
//   dropdown.addEventListener("change", callMyFunction);
//   console.log('1002');
// });

// function callMyFunction(event) {
//     console.log('1003');

//   // Get the values of the dropdown that triggered the event
//   var dropdown = event.target;
//   var value = dropdown.value;
//   var dropdownId = dropdown.id;
//   console.log('1003');
//   console.log(dropdown);
//   console.log(value);
//   console.log(dropdownId);


//   // Call the PHP function with the dropdown value, dropdown ID, and any other parameters as needed
//   $.ajax({
//     url: "layout/dropdown_data.php",
//     type: "POST",
//     data: { functionName: "GetEmployeeArray", param1: $link, param2: document.getElementById(dropdown).value, dropdownId: dropdownId },
//     success: function(data) {
//       // Handle the response from the server
//       console.log(data);
//     },
//     error: function(xhr, status, error) {
//       // Handle errors
//       console.error(xhr);
//     }
//   });
// }




        //   // Get the dropdown element
        //   var dropdown = document.getElementById("user-dropdown");
        
        //   // Add a change event listener to the dropdown
        //   dropdown.addEventListener("change", function() {
        //     // Get the selected user ID
        //     var userId = dropdown.value;
            
        //     // Make an AJAX call to the PHP function
        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //       if (this.readyState == 4 && this.status == 200) {
        //         // Update the HTML elements with the new data
        //         document.getElementById("user-data").innerHTML = this.responseText;
        //       }
        //     };
        //     xhttp.open("GET", "get_user_data.php?user_id=" + userId, true);
        //     xhttp.send();
        //   });
</script>



<script>
var xValues = ["Jan", "Feb", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var yValues = [55, 49, 44, 24, 15, 41, 52, 56, 52, 13, 34, 42];
var barColors = [
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
];

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }],
    }
  }
});
</script>



<script>
// var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
// var yValues = [55, 49, 44, 24, 15];



var xValues = JSON.parse('<?= json_encode($top_products_name)?>');
var yValues  = JSON.parse('<?=json_encode($top_products_per)?>');
var barColors = [
    "#80b34a",
    "#b4da75",  
    "#dde993",  
    "#ff549a",  
    "#ffaacd",  
    "#715a92",  
    "#d25dfb",  
    "#ffd871",  
    "#935d5d",   
    "#f6e0d5"
];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: false,
      text: "TOP PRODUCTS"
    },
    
  },    
});
</script>


<script>
// var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
// var yValues = [55, 49, 44, 24, 15];

var xValues = JSON.parse('<?= json_encode($top_hospitals_name)?>');
var yValues  = JSON.parse('<?=json_encode($top_hospitals_per)?>');
var barColors = [
    "#80b34a",
    "#b4da75",  
    "#dde993",  
    "#ff549a",  
    "#ffaacd",  
    "#715a92",  
    "#d25dfb",  
    "#ffd871",  
    "#935d5d",   
    "#f6e0d5"
];

new Chart("myChart3", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: false,
      text: "TOP HOSPITALS"
    }
  },
});
</script>



<script>

    var xValue = ['Deepak Singh', 'Jasvinder Singh', 'Shailender Raghuwanshi', 'Umesh Sehgal', 'Ved Pathak', 'Yogesh Lokwani'];

    var yValue = [54157877, 94575035, 44488390, 145683609, 104084095, 36780390];
    var yValue2 = JSON.parse('<?=json_encode($achivements)?>');

    var Target_Value = {
    x: xValue,
    y: yValue,
    type: 'bar',
    text: yValue.map(String),
    textposition: 'auto',
    hoverinfo: 'none',
    opacity: 0.7,
    marker: {
        color: 'rgb(158,202,225)',
        line: {
        color: 'rgb(8,48,107)',
        width: 1.5
        }
    }
    };

    var Actual_Value = {
    x: xValue,
    y: yValue2,
    type: 'bar',
    text: yValue2.map(String),
    textposition: 'auto',
    hoverinfo: 'none',
    marker: {
        color: 'rgba(58,200,225,.5)',
        line: {
        color: 'rgb(8,48,107)',
        width: 1.5
        }
    }
    };

    var data = [Target_Value,Actual_Value];

    var layout = {
    title: ''
    };

    Plotly.newPlot('myDiv', data, layout);

    document.getElementsByClassName('legendtext')[0].innerHTML = 'Target';
    document.getElementsByClassName('legendtext')[1].innerHTML = 'Achieve';
    
</script>




<!--  TARGET VS ACHIEVEMENT BAR GRAPH -->

<script>
    // var link = document.getElementsByClassName('modebar-container').[0];
    // link.style.display = 'none';

    var trace1 = {
    x: JSON.parse('<?=json_encode($name_array)?>'),
    y: JSON.parse('<?=json_encode($target_array)?>'),
    name: 'Target',
    type: 'bar'
    };

    var trace2 = {
    x: JSON.parse('<?=json_encode($name_array)?>'),
    y: JSON.parse('<?=json_encode($achievement_array)?>'),
    text: JSON.parse('<?=json_encode($percentage_array)?>'),

    name: 'Achievement',
    type: 'bar'
    };

    var data = [trace1, trace2];

    var layout = {barmode: 'group'};

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