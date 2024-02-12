<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Incentive-Simulator | Mediola</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        input:hover,
        select:hover {
            cursor: pointer
        }

        .percentage {
            position: relative;
            right: 50px;
        }

        label {
            font-weight: 400;
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
                            <h4 class="mb-sm-0 font-size-18">Incentive-Simulator</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Incentive</a></li>
                                    <li class="breadcrumb-item active">Simulator</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="border rounded-2 p-3 ">
                    <div class="row ">
                        <div class="col-lg-6 col-sm-12 mt-2">
                            <fieldset>
                                <span class="mx-1"><input type="radio" class="mx-1" name="duration" value="current-month" id="curr-month"><label for="curr-month">Current-Month</label></span>
                                <span class="mx-1"><input type="radio" class="mx-1" name="duration" value="quater1" id="q1"><label for="q1">Quater1</label></span>
                                <span class="mx-1"><input type="radio" class="mx-1" name="duration" value="quater2" id="q2"><label for="q2">Quater2</label></span>
                                <span class="mx-1"><input type="radio" class="mx-1" name="duration" value="quater3" id="q3"><label for="q3">Quater3</label></span>
                                <span class="mx-1"><input type="radio" class="mx-1" name="duration" value="quater4" id="q4"><label for="q4">Quater4</label></span>
                                <span class="mx-1"><input type="radio" class="mx-1" name="duration" value="ytd" id="ytd"><label for="ytd">YTD</label></span>
                            </fieldset>
                        </div>
                        <div class="col-lg-2 col-sm-4 ">
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" id="datepicker" name="date">
                        </div>
                        <div class="col-lg-2 col-sm-4 ">
                            <select class="form-select">
                                <option>Division</option>
                                <option>Division 1</option>
                                <option>Division 2</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-4 ">
                            <input type="text" class="form-control" name="emp_id" id="emp_id" placeholder="Employee Code">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-4 col-sm-4 d-flex">
                            <lable for="emp_name " class="pt-2 mx-3">Employee: </lable>
                            <input type="text" name="emp_name" id="emp_name" class="form-control bg-transparent" value="Sandip Patel" readonly>
                        </div>
                        <div class="col-lg-4 col-sm-4 d-flex">
                            <lable for="emp_hq" class="pt-2 mx-3">Headquater: </lable>
                            <input type="text" name="emp_hq" id="emp_name" class="form-control bg-transparent" value="Ahmedabad" readonly>
                        </div>
                        <div class="col-lg-4 col-sm-4 d-flex">
                            <lable for="emp_ds" class="pt-2 mx-3">Designation: </lable>
                            <input type="text" name="emp_ds" id="emp_name" class="form-control bg-transparent" value="ME" readonly>
                        </div>
                    </div>

                </div>




                <div class="border rounded-2 pt-3">

                    <div class="row mx-1 ">
                        <div class="col-lg-2 col-sm-4 border p-0">
                            <div class="bg-info p-2 ">Desire % to achive</div>
                            <div class="p-2 my-3">Particulars</div>
                        </div>

                        <div class="col-lg-2 col-sm-4 border p-0">
                            <form>
                                <div class="d-flex">
                                    <input type="number" max="100" step="0.01" onkeypress="if(this.value.length>2) return false;" class="form-control" />
                                    <span class="my-2 percentage">%</span>
                                    <input type="submit" value="Go" class="bg-info px-3 rounded-2" />
                                </div>
                            </form>
                            <div class="p-2 my-3">Overall</div>
                        </div>


                        <form class="col-lg-2 col-sm-4 border p-0">
                            <div class="d-flex">
                                <input type="number" max="100" step="0.01" onkeypress="if(this.value.length>2) return false;" class="form-control" />
                                <span class="my-2 percentage">%</span>
                                <input type="submit" value="Go" class="bg-info px-3 rounded-2" />
                            </div>

                            <div class="d-flex">
                                <select class="form-select">
                                    <option>Focus Brand</option>
                                    <option>Focus Brand 1</option>
                                    <option>Focus Brand 2</option>
                                </select>
                                <span class="mx-auto"></span>
                                <input type="reset" class="bg-info rounded-2 px-2" value="Clear">
                            </div>

                            <div class="dropdown">
                                <select class="form-select">
                                    <option>Levenue</option>
                                    <option>Levenue 1</option>
                                    <option>Levenue 2</option>
                                </select>
                            </div>

                        </form>


                        <form class="col-lg-2 col-sm-4 border p-0">
                            <div class="d-flex">
                                <input type="number" max="100" step="0.01" onkeypress="if(this.value.length>2) return false;" class="form-control" />
                                <span class="my-2 percentage">%</span>
                                <input type="submit" value="Go" class="bg-info px-3 rounded-2" />
                            </div>

                            <div class="d-flex">
                                <select class="form-select">
                                    <option>Focus Brand</option>
                                    <option>Focus Brand 1</option>
                                    <option>Focus Brand 2</option>
                                </select>
                                <span class="mx-auto"></span>
                                <input type="reset" class="bg-info rounded-2 px-2" value="Clear">
                            </div>

                            <select class="form-select">
                                <option>Levenue</option>
                                <option>Levenue 1</option>
                                <option>Levenue 2</option>
                            </select>

                        </form>



                        <form class="col-lg-2 col-sm-4 border p-0">
                            <div class="d-flex">
                                <input type="number" max="100" step="0.01" onkeypress="if(this.value.length>2) return false;" class="form-control" />
                                <span class="my-2 percentage">%</span>
                                <input type="submit" value="Go" class="bg-info px-3 rounded-2" />
                            </div>

                            <div class="d-flex">
                                <select class="form-select">
                                    <option>Focus Brand</option>
                                    <option>Focus Brand 1</option>
                                    <option>Focus Brand 2</option>
                                </select>
                                <span class="mx-auto"></span>
                                <input type="reset" class="bg-info rounded-2 px-2" value="Clear">
                            </div>

                            <select class="form-select">
                                <option>Levenue</option>
                                <option>Levenue 1</option>
                                <option>Levenue 2</option>
                            </select>

                        </form>


                        <form class="col-lg-2 col-sm-4 border p-0">
                            <div class="d-flex">
                                <input type="number" max="100" step="0.01" onkeypress="if(this.value.length>2) return false;" class="form-control" />
                                <span class="my-2 percentage">%</span>
                                <input type="submit" value="Go" class="bg-info px-3 rounded-2" />
                            </div>

                            <div class="d-flex">
                                <select class="form-select">
                                    <option>Focus Brand</option>
                                    <option>Focus Brand 1</option>
                                    <option>Focus Brand 2</option>
                                </select>
                                <span class="mx-auto"></span>
                                <input type="reset" class="bg-info rounded-2 px-2" value="Clear">
                            </div>

                            <select class="form-select">
                                <option>Levenue</option>
                                <option>Levenue 1</option>
                                <option>Levenue 2</option>
                            </select>

                        </form>


                    </div>




                    <div class="row mx-1">
                        <table class="table table-bordered table-striped">

                            <thead>
                                <div class="row border p-2 mx-auto mt-1 bg-info">Values in Lacs</div>
                            </thead>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Target</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Sales</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Achievement %</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Groth %</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">PCPM</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Remaining Sales to be achieved</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">No. of month left</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Required run rate to achieve target per month</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                        </table>


                        <table class="table table-bordered table-striped">

                            <thead>
                                <div class="row border p-2 mx-auto mt-1 bg-info">Units in actual</div>
                            </thead>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Target</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Sales</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Achievement %</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">Groth %</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                            <tr>
                                <td class="col-lg-2 col-sm-2">PCPM</td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                                <td class="col-lg-2 col-sm-2"></td>
                            </tr>
                        </table>
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

</body>

</html>