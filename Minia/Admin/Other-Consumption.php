<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php //include "layouts/config_RDS.php"; ?>

<head>

    <title>RCPA Other-Consumption</title>
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
                            <h4 class="mb-sm-0 font-size-18">RCPA Other-Consumption</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">RCPA</a></li>
                                    <li class="breadcrumb-item active">Consumption</li>
                                    <li class="breadcrumb-item active">Other</li>
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
                                    <input type="date" class="form-control" value= <?php echo date('Y-m-01')?> id="datepicker" name="start-date">

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


                <!-- <?php
                    // include "layouts/config.php";

                    // $sql =  "SELECT `HOSPITAL_WISE_CONSUMPTION`.`CREATED_DATE`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`CREATED_TIME`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`TE_NAME`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`HQ`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`ABM`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`RBM`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`HospitalCode`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`HospitalName`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`Molecule`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`CompetitorStrength`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`CompetitorBrand`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`CompetitorQuantity`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`CompetitorMRP`,
                    //     `HOSPITAL_WISE_CONSUMPTION`.`CompetitorRate`
                    //     FROM `MELJOHN_UPLOAD_SATISH`.`HOSPITAL_WISE_CONSUMPTION`

                    //     where `CREATED_DATE`  between  '20230301' and '20230310'";

                    // $result = mysqli_query($link, $sql);
                ?> -->

            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                            <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>CREATED DATE</th>
                                            <th>CREATED TIME</th>
                                            <th>NAME</th>
                                            <th>HQ</th>
                                            <th>ABM</th>
                                            <th>RBM</th>

                                            <th>Hospital Code</th>
                                            <th>Hospital Name</th>
                                            <th>Molecule</th>

                                            <th>Competitor Strength</th>
                                            <th>Competitor Brand</th>
                                            <th>Competitor Quantity</th>
                                            <th>Competitor MRP</th>
                                            <th>Competitor Rate</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                         <!-- PHP code to fetch and display data -->
                                            <?php
                                                include "layouts/config.php";
                                            $emp_id = $_SESSION['user_id'];

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

                                            // Fetch the data from the database table based on the selected date
                                            //$query = "SELECT * FROM users WHERE date = '$date'";
                                            //echo $date;
                                            $sql =  "SELECT `HOSPITAL_WISE_CONSUMPTION`.`CREATED_DATE`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`CREATED_TIME`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`TE_NAME`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`HQ`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`ABM`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`RBM`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`HospitalCode`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`HospitalName`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`Molecule`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`CompetitorStrength`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`CompetitorBrand`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`CompetitorQuantity`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`CompetitorMRP`,
                                                    `HOSPITAL_WISE_CONSUMPTION`.`CompetitorRate`
                                                    FROM `MELJOHN_UPLOAD_SATISH`.`HOSPITAL_WISE_CONSUMPTION`
                                                    where (find_in_set(MEMPLOYEE_ID, ifnull((select GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id')))
                                                    and date(`CREATED_DATE`)  between '$start_date' and '$end_date'";
                                            $result = mysqli_query($link, $sql);

                                            // // Display the fetched data in the table
                                            // while ($row = mysqli_fetch_assoc($result)) {
                                            //     echo "<tr>";
                                            //     echo "<td>".$row['CREATED_DATE']."</td>";
                                            //     echo "<td>".$row['CREATED_TIME']."</td>";
                                            //     echo "<td>".$row['TE_NAME']."</td>";
                                            //     echo "<td>".$row['HQ']."</td>";
                                            //     echo "<td>".$row['ABM']."</td>";
                                            //     echo "<td>".$row['RBM']."</td>";
                                            //     echo "<td>".$row['HospitalCode']."</td>";
                                            //     echo "<td>".$row['HospitalName']."</td>";
                                            //     echo "<td>".$row['Molecule']."</td>";
                                            //     echo "<td>".$row['CompetitorStrength']."</td>";
                                            //     echo "<td>".$row['CompetitorBrand']."</td>";
                                            //     echo "<td>".$row['CompetitorQuantity']."</td>";
                                            //     echo "<td>".$row['CompetitorMRP']."</td>";
                                            //     echo "<td>".$row['CompetitorRate']."</td>";
                                            //     echo "</tr>";
                                            //}
                                            ?>
                                        <?php
                                            if($result){      
                                            $sn=1;
                                            
                                            foreach($result as $data){
                                            ?>
                                            <tr>
                                                <td><?php echo $data['CREATED_DATE']??''; ?></td>
                                                <td><?php echo $data['CREATED_TIME']??''; ?></td>
                                                <td><?php echo $data['TE_NAME']??''; ?></td>
                                                <td><?php echo $data['HQ']??''; ?></td>
                                                <td><?php echo $data['ABM']??''; ?></td>
                                                <td><?php echo $data['RBM']??''; ?></td>

                                                <td><?php echo $data['HospitalCode']??''; ?></td>
                                                <td><?php echo $data['HospitalName']??''; ?></td>
                                                <td><?php echo $data['Molecule']??''; ?></td>

                                                <td><?php echo $data['CompetitorStrength']??''; ?></td>
                                                <td><?php echo $data['CompetitorBrand']??''; ?></td>
                                                <td><?php echo $data['CompetitorQuantity']??''; ?></td>  
                                                <td><?php echo $data['CompetitorMRP']??''; ?></td>
                                                <td><?php echo $data['CompetitorRate']??''; ?></td>
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

  console.clear();
</script>

    <!-- <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(){
            let dateObj = new Date();
            let month = String(dateObj.getMonth() + 1).padStart(2, '0');
            let day = String(dateObj.getDate()).padStart(2, '0');
            let year = dateObj.getFullYear();
            let output =  year +  '-' + month + '-' + day ;
            console.log(output);
            document.getElementById("datepicker").setAttribute("value", String (output));
            document.getElementById("datepicker1").setAttribute("value", String(output));
        })
    </script> -->

</body>

</html>