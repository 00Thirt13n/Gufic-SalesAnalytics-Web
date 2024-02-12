<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php require_once "layouts/config.php"; ?>

<head>

    <title>Target Report | Mediapp</title>
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

                


                <div class="row ">
                    <div class="col-xl-12">
                        <div class="card border">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Target - Achivement Report</h4> 
                            </div>
                            <div class="card-body">
                                <canvas id="speedChart" ></canvas>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                </div>





                    <!--DATA TABLE-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card" style="border: none;">
                                <div class="card-body bgdark"  style="padding:0;">
                                    <table id="datatable-buttons" class="table table-bordered table-striped table-light dt-responsive nowrap w-100">                

                                    <thead>
                                        <tr>
                                            <?php
                                            $sql = "SELECT * FROM MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA";
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


</body>

</html>