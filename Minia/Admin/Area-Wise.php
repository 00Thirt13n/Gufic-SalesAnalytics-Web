<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>RCPA Hospital | Mediola</title>
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
                    <h4 class="mb-sm-0 font-size-18">RCPA Hospital</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                            <li class="breadcrumb-item active">RCPA Hospital</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="container-fluid">
        <div class="row" >
            <div class="col-md-3 col-lg-3">
                <div>
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">Start Date</label>
                        <input class="form-control" type="date" value="2023-01-01" id="example-date-input">
                    </div>      
                </div>
            </div>      
            <div class="col-md-3 col-lg-3">
                <div class=" mt-lg-0">
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">End Date</label>
                        <input class="form-control" type="date" value="2023-01-01" id="example-date-input">
                    </div>
                </div>
            </div>
        </div>

        <?php
            include "layouts/config.php";

            $sql = "SELECT 
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
            WHERE hd.CreatedBy NOT IN ('','MEMP_437','MEMP_TEST_1','MEMP_TEST_2') and hd.CreatedDate between date('20230403') and date('20230405')
            order by hd.HOSPITAL_ID;
                            ";

            $result = mysqli_query($link, $sql);
            // echo ($sql);
            // echo "<br>";
            // if($result==true)
            //     echo 'true';
            // elseif($result==false)
            //     echo 'false';
            // else echo 'something else';
            // while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            //     // $records[] = $row;
            //     print_r(json_encode($row));
            // }

            //     $sql2 = "SELECT * FROM MILJON_EMPLOYEE WHERE email = 'harshadsalunkhe1212@gmail.com' AND password = 'welcome';";
            //         echo "<script>console.log('$sql2')</script>";

            //         $stmt = mysqli_query($link, $sql2);
            //         while ($row = $stmt->fetch_array(MYSQLI_ASSOC)) {
            //         print_r(json_encode($row));
            //         }
            //         // echo "<script>console.log($stmt)</script>";
            //         echo "<script>console.log('".gettype($stmt)."')</script>";
            //         if($stmt == true) echo "<script>console.log('true')</script>";
            //         elseif($stmt == false) echo "<script>console.log('false')</script>";
            //         else echo "<script>console.log('something else')</script>";

            // 
                    
        ?>

            <!-- <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" data-pagecount="10" style="width:430%;">
                    <thead>
                        <tr>
                            <th>CreatedDate</th>
                            <th>TE_NAME</th>
                            <th>HQ</th>
                            <th>ABM</th>
                            <th>RBM</th>
                            <th>HospitalCode</th>
                            <th style="width:4%;">name</th>
                            <th>address</th>
                            <th>beds</th>
                            <th style="width:3%;">GuficBrand</th>
                            <th style="width:3%;">CompetitorBrand</th>
                            <th style="width:3%;">SKU</th>
                            <th>Rate</th>
                            <th>Stokist</th>
                            <th style="width:3%;">comment</th>
                            <th style="width:4%;">observation</th>
                            <th style="width:3%;">PurchaseAuthority</th>
                            <th>board_image</th>
                            <th>board_image_text</th>
                            <th>physician_list</th>
                            <th>physician_image_text</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($result){      
                            $sn=1;
                            
                            foreach($result as $data){
                            ?>
                            <tr >
                                <td><?php echo $data['CreatedDate']??''; ?></td>
                                <td><?php echo $data['TE_NAME']??''; ?></td>
                                <td><?php echo $data['HQ']??''; ?></td>
                                <td><?php echo $data['ABM']??''; ?></td>
                                <td><?php echo $data['RBM']??''; ?></td>
                                <td><?php echo $data['HospitalCode']??''; ?></td>
                                <td><?php echo $data['name']??''; ?></td>  
                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['address']??''; ?></textarea></td>
                                <td><?php echo $data['beds']??''; ?></td>
                                <td><?php echo $data['GuficBrand']??''; ?></td>
                                <td><?php echo $data['CompetitorBrand']??''; ?></td>
                                <td><?php echo $data['SKU']??''; ?></td>
                                <td><?php echo $data['Rate']??''; ?></td>
                                <td><?php echo $data['Stokist']??''; ?></td>  
                                <td><?php echo $data['comment']??''; ?></td>
                                <td><?php echo $data['observation']??''; ?></td>
                                <td><?php echo $data['PurchaseAuthority']??''; ?></textarea></td>
                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['board_image']??''; ?></textarea></td>
                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['board_image_text']??''; ?></textarea></td>
                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['physician_list']??''; ?></textarea></td>
                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['physician_image_text']??''; ?></textarea></td>  
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
            </div> -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>CreatedDate</th>
                                            <th>TE_NAME</th>
                                            <th>HQ</th>
                                            <th>ABM</th>
                                            <th>RBM</th>
                                            <th>HospitalCode</th>
                                            <th style="width:4%;">name</th>
                                            <th>address</th>
                                            <th>beds</th>
                                            <th style="width:3%;">GuficBrand</th>
                                            <th style="width:3%;">CompetitorBrand</th>
                                            <th style="width:3%;">SKU</th>
                                            <th>Rate</th>
                                            <th>Stokist</th>
                                            <th style="width:3%;">comment</th>
                                            <th style="width:4%;">observation</th>
                                            <th style="width:3%;">PurchaseAuthority</th>
                                            <th>board_image</th>
                                            <th>board_image_text</th>
                                            <th>physician_list</th>
                                            <th>physician_image_text</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($result){      
                                            $sn=1;
                                            
                                            foreach($result as $data){
                                            ?>
                                            <tr >
                                                <td><?php echo $data['CreatedDate']??''; ?></td>
                                                <td><?php echo $data['TE_NAME']??''; ?></td>
                                                <td><?php echo $data['HQ']??''; ?></td>
                                                <td><?php echo $data['ABM']??''; ?></td>
                                                <td><?php echo $data['RBM']??''; ?></td>
                                                <td><?php echo $data['HospitalCode']??''; ?></td>
                                                <td><?php echo $data['name']??''; ?></td>  
                                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['address']??''; ?></textarea></td>
                                                <td><?php echo $data['beds']??''; ?></td>
                                                <td><?php echo $data['GuficBrand']??''; ?></td>
                                                <td><?php echo $data['CompetitorBrand']??''; ?></td>
                                                <td><?php echo $data['SKU']??''; ?></td>
                                                <td><?php echo $data['Rate']??''; ?></td>
                                                <td><?php echo $data['Stokist']??''; ?></td>  
                                                <td><?php echo $data['comment']??''; ?></td>
                                                <td><?php echo $data['observation']??''; ?></td>
                                                <td><?php echo $data['PurchaseAuthority']??''; ?></textarea></td>
                                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['board_image']??''; ?></textarea></td>
                                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['board_image_text']??''; ?></textarea></td>
                                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['physician_list']??''; ?></textarea></td>
                                                <td><textarea rows="2" cols="50" style="border:none;"><?php echo $data['physician_image_text']??''; ?></textarea></td>  
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



        </div>
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

</body>

</html>

