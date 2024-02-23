<?php 	
	include 'layouts/session.php'; 
	include 'layouts/head-main.php'; 
	include "layouts/config.php";


	$start_date = date('Y-04-01');
    $end_date = date('Y-m-d');
    $emp_id = $_SESSION['user_id'];

    if (strtotime($start_date) > strtotime($end_date)) {
        $start_date = date('Y-m-d', strtotime('-1 year', strtotime($start_date)));
    }

?>
<!DOCTYPE html>
<head>

    <title>Overall Sales | Mediola</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
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
                            <h4 class="mb-sm-0 font-size-18">Overall Sales Report</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                    <li class="breadcrumb-item active">Overall Sales Report</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


				<!-- Date Picker -->
				<div class="row salesCard mt-lg-4">
					<form method="post" id="form">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-4 ">
								<div>
									<div class="mb-3">
										<label for="example-date-input" class="form-label">Start Date</label>
										<input type="date" class="form-control" value=<?= $start_date ?> id="datepicker" name="start-date">
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 ">
								<div class=" mt-lg-0">
									<div class="mb-3">
										<label for="example-date-input" class="form-label">End Date</label>
										<input type="date" class="form-control" value=<?= $end_date ?> id="datepicker1" name="end-date">
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 ">
								<div class=" mt-lg-0">
									<div class="mb-3" style="margin-top: 1.8rem;">
										<button type="submit" class="btn btn-primary" style="padding :10.9px 16.9px !important">Submit</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>


                <div class="row mt-1">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-container">

							<table id="example" class="nowrap hover stripe display cell-border">
								<thead>
									<tr>
                                        <th>ORDER ID</th>
                                        <th>ORDER BY</th>
                                        <th>HQ</th>
                                        <th>APPROVER</th>
                                        <th>ORDER MONTH</th>

                                        <th>ORDER DATE</th>
                                        <th>APPROVED DATE</th>
                                        <th>PRODUCT</th>
                                        <th>CFA APPROVER STATUS</th>
                                        <th>ORDER APPROVER STATUS</th>
                                        
                                        <th>QUANTITY</th>
                                        <th>REQUESTED SPECIAL PRICE</th>
                                        <th>TOTAL PRICE</th>
                                        <th>PROD STATUS</th>
                                        <th>REASON</th>
                                        
                                        <th>HOSPITAL NAME</th>
                                        <th>HOSPITAL EMAIL</th>
                                        <th>MOBILE</th>
                                        <th>CONTACT PERSON</th>
                                        <th>BILLING PARTY</th>
                                        
                                        <th>HOSPITAL ADDRESS</th>
                                        <th>HOSPITAL CITY</th>
                                        <th>HOSPITAL PINCODE</th>
                                        <th>HOSPITAL STATE</th>
                                        <th>DRUG_LICENE_NO</th>
                                        
                                        <th>GST_NUMBER</th>
                                        <th>PAN_NUMBER</th>
                                        <th>CFA NAME</th>
									</tr>
								</thead>                                
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


<!-- JAVASCRIPT -->

<?php include 'layouts/right-sidebar.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/js/app.js"></script>

<script>

        $(document).ready(function() {
			
            var startDate;
            var endDate;
            

            $('#form').submit(function(event) {
                event.preventDefault();

                startDate = $('#datepicker').val();
                endDate = $('#datepicker1').val();

                setCookie("start_date", startDate, 20);
                setCookie("end_date", endDate, 20);

                $('#example').DataTable().destroy();
                get_result();
                return false;
            });

            startDate = $('#datepicker').val();
            endDate = $('#datepicker1').val();
            setCookie("start_date", startDate, 20);
            setCookie("end_date", endDate, 20);
			
            $('#example').DataTable().destroy();
            get_result();
        });

        // Function to set a cookie
        function setCookie(cookieName, cookieValue, expiration) {
            const d = new Date();
            d.setTime(d.getTime() + (expiration * 180000)); // Set expiration time
            const expires = "expires=" + d.toUTCString(); // Convert the date to UTC string

            // Set the cookie with the provided name, value, and expiration date
            document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
        }


        //For Export Buttons available inside jquery-datatable "server side processing"
        function newexportaction(e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                // Just this once, load all data from the server...
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    // Call the original action function
                    if (button[0].className.indexOf('buttons-copy') >= 0) {
                        $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                        $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                        $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                        $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                            $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                    } else if (button[0].className.indexOf('buttons-print') >= 0) {
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    }
                    dt.one('preXhr', function (e, s, data) {
                        // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                        // Set the property to what it was before exporting.
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                    setTimeout(dt.ajax.reload, 0);
                    // Prevent rendering of the full data to the DOM
                    return false;
                });
            });
            // Requery the server with the new one-time export settings
            dt.ajax.reload();
        };
        

        function get_result(){
        
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Server_processing.php",

                lengthMenu: [
                    [10, 50, 200, -1],
                    [10, 50, 200, 'All']
                ],

                "buttons": [{
                    "extend": 'copy',
                    "text": 'Copy',
                    "titleAttr": 'Copy',                               
                    "action": newexportaction
                    },
                    {
                    "extend": 'excel',
                    "text": 'Excel',
                    "titleAttr": 'Excel',                               
                    "action": newexportaction
                    },
                    {
                    "extend": 'csv',
                    "text": 'CSV',
                    "titleAttr": 'CSV',                               
                    "action": newexportaction
                    },
                    {
                    "extend": 'pdf',
                    "text": 'PDF',
                    "titleAttr": 'PDF',                               
                    "action": newexportaction
                    },
                    {
                    "extend": 'print',
                    "text": 'Print',
                    "titleAttr": 'Print',                                
                    "action": newexportaction
                    },
                    {
                        "extend": 'colvis',
                        "text": 'Column Visibility'
                    }],
                colReorder: true,
                dom: 'Blfrtip',
                select: true

            });
        }


</script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->


</body>

</html>