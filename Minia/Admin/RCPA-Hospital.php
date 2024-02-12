<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php // include "layouts/config_RDS.php"; 


$start_date = date('Y-m-01'); // Default to first date of month
$end_date = date('Y-m-d'); // Default to today's date


if (isset($_REQUEST['start-date'])) { $start_date = $_REQUEST['start-date']; } 
if (isset($_REQUEST['end-date'])) { $end_date = $_REQUEST['end-date']; }

?>

<head>

    <title>RCPA Hospitals | Mediola</title>
    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-style.php'; ?>

    <style>
        /* .bgdark, .previous, .page-link, .buttons-html5, .buttons-colvis{
            background-color:#f9f9f9;
        } */

        .dt-buttons, .dataTables_filter{
            margin-top: 1rem;
        }
        /* .buttons-copy, .buttons-excel, .buttons-pdf, .buttons-colvis, .buttons-columnVisibility{
            float: left;
            flex: end;
            margin: .25rem .5rem;
            padding : .5rem 1rem;
            border-radius: 3px;
        } */
        /* .buttons-copy, .buttons-colvis{margin-left :0;}
        .buttons-pdf{margin-right: 1rem;}

        .buttons-html5, .buttons-colvis{
            color: #495057;
            border: 1px solid lightgray;
        } */

        .filter{
            margin-top:2rem;
            line-height: 1.8;
        }

        /* th{
            color: #495057;
            font-weight: 400;
        } */

        
        /* .card{
            border : 0px solid black;
        } */

        .salesCard{
            margin-top : 15px;
        }

        /* .LightBlackColor{
            color: #495057;
            font-weight: 500;
        } */
        
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
                            <h4 class="mb-sm-0 font-size-18">RCPA Hospitals</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item active">RCPA Hospitals</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                    <form method="post">
                        <div class="row" >
                            <div class="col-md-3 col-lg-2">
                                <div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Start Date</label>
                                        <!-- <input class="form-control" type="date" value="01/01/2023" id="start-date"> -->
                                        <input type="date" class="form-control" value= <?php echo $start_date?> id="datepicker" name="start-date">

                                    </div>      
                                </div>
                            </div>      
                            <div class="col-md-3 col-lg-2">
                                <div class=" mt-lg-0">
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">End Date</label>
                                        <!-- <input class="form-control" type="date" value="" id="end-date"> -->
                                        <input type="date" class="form-control" value= <?php echo $end_date?> id="datepicker1" name="end-date">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class=" mt-lg-0">
                                    <div class="mb-3" style="margin-top: 1.8rem;">
                                        <!-- <button type="button" class="btn btn-primary waves-effect waves-light fetch">Fetch</button> -->
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Created Date</th>
                                            <th>Name</th>
                                            <th>HQ</th>
                                            <!-- <th>ABM</th>
                                            <th>RBM</th> -->
                                            <th>Hospital Code</th>
                                            <th>Hospital Name</th>
                                            <th>Address</th>
                                            <th>Beds</th>
                                            <th>Gufic Brand</th>
                                            <th>Competitor Brand</th>
                                            <th>SKU</th>
                                            <th>Rate</th>
                                            <th>Stokist</th>
                                            <th>Comment</th>
                                            <th>Observation</th>
                                            <th>Purchase Authority</th>
                                            <th>Board Image</th>
                                            <th>Board Image Text</th>
                                            <th>Physician List</th>
                                            <th>Physician Image Text</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

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

                                            include "layouts/config.php";
                                            
                                            $emp_id = $_SESSION['user_id'];
                                            
                                            if (strtotime($start_date) > strtotime($end_date)) {
                                                $start_date = date('Y-m-d', strtotime('-1 year', strtotime($start_date)));
                                            }
                                            
                                            $sql = 
                                            "SELECT 
                                            ifnull(hd.CreatedDate,'2022-11-29')as CreatedDate
                                            ,GE.`EMPLOYEE NAME` TE_NAME
                                            ,GE.`HQ` HQ
                                            ,(SELECT `EMPLOYEE NAME` FROM MELJOHN_UPLOAD_SATISH.GUFIC_EMPLOYEE WHERE HQ = GE.HQ AND GRADE ='ABM' LIMIT 1) ABM
                                            ,(SELECT `EMPLOYEE NAME` FROM MELJOHN_UPLOAD_SATISH.GUFIC_EMPLOYEE WHERE HQ = GE.HQ AND GRADE ='RBM' LIMIT 1) RBM
                                            ,concat('G_HOS_',hd.HOSPITAL_ID) as HospitalCode
                                            ,hd.name
                                            ,hd.address
                                            ,fi.facilities
                                            ,hd.beds
                                            ,cui.GuficBrand
                                            ,ci.CompetitorBrand
                                            ,cui.SKU
                                            ,cui.Rate
                                            ,sti.Stockist
                                            ,hd.comment
                                            ,hd.observation
                                            ,pa.PurchaseAuthority
                                            ,hd.board_image
                                            ,hd.board_image_text
                                            ,hd.physician_list
                                            ,hd.physician_image_text
                                            FROM 
                                            MELJOHN_UPLOAD_SATISH.GSTMED_HOSPITAL_DETAILS hd
                                            left join MELJOHN_UPLOAD_SATISH.MILJON_EMPLOYEE memp on  memp.MEMPLOYEE_ID = hd.CreatedBy
                                            left join MELJOHN_UPLOAD_SATISH.GUFIC_EMPLOYEE GE on GE.`EMP CODE` = memp.EMPLOYEE_CODE
                                            left join (select hoapital_id,GROUP_CONCAT(facility_name SEPARATOR ', ') facilities from  MELJOHN_UPLOAD_SATISH.GSTMED_hospitalfacility_index group by hoapital_id) fi on fi.hoapital_id= hd.HOSPITAL_ID
                                            left join (select hospital_id,GROUP_CONCAT(competitiorbrand SEPARATOR ', ') CompetitorBrand from MELJOHN_UPLOAD_SATISH.GSTMED_hospitalcompetitor_index  group by hospital_id) ci on ci.hospital_id = hd.HOSPITAL_ID
                                            left join (select hoapital_id,GROUP_CONCAT(consumption_brand SEPARATOR ', ') GuficBrand ,GROUP_CONCAT(consumption_strength SEPARATOR ', ') SKU, GROUP_CONCAT(consumption_rate SEPARATOR ', ') Rate from MELJOHN_UPLOAD_SATISH.GSTMED_hospitalconsumption_index group by hoapital_id) cui on cui.hoapital_id =hd.HOSPITAL_ID
                                            left join (select hospital_id,GROUP_CONCAT(pa_name SEPARATOR ', ') PurchaseAuthority from MELJOHN_UPLOAD_SATISH.GSTMED_hospitalpurchaseauthority_index  group by hospital_id) pa on pa.hospital_id =hd.HOSPITAL_ID
                                            left join (select hoapital_id hospital_id,GROUP_CONCAT(stockist_name SEPARATOR ', ') Stockist  from MELJOHN_UPLOAD_SATISH.GSTMED_hospitalstockist_index  group by hoapital_id) sti on sti.hospital_id =hd.HOSPITAL_ID
                                            WHERE hd.CreatedBy NOT IN ('','MEMP_437','MEMP_TEST_1','MEMP_TEST_2') 
                                            and find_in_set( hd.CreatedBy  ,ifnull((select `GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB`('$emp_id')),'$emp_id'))
                                            and hd.CreatedDate between '$start_date' and '$end_date'order by hd.HOSPITAL_ID";
                                            // echo "<script>console.log('".$sql."')</script>";
                                            $result = mysqli_query($link, $sql);
                                        
                                            if($result){      
                                            $sn=1;
                                            
                                            foreach($result as $data){
                                            ?>
                                            <tr>
                                                <td><?php echo $data['CreatedDate']??''; ?></td>
                                                <td><?php echo $data['TE_NAME']??''; ?></td>
                                                <td><?php echo $data['HQ']??''; ?></td>
                                                <!-- <td><?php // echo $data['ABM']??''; ?></td>
                                                <td><?php // echo $data['RBM']??''; ?></td> -->
                                                <td><?php echo $data['HospitalCode']??''; ?></td>
                                                <td><?php echo $data['name']??''; ?></td>  
                                                <td><?php echo $data['address']??''; ?></td>
                                                <td><?php echo $data['beds']??''; ?></td>
                                                <td><?php echo $data['GuficBrand']??''; ?></td>
                                                <td><?php echo $data['CompetitorBrand']??''; ?></td>
                                                <td><?php echo $data['SKU']??''; ?></td>
                                                <td><?php echo $data['Rate']??''; ?></td>
                                                <td><?php echo $data['Stokist']??''; ?></td>  
                                                <td><?php echo $data['comment']??''; ?></td>
                                                <td><?php echo $data['observation']??''; ?></td>
                                                <td><?php echo $data['PurchaseAuthority']??''; ?></td>
                                                <td><?php echo $data['board_image']??''; ?></td>
                                                <td><?php echo $data['board_image_text']??''; ?></td>
                                                <td><?php echo $data['physician_list']??''; ?></td>
                                                <td><?php echo $data['physician_image_text']??''; ?></td>  
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
                        <!-- end cardaa -->
                    </div> <!-- end col -->
                </div> <!-- end row -->






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