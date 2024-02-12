<?php include 'layouts/session.php'; 
      include 'layouts/head-main.php'; 
      require_once "layouts/config.php";
?>
      
?>


<head>

    <title>Incentive-Simulator | Mediola</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- select2-bootstrap4-theme -->
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet"> <!-- for live demo page -->
    <link href="select2-bootstrap4.css" rel="stylesheet"> <!-- for local development env -->

    <style>

.wrapper {
  max-width: 75%;
  margin: auto;
}

h3 {
  color: #000000;
  margin: 40px 0;
  padding: 0;
  font-size: 28px;
  text-align: center;
}

select {
  width: 100%;
  min-height: 100px;
  border-radius: 3px;
  border: 1px solid #444;
  padding: 10px;
  color: #444444;
  font-size: 14px;
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




                <form action="" method="post">
                <div class="row mt-5" >
                    <div class="form-group col-lg-2 col-sm-6 col-md-mt-2">
                        <select multiple placeholder="Select Employee" data-allow-clear="1">
                            <?php
                                $emp_id = $user_id;
                                $query = "SELECT * FROM MELJOHN_UPLOAD_SATISH.MILJON_EMPLOYEE where find_in_set(MEMPLOYEE_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))";
                                $users = mysqli_query($link, $query);
                                foreach ($users as $row) {
                            ?>
                                    <option value="<?php echo $row['MEMPLOYEE_ID'] ?>"><?php echo $row['LST_NAME']. ' '. $row['FST_NAME'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-lg-2 col-sm-6 col-md-mt-2">
                        <select multiple placeholder="Select Division" data-allow-clear="1">
                            <option value="Aesthaderm">Aesthaderm</option>
                            <option value="Critimax>">Critimax</option>
                            <option value="Ferticare">Ferticare</option>
                            <option value="Ferticare Hybrid">Ferticare option</li>
                            <option value="Ferticare Life">Ferticare option</li>
                            <option value="Mycocare">Mycocare</option>
                            <option value="Primacare">Primacare</option>
                            <option value="Spark">Spark</option>
                            <option value="Stellar">Stellar</option>
                        </select>
                    </div>

                    
                    <div class="form-group col-lg-2 col-sm-6 col-md-mt-2">
                        <select placeholder="Select Period" data-allow-clear="1">
                            <option value="null">Select Period </option>
                            <option value="month">Current Month</option>
                            <option value="q1">Quater 1</option>      
                            <option value="q2">Quater 2</option>
                            <option value="q3">Quater 3</option>
                            <option value="q4">Quater 4</option>
                            <option value="q12">April-September</option>
                            <option value="q34">October-March</option>
                            <option value="year">Year</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-sm-6 col-md-mt-2">
                        <input type="text" name="target" class="form-control" placeholder="Target in Value">
                    </div>

                    <div class="col-lg-2 col-sm-6 col-md-mt-2">
                        <input type="text" name="achievement" class="form-control" placeholder="Achievement in Value">
                    </div>

                    <div class="col-lg-2 col-sm-6 col-md-mt-2">
                        <button type="submit" class="btn btn-primary py-2">Predict Incentive</button>
                    </div>

                    </div>

                    
                </form>




                 <div class="row mt-5">
                    <div class="col-6 mx-auto mt-5">
                        <table class="table table-hover table-striped border shadow">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Slab</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Varience</td>
                                    <td>120000 Rs</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Apprx. Incentive</td>
                                    <td>16000</td>
                                </tr>
                            </tbody>
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script>
    $(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
});

</script>

</html>