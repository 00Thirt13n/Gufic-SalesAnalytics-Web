<?php 
    include 'layouts/session.php';
    include 'layouts/head-main.php';
    
    if(!$_SESSION['is_admin']){
        header('Location: index.php');
        exit();
    } 
?>

<head>

    <title>Add User</title>
    <?php include 'layouts/head.php'; ?>
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
                            <h4 class="mb-sm-0 font-size-18">Add User</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sparsh App</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Panel</a></li>
                                    <li class="breadcrumb-item active">Add User</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="card p-4">
                            <form action="https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/add-user-file.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                <div class="row">
                                    <div class="col-md-4">
                                        <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                        <h5>Select file to upload:</h5>
                                        <p class="active text-warning">Only CSV and XLSX files allowed</p>
                                        <a href="https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/download-sample-csv-file.php" class="btn btn-primary waves-effect waves-light float-center">Download sample CSV file <i class="bx bx-cloud-download fs-4"></i></a>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" multiple accept=".csv, .xlsx" required>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <button class="btn btn-primary waves-effect waves-light float-center" type="submit" value="Upload Image" name="submit">Upload users</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

                


                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/Scripts/add-user.php" class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom01">First name</label>
                                                <input type="text" name="first_name" class="form-control" id="validationCustom01" placeholder="Hitesh" value="" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom02">Last name</label>
                                                <input type="text" name="last_name" class="form-control" id="validationCustom02" placeholder="Patel" value="" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom03">Phone no.</label>
                                                <input type="text" name="phone" class="form-control" id="validationCustom03" placeholder="9876543210" required maxlength="10">
                                                <div class="invalid-feedback">
                                                    Please provide a valid phone number.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom04">Personal Email</label>
                                                <input type="email" name="personal_email" class="form-control" id="validationCustom04" placeholder="hiteshpatel@gmail.com">
                                                <div class="invalid-feedback">
                                                    Please provide a valid email.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom05">Official Email</label>
                                                <input type="email" name="official_email" class="form-control" id="validationCustom05" placeholder="hitesh.patel@guficbio.com" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid email.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom08">HQ Name</label>
                                                <input type="text" name="hq_name" class="form-control" id="validationCustom08" placeholder="Mumbai1" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Headquarter.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom06">Zone</label>
                                                <input type="text" name="zone" class="form-control" id="validationCustom06" placeholder="South" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid zone.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom07">State</label>
                                                <input type="text" name="state" class="form-control" id="validationCustom07" placeholder="Maharashtra" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid state.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom09">Designation</label>
                                                <input type="text" name="designation" class="form-control" id="validationCustom09" placeholder="ZBM" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Designation.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom10">Employee Code</label>
                                                <input type="text" name="emp_code" class="form-control" id="validationCustom10" placeholder="Z987" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Employee Code.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom11">Joining Date</label>
                                                <input type="date" name="joining_date" class="form-control" id="validationCustom11" value="<?php echo date('Y-m-d') ?>" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid date.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom12">Manager Name</label>
                                                <input type="text" name="manager_name" class="form-control" id="validationCustom12" placeholder="Hitesh Patel" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Manager Name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom12">Division</label>
                                                <input type="text" name="division" class="form-control" id="validationCustom12" placeholder="Gufic" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Division.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom13">Manager Code</label>
                                                <input type="text" name="manager_code" class="form-control" id="validationCustom13" placeholder="M962" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Manager Code.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom14">Grade</label>
                                                <input type="text" name="grade" class="form-control" id="validationCustom14" placeholder="COMMERCIAL BUSINESS ASSOCIATES" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid Grade.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom15">CFA Name</label>
                                                <input type="text" name="cfa_name" class="form-control" id="validationCustom15" placeholder="UNIMED CORPORATION" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid CFA Name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="validationCustom16">CFA Locator</label>
                                                <input type="text" name="cfa_locator" class="form-control" id="validationCustom16" placeholder="Chennai" >
                                                <div class="invalid-feedback">
                                                    Please provide a valid CFA Locator.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-primary waves-effect waves-light float-end" id="sa-position" type="submit">Add User</button>
                                
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div><!-- end row -->

               
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
    function validateForm() {
        var fileInput = document.getElementById('fileToUpload');
        var fileName = fileInput.value;
        
        if (fileName.trim() === "") {
            alert("Please select a file.");
            return false;
        }
        return true;
    }
</script>

                                    
</body>

</html>