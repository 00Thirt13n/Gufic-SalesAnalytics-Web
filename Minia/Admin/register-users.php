<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Register User | Mediapp</title>
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
                            <h4 class="mb-sm-0 font-size-18">Register User</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Register User</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">

                                <div id="progrss-wizard" class="twitter-bs-wizard">
                                    <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                                        <li class="nav-item">
                                            <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="User Details">
                                                    <i class="bx bx-list-ul"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Company Document">
                                                    <i class="bx bx-book-bookmark"></i>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Bank Details">
                                                    <i class="bx bxs-bank"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- wizard-nav -->

                                    <div id="bar" class="progress mt-4">
                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                                    </div>
                                    <div class="tab-content twitter-bs-wizard-tab-content">
                                        <div class="tab-pane" id="progress-seller-details">
                                            <div class="text-center mb-4">
                                                <h5>Employee Details</h5>
                                                <!--DIVISION	
                                                EMP CODE	*
                                                DATE OF JOINING	*
                                                EMPLOYEE FIRST NAME	*
                                                STATUS *
                                                DESIGNATION *
                                                GRADE *
                                                HQ. NAME *
                                                STATE *
                                                ZONE	*
                                                REPORTING MANAGER NAME *
                                                REPORTING TO EMP CODE *
                                                MOBILE NUMBER *
                                                PERSONAL EMAIL ID *
                                                OFFICIAL EMAIL ID *
                                                CFA NAME	*
                                                CFA Location *
                                                -->
                                                <p class="card-title-desc">Fill all information below to on-board new employee</p>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="md-3">
                                                            <label for="progresspill-firstname-input">First Name</label>
                                                            <input type="text" class="form-control required" id="progresspill-firstname-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-lastname-input">Last Name</label>
                                                            <input type="text" class="form-control" id="progresspill-lastname-input">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-phoneno-input">Phone no.</label>
                                                            <input type="text" class="form-control" id="progresspill-phoneno-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="example-datetime-local-input" class="form-label">Joining Date</label>
                                                            <input class="form-control" type="date" value="2023-01-01" id="example-datetime-local-input">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-email-input">Official Email</label>
                                                            <input type="email" class="form-control" id="progresspill-email-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-email-input">Personal Email</label>
                                                            <input type="email" class="form-control" id="progresspill-email-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-address-input">Address</label>
                                                            <textarea id="progresspill-address-input" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </form>
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="progress-company-document">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Company Document</h5>
                                                    <p class="card-title-desc">Fill all information below</p>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-pancard-input" class="form-label">Employee Code</label>
                                                                <input type="text" class="form-control" id="progresspill-pancard-input">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-vatno-input" class="form-label">Division</label>
                                                                <input type="text" class="form-control" id="progresspill-vatno-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Designation</label>
                                                                <select class="form-select">
                                                                    <option selected>--Select Employee Designation--</option>
                                                                    <option value="ZBM">ZBM</option>
                                                                    <option value="ABM">ABM</option>
                                                                    <option value="RBM">RBM</option>
                                                                    <option value="KAM">KAM</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-servicetax-input" class="form-label">Grade</label>
                                                                <input type="text" class="form-control" id="progresspill-servicetax-input">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">State</label>
                                                                <!--- India states -->
                                                                <select id="country-state" class="form-select" name="country-state">
                                                                    <option value="">--Select State--</option>
                                                                    <option value="AN">Andaman and Nicobar Islands</option>
                                                                    <option value="AP">Andhra Pradesh</option>
                                                                    <option value="AR">Arunachal Pradesh</option>
                                                                    <option value="AS">Assam</option>
                                                                    <option value="BR">Bihar</option>
                                                                    <option value="CH">Chandigarh</option>
                                                                    <option value="CT">Chhattisgarh</option>
                                                                    <option value="DN">Dadra and Nagar Haveli</option>
                                                                    <option value="DD">Daman and Diu</option>
                                                                    <option value="DL">Delhi</option>
                                                                    <option value="GA">Goa</option>
                                                                    <option value="GJ">Gujarat</option>
                                                                    <option value="HR">Haryana</option>
                                                                    <option value="HP">Himachal Pradesh</option>
                                                                    <option value="JK">Jammu and Kashmir</option>
                                                                    <option value="JH">Jharkhand</option>
                                                                    <option value="KA">Karnataka</option>
                                                                    <option value="KL">Kerala</option>
                                                                    <option value="LA">Ladakh</option>
                                                                    <option value="LD">Lakshadweep</option>
                                                                    <option value="MP">Madhya Pradesh</option>
                                                                    <option value="MH">Maharashtra</option>
                                                                    <option value="MN">Manipur</option>
                                                                    <option value="ML">Meghalaya</option>
                                                                    <option value="MZ">Mizoram</option>
                                                                    <option value="NL">Nagaland</option>
                                                                    <option value="OR">Odisha</option>
                                                                    <option value="PY">Puducherry</option>
                                                                    <option value="PB">Punjab</option>
                                                                    <option value="RJ">Rajasthan</option>
                                                                    <option value="SK">Sikkim</option>
                                                                    <option value="TN">Tamil Nadu</option>
                                                                    <option value="TG">Telangana</option>
                                                                    <option value="TR">Tripura</option>
                                                                    <option value="UP">Uttar Pradesh</option>
                                                                    <option value="UT">Uttarakhand</option>
                                                                    <option value="WB">West Bengal</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="HQ">Head Quater Name</label>
                                                                <select class="form-select HQ" name="country-state">
                                                                    <option value="">-- select HQ -- </option>
                                                                    <option value="AMRITSAR">AMRITSAR</option>
                                                                    <option value="AURANGABAD">AURANGABAD</option>
                                                                    <option value="BANGALORE">BANGALORE</option>
                                                                    <option value="BELGAUM">BELGAUM</option>
                                                                    <option value="BHOPAL">BHOPAL</option>
                                                                    <option value="CHENNAI">CHENNAI</option>
                                                                    <option value="COMIMATORE">COMIMATORE</option>
                                                                    <option value="DAVANGIRI">DAVANGIRI</option>
                                                                    <option value="DELHI">DELHI</option>
                                                                    <option value="GORGAON">GORGAON</option>
                                                                    <option value="HISAR">HISAR</option>
                                                                    <option value="HUBLI">HUBLI</option>
                                                                    <option value="INDORE">INDORE</option>
                                                                    <option value="JABALPUR">JABALPUR</option>
                                                                    <option value="JAIPUR">JAIPUR</option>
                                                                    <option value="JALANDHAR">JALANDHAR</option>
                                                                    <option value="JAMMU">JAMMU</option>
                                                                    <option value="JODHPUR">JODHPUR</option>
                                                                    <option value="KARNAL">KARNAL</option>
                                                                    <option value="LUCKNOW">LUCKNOW</option>
                                                                    <option value="LUDHIANA">LUDHIANA</option>
                                                                    <option value="MADURAI">MADURAI</option>
                                                                    <option value="MEERUT">MEERUT</option>
                                                                    <option value="NASHIK">NASHIK</option>
                                                                    <option value="PANIPAT">PANIPAT</option>
                                                                    <option value="PONDICHERRY">PONDICHERRY</option>
                                                                    <option value="RAIPUR">RAIPUR</option>
                                                                    <option value="TRICHY">TRICHY</option>
                                                                    <option value="UDAIPUR">UDAIPUR</option>
                                                                    <option value="VARANASI">VARANASI</option>
                                                                    <option value="YAMUNA NAGAR">YAMUNA NAGAR</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                 <label class="form-label">Zone</label>
                                                                <select class="form-select">
                                                                    <option value="East">East</option>
                                                                    <option value="West">West</option>
                                                                    <option value="North">North</option>
                                                                    <option value="South">South</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="progress-bank-detail">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Reporting Details</h5>
                                                    <p class="card-title-desc">Fill all information below</p>
                                                </div>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Reporting Manager Name</label>
                                                                <select class="form-select">
                                                                    <option selected>--Select Employee Designation--</option>
                                                                    <option value="AE">type 1</option>
                                                                    <option value="VI">type 2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Credit Card Type</label>
                                                                <select class="form-select">
                                                                    <option selected>Select Card Type</option>
                                                                    <option value="AE">American Express</option>
                                                                    <option value="VI">Visa</option>
                                                                    <option value="MC">MasterCard</option>
                                                                    <option value="DI">Discover</option>
                                                                </select>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="progresspill-cardno-input" class="form-label">Reporting to Employee Code</label>
                                                                <input type="text" class="form-control" id="progresspill-cardno-input">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">CFA Name</label>
                                                                <select class="form-select">
                                                                    <option selected>--Select CFA Name--</option>
                                                                    <option value="AE">name 1</option>
                                                                    <option value="VI">name 2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                            <label class="form-label">CFA Location</label>
                                                                <select class="form-select">
                                                                    <option selected>--Select CFA Location--</option>
                                                                    <option value="AE">location 1</option>
                                                                    <option value="VI">location 2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </form>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                                    <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".confirmModal">Add User</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
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


<!-- twitter-bootstrap-wizard js -->
<script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- form wizard init -->
<script src="assets/js/pages/form-wizard.init.js"></script>

<!-- <script src="assets/js/pages/districts.js"></script> -->

<script src="assets/js/app.js"></script>

</body>

</html>