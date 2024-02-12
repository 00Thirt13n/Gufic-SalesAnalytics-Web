<?php

    include 'layouts/session.php';
    

    $emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : $_SESSION['user_id'];
    $cfa = isset($_POST['cfa']) ? $_POST['cfa'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-01');
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : date('Y-m-d');
    if($emp_id =='MEMP_G_16') { $emp_id = 'MEMP_G_1';}


?>
<!DOCTYPE html>
<head>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
   

    
    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
    </style>

</head>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-container">
                <table id="example" class="nowrap hover stripe display cell-border">
                    <thead>
                        <tr>
                            <th>ORDER ID</th>
                            <th>ORDER BY</th>
                            <th>APPROVER</th>
                            <th>ORDER DATE</th>
                            <th>PRODUCT</th>

                            <th>QUANTITY</th>
                            <th>REQUESTED SPECIAL PRICE</th>
                            <th>TOTAL PRICE</th>
                            <th>HOSPITAL NAME</th>
                            <th>CFA NAME</th>
                        </tr>
                    </thead>                                
                </table>
            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->


<script>

        $(document).ready(function() {
            
            var startDate;
            var endDate;
            var employee;
            var cfa;
            

            $('#form').submit(function(event) {
                event.preventDefault();

                startDate = "<?= $start_date ?>"
                endDate = "<?= $end_date ?>"
                employee = "<?= $emp_id ?>"
                cfa = "<?= $cfa ?>"

                setCookie("start_date", startDate, 300);
                setCookie("end_date", endDate, 300);
                setCookie("emp_id", employee, 300);
                setCookie("cfa_id", cfa, 300);


                $('#example').DataTable().destroy();
                get_result();
                return false;
            });

            startDate = "<?= $start_date ?>"
            endDate = "<?= $end_date ?>"
            employee = "<?= $emp_id ?>"
            cfa = "<?= $cfa ?>"

            setCookie("start_date", startDate, 300);
            setCookie("end_date", endDate, 300);
            setCookie("emp_id", employee, 300);
            setCookie("cfa_id", cfa, 300);


            $('#example').DataTable().destroy();
            get_result();
        });

        // Function to set a cookie
        function setCookie(cookieName, cookieValue, expiration) {
            const d = new Date();
            d.setTime(d.getTime() + (expiration * 1000)); // Set expiration time
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
                ajax: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/CFA_Server_processing.php",
                // lengthMenu: [
                //     [10, 50, 200, -1],
                //     [10, 50, 200, 'All']
                // ],

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
                dom: 'Bfrtip',
                select: true

            });
           
        }

        

</script>