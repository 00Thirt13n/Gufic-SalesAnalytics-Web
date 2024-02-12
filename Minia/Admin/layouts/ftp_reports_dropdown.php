<?php  
    include 'layouts/session.php';
    require_once "layouts/config.php";

    //echo(print_r($_REQUEST,true));
            $sql = "SELECT FTP_SUB_REPORT FROM MELJOHN_UPLOAD_SATISH.ftp_sales_report;";
            $employee_array = mysqli_query($link, $sql);
       
?> 

<div class="row mt-4">
     <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
        <select id="ftp_sales_report" onchange=""  class="form-select" aria-label="Default select example">
        <option value="%%">ftp_sales_report</option>
            <?php
                while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="ftp_sales_report" value="<?php echo $row['FTP_SUB_REPORT'] ?>"> <?php echo $row['FTP_SUB_REPORT'] ?> </option>
            <?php
            } ?>

        </select>
    </div>                          
</div>


