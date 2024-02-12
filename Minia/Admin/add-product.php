<?php 
    include 'layouts/session.php';
    include 'layouts/head-main.php';
    
    if(!$_SESSION['is_admin']){
        header('Location: index.php');
        exit();
    } 
?>

<head>

    <title>Add Product</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <style>

        /* Custom CSS for loader */
        #loader {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background-color: #cacaca;
            padding: 25px;
            border-radius: 5px;
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
                            <h4 class="mb-sm-0 font-size-18">Add Product</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sparsh App</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                    <li class="breadcrumb-item active">Add Product</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                


                <div class="row mt-5">
                    <div class="col-xl-6 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" id="myForm" class="needs-validation" novalidate>
                                    <!-- <div class="row"> -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Finalised Brand Name</label>
                                                <input type="text" name="brand_name" class="form-control" id="validationCustom01" placeholder="GUFIMOX INJ 1.2GM" value="" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Brand Name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom02">Molecule</label>
                                                <input type="text" name="molecule" class="form-control" id="validationCustom02" placeholder="AMOXICILLIN + CLAVUNIC" value="" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Molecule.
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                    <!-- <div class="row"> -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">Therapy</label>
                                                <input type="text" name="therapy" class="form-control" id="validationCustom01" placeholder="ANTIBIOTIC" value="" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Therapy.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom03">Strength</label>
                                                <input type="text" name="strength" class="form-control" id="validationCustom03" placeholder="AMOXICILLIN 1000 + CLAVUNIC 200 mg" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product Strength.
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                    <!-- <div class="row"> -->
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom05">Product Code</label>
                                                <input type="text" name="product_code" class="form-control" id="validationCustom05" placeholder="SLSPG00011" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product Code.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom04">MRP</label>
                                                <input type="number" name="mrp" class="form-control" id="validationCustom04" placeholder="99.00" min="1" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please provide a valid Product MRP.
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->

                                    <div class="col-12 mt-5">
                                        <button class="btn btn-primary waves-effect waves-light float-end" id="add-product" type="submit">Add Product</button>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div><!-- end row -->


                <!--TOAST  -->
                <div aria-live="polite" aria-atomic="true" class="position-relative">
                    <div class="toast-container position-fixed bottom-0 end-0 p-3 mb-1 w-10" style="z-index: 11; width: 300px;"></div>
                </div>
                    
                 <!-- Loader HTML -->
                <div id="loader">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
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

<!-- form validation -->
<script src="assets/js/pages/form-validation.init.js"></script>


<script src="assets/js/app.js"></script>

<!-- check file types -->
<script src="assets/js/check-file-type.js"></script>

<script>
    $(document).ready(function() {
            $('#add-product').click(function(e) {
                e.preventDefault(); // Prevent the default form submission
            
            var form = $('#myForm')[0];
            if (form.checkValidity() === false) {
                // If form validation fails, prevent AJAX call
                form.classList.add('was-validated');
                return;
            }


            var formData = $('#myForm').serialize();

            $.ajax({
                url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/Add_Product.php",
                data: formData,
                type: "POST",
                beforeSend: function() {
                    $('#loader').show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                success: function(response) {
                    // debugger;

                    var toastColor = (response == 1) ? 'bg-success' : 'bg-danger';
                    var toastMessage;
                    
                    if (response == 0) {
                        toastMessage = 'PRODUCT ALREADY FOUND!';
                    } else if (response == 1) {
                        $('#myForm')[0].reset();
                        toastMessage = 'PRODUCT ADDED SUCCESSFULLY!';
                    } else if (response == 2) {
                        toastMessage = 'FORM DATA NOT FOUND!';
                    } else if (response == 3) {
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

            });
        });

    });
</script>
                                    
</body>

</html>