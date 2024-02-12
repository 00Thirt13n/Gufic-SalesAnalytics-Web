<?php 
    include 'layouts/session.php';
    include "layouts/config.php"; 
    include 'layouts/head-main.php';

    if(!$_SESSION['is_admin']){
        header('Location: index.php');
        exit();
    } 
    
    $sql =  "SELECT `approval_matrix_final`.`Sl No` as `SI NO`,
                    `approval_matrix_final`.`MOLECULE`,
                    `approval_matrix_final`.`STRENGTH`,
                    `approval_matrix_final`.`Finalised Brand Name` as `FINALISED BRAND NAME` ,
                    `approval_matrix_final`.`MRP`,
                    `approval_matrix_final`.`BASE PRICE`,
                    `approval_matrix_final`.`ABM_FROM` as `ABM FROM`,
                    `approval_matrix_final`.`ABM_TO` as `ABM TO`, 
                    `approval_matrix_final`.`RBM_FROM` as `RBM FROM`,
                    `approval_matrix_final`.`RBM_TO` as `RBM TO`,
                    `approval_matrix_final`.`ZBM_FROM` as `ZBM FROM`,
                    `approval_matrix_final`.`ZBM_TO` as `ZBM TO`,
                    `approval_matrix_final`.`BU_FROM` as `BU FROM`,
                    `approval_matrix_final`.`BU_TO` as `BU TO`,
                    `approval_matrix_final`.`HO`
                FROM `MELJOHN_UPLOAD_SATISH`.`approval_matrix_final`";  // USE "approval_matrix_test" FOR TESTING

        // echo ($sql);     
        $result = mysqli_query($link, $sql);
                                            
?>

<head>

    <title>Approval Matrix</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
        /* For modern browsers */
        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
        }

        /* For WebKit-based browsers (Chrome, Safari) */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Additional styles to prevent resizing in Safari */
        input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
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
                            <h4 class="mb-sm-0 font-size-18">Approval Matrix</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0"> 
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sparsh App</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                    <li class="breadcrumb-item active">Approval Matrix</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                
                <!-- CHANGE TABLE NAME "approval_matrix_final" TO "approval_matrix_final" TO GET REAL DATA -->
                    <!-- <div class="col-xl-6">
                        <div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show mb-0" role="alert">
                            <i class="mdi mdi-alert-circle-outline label-icon"></i><strong>Testing</strong> - Below changed data <strong>will not reflect</strong> original data
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    
                    </div> -->


            <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-container ">

                                <table id="datatable-buttons"  class="table table-editable table-nowrap align-middle table-edits">
                                    <thead>
                                        <tr>
                                                <th>SI NO</th>
                                                <th>MOLECULE</th>
                                                <th>STRENGTH</th>
                                                <th>FINALISED BRAND NAME</th>
                                                <th>MRP</th>
                                                <th>BASE PRICE</th>
                                                <th>ABM FROM</th>
                                                <th>ABM TO</th>
                                                <th>RBM FROM</th>
                                                <th>RBM TO</th>
                                                <th>ZBM FROM</th>
                                                <th>ZBM TO</th>
                                                <th>BU FROM</th>
                                                <th>BU TO</th>
                                                <th>HO</th>
                                                <th>EDIT</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        
                                        <?php
                                            if($result){      
                                            $sn=1;
                                            
                                            foreach($result as $data){
                                            ?>
                                            <tr>
                                                <td ><?php echo $data['SI NO']??''; ?></td>
                                                <td data-field="molecule"><?php echo $data['MOLECULE']??''; ?></td>
                                                <td data-field="strength"><?php echo $data['STRENGTH']??''; ?></td>
                                                <td data-field="brand"><?php echo $data['FINALISED BRAND NAME']??''; ?></td>
                                                <td data-field="mrp"><?php echo $data['MRP']??''; ?></td>
                                                <td data-field="base_price"><?php echo $data['BASE PRICE']??''; ?></td>
                                                <td data-field="abm_from"><?php echo $data['ABM FROM']??''; ?></td>
                                                <td data-field="abm_to"><?php echo $data['ABM TO']??''; ?></td>
                                                <td data-field="rbm_from"><?php echo $data['RBM FROM']??''; ?></td>
                                                <td data-field="rbm_to"><?php echo $data['RBM TO']??''; ?></td>
                                                <td data-field="zbm_from"><?php echo $data['ZBM FROM']??''; ?></td>
                                                <td data-field="zbm_to"><?php echo $data['ZBM TO']??''; ?></td>
                                                <td data-field="bu_from"><?php echo $data['BU FROM']??''; ?></td>
                                                <td data-field="bu_to"><?php echo $data['BU TO']??''; ?></td>
                                                <td data-field="ho"><?php echo $data['HO']??''; ?></td>

                                                <td onclick = "saveData(this, <?= $data['SI NO']?>)">
                                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>

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
                                    <!-- <thead>
                                        <tr>
                                            <th>SI NO</th>
                                            <th>MOLECULE</th>
                                            <th>STRENGTH</th>
                                            <th>FINALISED BRAND NAME</th>
                                            <th>MRP</th>
                                            <th>BASE PRICE</th>
                                            <th>ABM FROM</th>
                                            <th>ABM TO</th>
                                            <th>RBM FROM</th>
                                            <th>RBM TO</th>
                                            <th>ZBM FROM</th>
                                            <th>ZBM TO</th>
                                            <th>BU FROM</th>
                                            <th>BU TO</th>
                                            <th>HO</th>
                                            <th>EDIT</th>
                                        </tr>
                                    </thead> -->
                                </table>
                                <div class="row">
                                    <div class="col-3  mx-auto mt-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Add New Product Approval Matrix
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 

                <div aria-live="polite" aria-atomic="true" class="position-relative">
                    <div class="toast-container position-fixed bottom-0 end-0 p-3 mb-1 w-10" style="z-index: 11; width: 300px;"></div>
                </div>


                


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" id="add_new_row" class="needs-validation" novalidate>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">THERAPY</label>
                                                        <input type="text" name="therapy" class="form-control" id="validationCustom01" placeholder="ANTI-INFECTIVES" value="" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom02">PRODUCT CODE</label>
                                                        <input type="text" name="product_code" class="form-control" id="validationCustom02" placeholder="SLSPGU0127" value="" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">MOLECULE</label>
                                                        <input type="text" name="molecule" class="form-control" id="validationCustom01" placeholder="CLINDAMYCIN" value="" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom02">STRENGTH</label>
                                                        <input type="text" name="strength" class="form-control" id="validationCustom02" placeholder="CLINDAMYCIN 300MG" value="" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom03">FINALISED BRAND NAME</label>
                                                        <input type="text" name="finalised_brand_name" class="form-control" id="validationCustom03" placeholder="GUFICLINDA INJ 300 MG/ 2 ML" required >
                                                        <div class="invalid-feedback">
                                                            Please provide a Brand Name.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom03">MRP</label>
                                                        <input type="number" step="0.01" name="mrp" class="form-control" id="validationCustom03" placeholder="127" required >
                                                        <div class="invalid-feedback">
                                                            Please provide a MRP.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom04">BASE PRICE</label>
                                                        <input type="number" step="0.01" name="base_price" class="form-control" id="validationCustom04" placeholder="45" required>
                                                        <div class="invalid-feedback">
                                                            Please provide a BASE PRICE.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom08">ABM FROM</label>
                                                        <input type="number" step="0.01" name="abm_from" class="form-control" id="validationCustom08" placeholder="38"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a ABM FROM.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom06">ABM TO</label>
                                                        <input type="number" step="0.01" name="abm_to" class="form-control" id="validationCustom06" placeholder="44"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a ABM TO.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom09">RBM FROM</label>
                                                        <input type="number" step="0.01" name="rbm_from" class="form-control" id="validationCustom09" placeholder="38"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a RBM FROM.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom10">RBM TO</label>
                                                        <input type="number" step="0.01" name="rbm_to" class="form-control" id="validationCustom10" placeholder="44"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid RBM TO.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom12">ZBM FROM</label>
                                                        <input type="number" step="0.01" name="zbm_from" class="form-control" id="validationCustom12" placeholder="35"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid ZBM FROM.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom12">ZBM TO</label>
                                                        <input type="number" step="0.01" name="zbm_to" class="form-control" id="validationCustom12" placeholder="37"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a ZBM TO.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom14">BU FROM</label>
                                                        <input type="number" step="0.01" name="bu_from" class="form-control" id="validationCustom14" placeholder="32"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a BU FROM.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom15">BU TO</label>
                                                        <input type="number" step="0.01" name="bu_to" class="form-control" id="validationCustom15" placeholder="34"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid BU TO.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom14">HO</label>
                                                        <input type="number" step="0.01" name="ho" class="form-control" id="validationCustom14" placeholder="31.99"  required>
                                                        <div class="invalid-feedback">
                                                            Please provide a HO.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="add-product">Add Product</button>
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

<!-- Table Editable plugin -->
<script src="assets/js/table-edits.min.js"></script>
<script src="assets/js/table-editable.int.js"></script>


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
  });

    function saveData(element, row_id) {
        // debugger;
    
        if (element.getElementsByTagName('a')[0].getElementsByTagName('i')[0].getAttribute('title') === 'Edit') {
            
            // Prepare data to send via AJAX
            var updatedData = {
                siNo: row_id, // Unique identifier for the row
                molecule: document.querySelector('[data-field="molecule"]').innerHTML,
                strength: document.querySelector('[data-field="strength"]').innerHTML,
                brand: document.querySelector('[data-field="brand"]').innerHTML,
                mrp: document.querySelector('[data-field="mrp"]').innerHTML,
                base_price: document.querySelector('[data-field="base_price"]').innerHTML,
                abm_from: document.querySelector('[data-field="abm_from"]').innerHTML,
                abm_to: document.querySelector('[data-field="abm_to"]').innerHTML,
                rbm_from: document.querySelector('[data-field="rbm_from"]').innerHTML,
                rbm_to: document.querySelector('[data-field="rbm_to"]').innerHTML,
                zbm_from: document.querySelector('[data-field="zbm_from"]').innerHTML,
                zbm_to: document.querySelector('[data-field="zbm_to"]').innerHTML,
                bu_from: document.querySelector('[data-field="bu_from"]').innerHTML,
                bu_to: document.querySelector('[data-field="bu_to"]').innerHTML,
                ho: document.querySelector('[data-field="ho"]').innerHTML,
            };

            // console.log(updatedData);
            

            $.ajax({
                url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Set_Matrix.php",
                data: {"data": updatedData},
                type: "POST",
                beforeSend: function() {
                    console.log("SETTING MATRIX");
                },
                complete: function() {
                    
                },
                success: function(response) {
                    (response == 1) ? console.log("MATRIX HAS BEEN SET"):console.log("MATRIX HAS BEEN NOT SET");
                    var toastColor = (response == 1) ? 'bg-success' : 'bg-danger';
                    var toastMessage;
                    
                    if (response == 0) 
                        toastMessage = 'MATRIX HAS BEEN NOT SET';
                    else if (response == 1) 
                        toastMessage = 'MATRIX HAS BEEN SET';
                     else if (response == 2) 
                        toastMessage = 'FORM DATA NOT FOUND';
                     else if (response == 3) 
                        toastMessage = 'REQUEST ERROR';
                     else 
                        toastMessage = 'UNKNOWN RESPONSE';
                    

                    var toastId = 'toast-' + new Date().getTime();

                    var toast = `
                        
                            <div id="${toastId}" class="text-light fw-bold ${toastColor} mb-5 rounded-1 shadow" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
                                <div class="toast-header">
                                    <img src="assets/images/mediola/circle-logo.svg" class="rounded me-2" height="24" alt="Mediapp">
                                    <strong class="me-auto">Mediapp</strong>
                                    <small>Just now</small>
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    ${toastMessage}
                                </div>
                            </div>
                    `;

                    
                    $('.toast-container').append(toast);
                    $('#' + toastId).toast('show');

                    setTimeout(function() {
                        $('#' + toastId).remove();
                    }, 10000);
                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }

            });
            
        } else {
            console.log("Editing");
        }
    }


    $('#add-product').click(function(e) {
            e.preventDefault(); // Prevent the default form submission
            
            var form = $('#add_new_row')[0];
            if (form.checkValidity() === false) {
                // If form validation fails, prevent AJAX call
                form.classList.add('was-validated');
                return;
            }


            var rowData = $('#add_new_row').serialize();

            // console.log(rowData);

            $.ajax({
                url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/add_product_row.php",
                data: {"data": rowData},
                type: "POST",
                beforeSend: function() {
                    $('#loader').show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                success: function(response) {


                    document.querySelector('.btn-close').click(); // CLOSE FORM MODEL

                    setTimeout(function() {
                        location.reload(true); //REFRESH PAGE
                    }, 2000);

                    var toastColor = (response == 1) ? 'bg-success' : 'bg-danger';
                    var toastMessage;
                    
                    if (response == 1) {
                        toastMessage = 'PRODUCT ADDED SUCCSSFULLY!';
                        $('#add_new_row')[0].reset();
                    } else if (response == 0) {
                        toastMessage = 'PRODUCT ALREADY EXISTS!';
                    }else if (response == 2) {
                        toastMessage = 'ERROR WHILE INSERTING PRODUCT!';
                    } else if (response == 3) {
                        toastMessage = 'FORM DATA NOT FOUND!';
                    } else if (response == 4) {
                        toastMessage = 'REQUEST ERROR!';
                    } else {
                        toastMessage = 'UNKNOWN RESPONSE!';
                    }


                    var toastId = 'toast-' + new Date().getTime();

                    var toast = `
                        
                            <div id="${toastId}" class="text-light fw-bold ${toastColor} mb-5 rounded-1 shadow" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
                                <div class="toast-header">
                                    <img src="assets/images/mediola/circle-logo.svg" class="rounded me-2" height="24" alt="Mediapp">
                                    <strong class="me-auto">Mediapp</strong>
                                    <small>Just now</small>
                                    <button type="button" class="btn-close float-end" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    ${toastMessage}
                                </div>
                            </div>
                    `;

                    
                    $('.toast-container').append(toast);
                    $('#' + toastId).toast('show');

                    setTimeout(function() {
                        $('#' + toastId).remove();
                    }, 10000);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }

            })
        });
</script>

</body>

</html>