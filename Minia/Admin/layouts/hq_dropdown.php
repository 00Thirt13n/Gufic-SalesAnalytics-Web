<!-- /* <?php  
    // include 'layouts/session.php';
    // require_once "layouts/config.php";

    //echo(print_r($_REQUEST,true));

//             $sql = "SELECT DISTINCT HQ FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA ";

//             $hq_array = mysqli_query($link, $sql);

// ?> 

<div class="row mt-4">
     <div class="btn-group">
        <select id="AllHQ" onchange="AllHQ(this.value)"  class="form-select" aria-label="Default select example">
        <option value="">All HQ</option>
            <?php
                // while ($row = $hq_array->fetch_array(MYSQLI_ASSOC)) {
                // echo "<script>console.log(".$row['HQ'].")</script>";
            ?>

                <option class="dropdown-item" id="hq" value="<?php //echo $row['HQ'] ?>"> <?php //echo  $row['HQ'] ?> </option>
            <?php
            //} ?>

        </select>
    </div>

                          
</div>


<script>


function AllHQ(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('HQ',value);
    window.location.href=url;
    window.location.replace(url);
       
};

</script>*/ -->





<?php  
    include 'layouts/session.php';
    require_once "layouts/config.php";

    //echo(print_r($_REQUEST,true));

    class dropdown{

        public function GetCFA($link,$hq_id) {
            $sql = 
            "SELECT DISTINCT ME.MEMPLOYEE_ID AS ID,GE.HQ AS HQ 
            FROM MILJON_EMPLOYEE ME INNER JOIN GUFIC_EMPLOYEE GE ON GE.`EMP CODE` = ME.EMPLOYEE_CODE
            INNER JOIN RAW_ORDER_DATA RAW ON RAW.HQ =GE.HQ
            WHERE GE.HQ LIKE'%$hq_id%'";

            $employee_array = mysqli_query($link, $sql);
            return $employee_array;
        }
        
    }




    $obj = new dropdown();

    $data;
    if(isset($_GET['ID']) && $_GET['ID']!="")
    {
        $emp_session = $_GET['ID'];  
    }
    else
    {
        $emp_session =  $_SESSION['ID'];
    }

        $CFA_array = $obj->GetCFA($link,'');

?> 

<div class="row mt-4">
     <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
        <select id="AllCFA" onchange="AllHQ(this.value)"  class="form-select" aria-label="Default select example">
        <option value="">All HQ</option>
            <?php
                while ($row = $CFA_array->fetch_array(MYSQLI_ASSOC)) {
                 echo "<script>console.log(".$row['HQ'].")</script>";

            ?>
                <option class="dropdown-item" id="hq" value="<?php echo $row['ID'] ?>" <?php echo (isset($_GET['ID']) && $_GET['ID']!=="" && $row['ID']==$_GET['ID']  )  ?  "selected": ""; ?>> <?php echo $row['HQ'] ?> </option>
            <?php
            } ?>

        </select>
    </div>

                          
</div>


<script>


function AllHQ(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('HQ',value);
    window.location.href=url;
    window.location.replace(url);
       
};

</script>