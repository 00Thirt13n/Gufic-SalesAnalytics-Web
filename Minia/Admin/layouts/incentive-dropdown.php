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
        
    $ZBM_array = $obj->GetEmployeeArray($link,'MEDM_2',$emp_session);
    
    $RBM_array = $obj->GetEmployeeArray($link,'MEDM_8',$emp_session);
    
    $ABM_array = $obj->GetEmployeeArray($link,'MEDM_12',$emp_session);
    
    $KBM_array = $obj->GetEmployeeArray($link,'MEDM_13',$emp_session);


?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<div class="row mt-4">
     <div class="btn-group col-lg-2 col-md-4 col-sm-6 mb-1">
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

    <div class="btn-group col-lg-2 col-md-4 col-sm-6 mb-1">
        <select id="AllRBM" onchange="AllRBM(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All RBM</option>
            <?php
                while ($row = $RBM_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item"  id="rbm" value="<?php echo $row['MEMPLOYEE_ID'] ?>" <?php echo $row['MEMPLOYEE_ID'] == $emp_session || $Employee=='MEDM_12'|| $Employee=='MEDM_13' || (isset($_GET['RBM']) && $row['MEMPLOYEE_ID'] == $_GET['RBM'] )  ?  "selected": ""; ?>><?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>

        </select>
    </div>
    <div class="btn-group col-lg-2 col-md-4 col-sm-6 mb-1">
        <select id="AllABM" onchange="AllABM(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All ABM</option>

            <?php
                while ($row = $ABM_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="abm" value="<?php echo $row['MEMPLOYEE_ID'] ?>" <?php echo $row['MEMPLOYEE_ID'] == $emp_session  || $Employee=='MEDM_13' || (isset($_GET['ABM']) && $row['MEMPLOYEE_ID'] == $_GET['ABM'] )  ?  "selected": ""; ?>><?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>
        </select>
    </div>
    <div class="btn-group col-lg-2 col-md-4 col-sm-6 mb-1">
        <select id="AllKBM" onchange="AllKAM(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All KAM</option>

            <?php

                while ($row = $KBM_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="kam" value="<?php echo $row['MEMPLOYEE_ID'] ?>"  <?php echo $row['MEMPLOYEE_ID'] == $emp_session || (isset($_GET['KAM']) && $row['MEMPLOYEE_ID'] == $_GET['KAM'] )  ?  "selected": ""; ?>><?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>
        </select>
    </div>
    <div class="btn-group col-lg-2 col-md-4 col-sm-6 mb-1">
        <select id="period" class="form-select" aria-label="Default select example">
            <option value="">Current Month</option>
            <option value="">Quater 1</option>
            <option value="">Quater 2</option>
            <option value="">Quater 3</option>
            <option value="">Quater 4</option>
            <option value="">YTD</option>
        </select>
    </div>
    <div class="btn-group col-lg-2 col-md-4 col-sm-6 mb-1">
        <select id="year"class="form-select" aria-label="Default select example">
            <option value="2000">Year</option>
        </select>
    </div>
                                    
</div>


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
    window.location.href=url;
    window.location.replace(url);
};

 function AllABM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('ABM',value);
    window.location.href=url;
    window.location.replace(url);
};



function AllKAM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('KAM',value);
    window.location.href=url;
    window.location.replace(url);

};


</script>


<!-- Year dropdown -->
<script>
    
    let dateDropdown = document.getElementById('year');

let currentYear = new Date().getFullYear();
let earliestYear = 2000;

while (currentYear >= earliestYear) {
  let dateOption = document.createElement('option');
  dateOption.text = currentYear;
  dateOption.value = currentYear;
  dateDropdown.add(dateOption);
  currentYear -= 1;
}
</script>