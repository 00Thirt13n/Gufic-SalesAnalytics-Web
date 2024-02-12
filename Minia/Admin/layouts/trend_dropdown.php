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
    // if(!isset($_GET['KAM'])||!isset($_GET['KAM'])||!isset($_GET['KAM'])||!isset($_GET['KAM']))
    // {
    //     $emp_session = $_SESSION['user_id'];

    // }
    //echo $emp_session;

    //$emp_session = $_SESSION['user_id'];
        //$emp_session = 'MEMP_G_21';
        $Employee  = $obj->GetEmployeeDesignation($link,$emp_session);
        // if($Employee == 'MEDM_2' ||$Employee == 'MEDM_16' ||$Employee == 'MEDM_15'  ){
        //     $emp_session = 'MEMP_G_54';
        //     // echo $emp_session;
        // }            
        //echo $emp_session;
        // echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";

        $ZBM_a = $obj->GetEmployeeID($link,'MEDM_13',((isset($_GET['ABM']) && $_GET['ABM']!="")? $_GET['ABM'] : ((isset($_GET['RBM']) && $_GET['RBM']!="") ? $_GET['RBM'] : ((isset($_GET['ZBM']) && $_GET['ZBM']!="") ? $_GET['ZBM'] : $emp_session))));
        echo "<script>console.log('RBM_a : ".$ZBM_a."')</script>";

        echo "<script>console.log('session : ".$emp_session."')</script>";
        echo "<script>console.log('USER : ".$_SESSION['user_id']."')</script>";
        echo "<script>console.log('ZBM : ".$_GET['ZBM']."')</script>";
        echo "<script>console.log('RBM : ".$_GET['RBM']."')</script>";
        echo "<script>console.log('ABM : ".$_GET['ABM']."')</script>";
        echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";
        
/*
            if ho then as  zbm 
                        -- zbm 
                            if rbm selected then for that zbm get all rbm in dropdown 
                            -- rbm 
                                if abm selected then for that rbm get all abm in dropdown 
// */
// echo "<script>console.log('ZBM_array : ".(isset($_GET['ZBM']) && $_GET['ZBM']!="")?  $emp_session : $_SESSION['user_id']."')</script>";
// echo "<script>console.log('RBM_array : ".(isset($_GET['RBM']) && $_GET['RBM']!="")?  $emp_session : $_SESSION['user_id']."')</script>";
// echo "<script>console.log('ABM_array : ".(isset($_GET['ABM']) && $_GET['ABM']!="")?  $emp_session : $_SESSION['user_id']."')</script>";
// echo "<script>console.log('KAM_array : ".(isset($_GET['KAM']) && $_GET['KAM']!="")?  $emp_session : $_SESSION['user_id']."')</script>";






// $_SESSION['user_id']

        $ZBM_array = $obj->GetEmployeeArray($link,'MEDM_2', (isset($_GET['ZBM']) && $_GET['ZBM']!="")? $_GET['ZBM'] : $_SESSION['user_id']);
        $RBM_array = $obj->GetEmployeeArray($link,'MEDM_8', (isset($_GET['ZBM']) && $_GET['ZBM']!="")? $_GET['ZBM'] : $_SESSION['user_id']);
        $ABM_array = $obj->GetEmployeeArray($link,'MEDM_12',(isset($_GET['RBM']) && $_GET['RBM']!="")? $_GET['RBM'] : ((isset($_GET['ZBM']) && $_GET['ZBM']!="") ? $_GET['ZBM'] : $emp_session));
        $KBM_array = $obj->GetEmployeeArray($link,'MEDM_13',((isset($_GET['ABM']) && $_GET['ABM']!="")? $_GET['ABM'] : ((isset($_GET['RBM']) && $_GET['RBM']!="") ? $_GET['RBM'] : ((isset($_GET['ZBM']) && $_GET['ZBM']!="") ? $_GET['ZBM'] : $emp_session))));
        
        // $ZBM_array = $obj->GetEmployeeArray($link,'MEDM_2',  $emp_session);
        // $RBM_array = $obj->GetEmployeeArray($link,'MEDM_8',  $emp_session);
        // $ABM_array = $obj->GetEmployeeArray($link,'MEDM_12', $emp_session);
        // $KBM_array = $obj->GetEmployeeArray($link,'MEDM_13', $emp_session);


?> 

<div class="row mt-4">
     <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
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

    <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
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
    <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
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
    <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
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
                                    
</div>


<script>


// $(document).ready(function() {
//     $('#rbm').val( document.getElementById('zbm').value); 

//     $('dropdown-item').load(function() {
//       $('#rbm').val( document.getElementById('zbm').value); 
//       return false;
//     });
// });

function AllZBM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('ZBM',value);
    window.location.href=url;
    window.location.replace(url);

    // if(document.getElementById('AllZBM').value != 'All ZBM'){
    //     document.getElementById('AllRBM').removeAttribute('disabled');
    //     console.log( document.getElementById('zbm').value);
    // }
    // else{
    //     document.getElementById('AllRBM').setAttribute('disabled', '');
    //     document.getElementById('AllABM').setAttribute('disabled', '');
    //     document.getElementById('AllKBM').setAttribute('disabled', '');
    // }
       
};

function AllRBM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('RBM',value);
    url.searchParams.set('ABM','');
    url.searchParams.set('KAM','');

    window.location.href=url;
    window.location.replace(url);

    // if(document.getElementById('AllRBM').value != 'All RBM'){
    //     document.getElementById('AllABM').removeAttribute('disabled');
    //     console.log( document.getElementById('rbm').value);

    // }
    // else{
    //     document.getElementById('AllABM').setAttribute('disabled', '');
    //     document.getElementById('AllKBM').setAttribute('disabled', '');
    // }
        
};

 function AllABM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('ABM',value);
    url.searchParams.set('KAM','');
    window.location.href=url;
    window.location.replace(url);

//     if(document.getElementById('AllABM').value != 'All ABM'){
//         document.getElementById('AllKBM').removeAttribute('disabled');
//         console.log( document.getElementById('zbm').value);
//     }
//     else
//         document.getElementById('AllKBM').setAttribute('disabled', '');
};



function AllKAM(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('KAM',value);
    window.location.href=url;
    window.location.replace(url);

};
</script>