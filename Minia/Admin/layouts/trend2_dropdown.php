<?php  
    include 'layouts/session.php';
    require_once "layouts/config.php";

    //echo(print_r($_REQUEST,true));

    class dropdown{

        public function GetEmployeeDesignation($link,$emp_id) {
            $sql = 
            "SELECT DM.NAME ,DM.MEDM_ID
            FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
            INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
            WHERE MEMP.MEMPLOYEE_ID ='$emp_id'
            GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";

            $employee_array = mysqli_query($link, $sql);
            while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
                return $row['MEDM_ID'];
            }

        }
        
        public function GetEmployeeArray($link,$designation_id,$emp_id) {

            $sql = 
            "SELECT DM.NAME, MEMP.MEMPLOYEE_ID, concat((CASE WHEN MEMP.STATUS='ACTIVE' THEN CONCAT(MEMP.LST_NAME, ' ' , MEMP.FST_NAME)ELSE 'VACANT'END),' ( ',HQ.HQ,' )' ) as FULL_NAME 
            FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
            INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
            INNER  JOIN `GUFIC_EMPLOYEE` `HQ` ON ((`MEMP`.`EMPLOYEE_CODE` = `HQ`.`EMP CODE`))

            WHERE (DM.MEDM_ID = '$designation_id') 
            and   (find_in_set(MEMP.MEMPLOYEE_ID, ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id'),'$emp_id') ))
            GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";

            $employee_array = mysqli_query($link, $sql);

            if(mysqli_num_rows($employee_array) > 0) {

                return $employee_array;
            }
            else{

                    $sql = 
                    "SELECT DM.NAME, MEMP.MEMPLOYEE_ID, concat((CASE WHEN MEMP.STATUS='ACTIVE' THEN CONCAT(MEMP.LST_NAME, ' ' , MEMP.FST_NAME)ELSE 'VACANT'END),' ( ',HQ.HQ,' )') as FULL_NAME 
                    FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
                    INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID
                    INNER  JOIN `GUFIC_EMPLOYEE` `HQ` ON ((`MEMP`.`EMPLOYEE_CODE` = `HQ`.`EMP CODE`)) 
                    WHERE (DM.MEDM_ID = '$designation_id') 
                    and   (find_in_set(MEMP.MEMPLOYEE_ID, ifnull(GET_MILJON_EMPLOYEE_MANAGERS_DETAILS_HIERARCHY_WEB('$emp_id'),'$emp_id') ))
                    GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";
                    $employee_array = mysqli_query($link, $sql);
                    return $employee_array;
            }
        }     



        public function GetEmployeeID($link,$designation_id,$emp_id) {

            $sql = 
            "SELECT DM.NAME, MEMP.MEMPLOYEE_ID, concat((CASE WHEN MEMP.STATUS='ACTIVE' THEN CONCAT(MEMP.LST_NAME, ' ' , MEMP.FST_NAME)ELSE 'VACANT'END),' ( ',HQ.HQ,' )' ) as FULL_NAME 
            FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
            INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
            INNER  JOIN `GUFIC_EMPLOYEE` `HQ` ON ((`MEMP`.`EMPLOYEE_CODE` = `HQ`.`EMP CODE`))

            WHERE (DM.MEDM_ID = '$designation_id') 
            and   (find_in_set(MEMP.MEMPLOYEE_ID, ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id'),'$emp_id') ))
            GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";

            $employee_array = mysqli_query($link, $sql);

            if(mysqli_num_rows($employee_array) > 0) {

                while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
                    return $row['MEMPLOYEE_ID'];
                }
            }
            else{

                    $sql = 
                    "SELECT DM.NAME, MEMP.MEMPLOYEE_ID, concat((CASE WHEN MEMP.STATUS='ACTIVE' THEN CONCAT(MEMP.LST_NAME, ' ' , MEMP.FST_NAME)ELSE 'VACANT'END),' ( ',HQ.HQ,' )') as FULL_NAME 
                    FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
                    INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID
                    INNER  JOIN `GUFIC_EMPLOYEE` `HQ` ON ((`MEMP`.`EMPLOYEE_CODE` = `HQ`.`EMP CODE`)) 
                    WHERE (DM.MEDM_ID = '$designation_id') 
                    and   (find_in_set(MEMP.MEMPLOYEE_ID, ifnull(GET_MILJON_EMPLOYEE_MANAGERS_DETAILS_HIERARCHY_WEB('$emp_id'),'$emp_id') ))
                    GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";
                    $employee_array = mysqli_query($link, $sql);
                    while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
                        return $row['MEMPLOYEE_ID'];
                    }
                }
        }


    }




    $obj = new dropdown();

    $data;
    if(isset($_GET['KAM']) && $_GET['KAM']!="")
    {
        $emp_session = $_GET['KAM'];  
    }else if(isset($_GET['ABM']) && $_GET['ABM']!="")
    {
        $emp_session = $_GET['ABM'];  
     }else if(isset($_GET['RBM']) && $_GET['RBM']!="")
    {
        $emp_session = $_GET['RBM'];    
    }else if(isset($_GET['ZBM']) && $_GET['ZBM']!="")
    {
        $emp_session = $_GET['ZBM'];  
    }
    else{
        $emp_session =  $_SESSION['user_id'];
    }
        $Employee  = $obj->GetEmployeeDesignation($link,$emp_session);

        $ZBM_a = $obj->GetEmployeeID($link,'MEDM_13',((isset($_GET['ABM']) && $_GET['ABM']!="")? $_GET['ABM'] : ((isset($_GET['RBM']) && $_GET['RBM']!="") ? $_GET['RBM'] : ((isset($_GET['ZBM']) && $_GET['ZBM']!="") ? $_GET['ZBM'] : $emp_session))));
        echo "<script>console.log('RBM_a : ".$ZBM_a."')</script>";

        echo "<script>console.log('session : ".$emp_session."')</script>";
        echo "<script>console.log('USER : ".$_SESSION['user_id']."')</script>";
        echo "<script>console.log('ZBM : ".$_GET['ZBM']."')</script>";
        echo "<script>console.log('RBM : ".$_GET['RBM']."')</script>";
        echo "<script>console.log('ABM : ".$_GET['ABM']."')</script>";
        echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";
        
        $ZBM_array = $obj->GetEmployeeArray($link,'MEDM_2', (isset($_GET['ZBM']) && $_GET['ZBM']!="")? $_GET['ZBM'] : $_SESSION['user_id']);
        $RBM_array = $obj->GetEmployeeArray($link,'MEDM_8', (isset($_GET['ZBM']) && $_GET['ZBM']!="")? $_GET['ZBM'] : $_SESSION['user_id']);
        $ABM_array = $obj->GetEmployeeArray($link,'MEDM_12',(isset($_GET['RBM']) && $_GET['RBM']!="")? $_GET['RBM'] : ((isset($_GET['ZBM']) && $_GET['ZBM']!="") ? $_GET['ZBM'] : $emp_session));
        $KBM_array = $obj->GetEmployeeArray($link,'MEDM_13',((isset($_GET['ABM']) && $_GET['ABM']!="")? $_GET['ABM'] : ((isset($_GET['RBM']) && $_GET['RBM']!="") ? $_GET['RBM'] : ((isset($_GET['ZBM']) && $_GET['ZBM']!="") ? $_GET['ZBM'] : $emp_session))));


?> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="row mt-4">
     <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select id="AllZBM" onchange="AllZBM(this.value)"  class="form-select" aria-label="Default select example">
        <option value="">All ZBM</option>
            <?php
                while ($row = $ZBM_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="zbm" value="<?php echo $row['MEMPLOYEE_ID'] ?>" <?php echo $row['MEMPLOYEE_ID'] == $emp_session || $Employee=='MEDM_8'|| $Employee=='MEDM_12'|| $Employee=='MEDM_13' || (isset($_GET['ZBM']) && $row['MEMPLOYEE_ID'] == $_GET['ZBM'] )  ?  "selected": ""; ?>> <?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>

        </select>
    </div>

    <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select id="AllRBM" onchange="AllRBM(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All RBM</option>
            <?php
                while ($row = $RBM_array->fetch_array(MYSQLI_ASSOC)) {
                    // echo "<script>console.log('RBM : ".$row['MEMPLOYEE_ID']." EMP : ".$Employee." RBM : ".$_GET['RBM']."')</script>";

            ?>
                <!-- <option class="dropdown-item"  id="rbm" value="<?php //echo $row['MEMPLOYEE_ID'] ?>" <?php //echo $row['MEMPLOYEE_ID'] == $_GET['RBM'] || $row['MEMPLOYEE_ID'] == $emp_session || $Employee=='MEDM_12'|| $Employee=='MEDM_13' || (isset($_GET['RBM']) && $row['MEMPLOYEE_ID'] == $_GET['RBM'] )  ?  "selected": ""; ?>><?php //echo $row['FULL_NAME'] ?> </option> -->
                <option class="dropdown-item"  id="rbm" value="<?php echo $row['MEMPLOYEE_ID'] ?>" <?php echo  (isset($_GET['RBM']) && $row['MEMPLOYEE_ID'] == $_GET['RBM'] )  ?  "selected": ""; ?>><?php echo $row['FULL_NAME'] ?> </option>

           <?php
            } ?>

        </select>
    </div>
    <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select id="AllABM" onchange="AllABM(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All ABM</option>

            <?php
                while ($row = $ABM_array->fetch_array(MYSQLI_ASSOC)) {
                    // echo "<script>console.log('ABM : ".$row['MEMPLOYEE_ID']." EMP : ".$Employee." ABM : ".$_GET['ABM']."')</script>";

            ?>
                <option class="dropdown-item" id="abm" value="<?php echo $row['MEMPLOYEE_ID'] ?>" <?php echo (isset($_GET['ABM']) && $row['MEMPLOYEE_ID'] == $_GET['ABM'] )  ?  "selected": ""; ?>><?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>
        </select>
    </div>
    <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select id="AllKBM" onchange="AllKAM(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All KAM</option>

            <?php

                while ($row = $KBM_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="kam" value="<?php echo $row['MEMPLOYEE_ID'] ?>"  <?php echo (isset($_GET['KAM']) && $row['MEMPLOYEE_ID'] == $_GET['KAM'] )  ?  "selected": ""; ?>><?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>
        </select>
    </div>

     <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select class="form-select" aria-label="Default select example">
            <option name="" value="" style="display:none;">Select Month</option>
            <option name="January" value="Jan">January</option>
            <option name="February" value="Feb">February</option>
            <option name="March" value="Mar">March</option>
            <option name="April" value="Apr">April</option>
                <option name="May" value="May">May</option>
            <option name="June" value="Jun">June</option>
            <option name="July" value="Jul">July</option>
            <option name="August" value="Aug">August</option>
                <option name="September" value="Sep">September</option>
            <option name="October" value="Oct">October</option>
            <option name="November" value="Nov">November</option>
            <option name="December" value="Dec">December</option>
        </select>
    </div>

    <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select class="form-select" aria-label="Default select example">
            <option name="" value="" style="display:none;">Select Quater</option>
            <option name="quater_1" value="quater_1">Quater 1</option>
            <option name="quater_2" value="quater_2">Quater 2</option>
            <option name="quater_3" value="quater_3">Quater 3</option>
            <option name="quater_4" value="quater_4">Quater 4</option>
        </select>
    </div>
    <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select class="form-select" aria-label="Default select example">
            <option name="" value="" style="display:none;">Select Half Year</option>
            <option name="half_year_1" value="half_year_1">Half Year 1 (April - Sep)</option>
            <option name="half_year_2" value="half_year_2">Half Year 2 (Oct - March)</option>
        </select>
    </div>
    <div class="btn-group col-lg-3 col-md-3 col-sm-3">
        <select id='years' class="form-select" aria-label="Default select example"> </select>
    </div>
                                    
</div>

<form method="post">
    <div class="row" >
        <div class="col-lg-3 col-md-3 col-sm-3" style="margin-top: 1.8rem;">
            <input type="text" name="city" list="products" class="form-select" aria-label="Default select example" placeholder="Select Number of Products">
            <datalist id="products">
                <option value="All">
                <option value="top_10">
                <option value="bottom_10">
            </datalist>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div>
                <div class="mb-3">
                    <label for="example-date-input" class="form-label">Start Date</label>
                    <input type="date" class="form-control" value= <?php echo date('Y-m-01')?> id="datepicker" name="start-date">
                </div>      
            </div>
        </div>      
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class=" mt-lg-0">
                <div class="mb-3">
                    <label for="example-date-input" class="form-label">End Date</label>
                    <input type="date" class="form-control" value= <?php echo date('Y-m-d')?> id="datepicker1" name="end-date">
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class=" mt-lg-0">
                <div class="mb-3" style="margin-top: 1.8rem;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

                                            <!-- if (isset($_POST['start-date'])) {
                                                $start_date = $_POST['start-date'];
                                            } else {
                                                $start_date = date('Y-m-01'); 
                                            }
                                            if (isset($_POST['end-date'])) {
                                                $end_date = $_POST['end-date'];
                                            } else {
                                                $end_date = date('Y-m-d'); // Default to today's date
                                            } -->


<script>

function AllZBM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('ZBM',value);
    window.location.href=url;
    window.location.replace(url);
       
};

function AllRBM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('RBM',value);
    url.searchParams.set('ABM','');
    url.searchParams.set('KAM','');

    window.location.href=url;
    window.location.replace(url);
        
};

 function AllABM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('ABM',value);
    url.searchParams.set('KAM','');
    window.location.href=url;
    window.location.replace(url);
};



function AllKAM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('KAM',value);
    window.location.href=url;
    window.location.replace(url);

};


var mySelect = $('#years');
var nextYear = 2022;
var prevYear = 2021;
for (var i = 0; i < 30; i++) {
  nextYear = nextYear + 1;
  prevYear = prevYear + 1;
  mySelect.append(
    $('<option></option>').val(prevYear + "-" + nextYear).html(prevYear + "-" + nextYear)
  );
}
</script>


<script>
  $(document).ready(function() {
    var table = $('#datatable-buttons').DataTable();
    
    $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-01'); ?>');
    $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>');

    $('form').submit(function() {
      table.ajax.reload();
      $('#datepicker').val('<?php echo isset($start_date) ? $start_date : date('Y-m-d'); ?>'); 
      $('#datepicker1').val('<?php echo isset($end_date) ? $end_date : date('Y-m-d'); ?>'); 
      return false;
    });
  });
</script>