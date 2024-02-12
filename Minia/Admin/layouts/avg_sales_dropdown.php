<?php  
    include 'layouts/session.php';
    require_once "layouts/config.php";

    //echo(print_r($_REQUEST,true));

    class dropdown{
    /*
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
    */

        public function GetFILTER_DATA($link,$cfa_id,$hosp_id,$hq_id,$product_id,$emp_id) {

            // echo $cfa_id,$hosp_id,$hq_id,$product_id,$emp_id;

            // echo "emp->" .' '. $emp_id ;
            

        
                $sql_prod = "select distinct p.PRODUCT_ID as product_id,p.PROD_NAME as FULL_NAME from RAW_ORDER_DATA rd
                inner join GSTMED_PRODUCT p on p.PROD_NAME = rd.PRODUCT
                where find_in_set( MEMP_ID ,ifnull((select `GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB`('$emp_id')),'$emp_id')) AND
                rd.CFA_ID like'%$cfa_id%' and rd.HQ_ID like '%$hq_id%' and rd.HOSPITAL_ID LIKE '%$hosp_id%' and rd.PRODUCT_ID LIKE '%$product_id%'";

                $sql_hq = "select distinct me.MEMPLOYEE_ID as hq_id,ge.HQ as FULL_NAME from RAW_ORDER_DATA rd inner join MILJON_EMPLOYEE me 
                on me.MEMPLOYEE_ID = rd.MEMP_ID inner join GUFIC_EMPLOYEE ge on ge.`EMP CODE` = me.EMPLOYEE_CODE
                where find_in_set( MEMP_ID ,ifnull((select `GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB`('$emp_id')),'$emp_id')) AND
                rd.CFA_ID like'%$cfa_id%' and rd.HQ_ID like '%$hq_id%' and rd.HOSPITAL_ID LIKE '%$hosp_id%' and rd.PRODUCT_ID LIKE '%$product_id%' ";

                $sql_cfa = "select distinct rd.CFA_ID as cfa_id, rd.`CFA NAME` as FULL_NAME from RAW_ORDER_DATA rd
                inner join GSTMED_EMPLOYEE cfa on cfa.EMPLOYEE_ID = rd.CFA_ID 
                where find_in_set( MEMP_ID ,ifnull((select `GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB`('$emp_id')),'$emp_id'))AND
                rd.CFA_ID like'%$cfa_id%' and rd.HQ_ID like '%$hq_id%' and rd.HOSPITAL_ID LIKE '%$hosp_id%' and rd.PRODUCT_ID LIKE '%$product_id%'";

                echo "<script>console.log('$sql_cfa')</script>";

                $sql_hosp = "select distinct rd.HOSPITAL_ID as hosp_id, rd.`HOSPITAL NAME` as FULL_NAME from RAW_ORDER_DATA rd
                inner join GSTMED_RETAILER_MASTER  chm on  chm.CHEMIST_ID = rd.HOSPITAL_ID
                where find_in_set( MEMP_ID ,ifnull((select `GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB`('$emp_id')),'$emp_id')) AND
                rd.CFA_ID like'%$cfa_id%' and rd.HQ_ID like '%$hq_id%' and rd.HOSPITAL_ID LIKE '%$hosp_id%' and rd.PRODUCT_ID LIKE '%$product_id%'";

                $sql_emp = "select distinct rd.MEMP_ID as emp_id, rd.`ORDER BY` as FULL_NAME from RAW_ORDER_DATA rd
                where find_in_set( MEMP_ID ,ifnull((select `GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB`('$emp_id')),'$emp_id')) AND
                rd.CFA_ID like'%$cfa_id%' and rd.HQ_ID like '%$hq_id%' and rd.HOSPITAL_ID LIKE '%$hosp_id%' and rd.PRODUCT_ID LIKE '%$product_id%'  ";

                $prod_array = mysqli_query($link, $sql_prod);
                $hq_array = mysqli_query($link, $sql_hq);
                $cfa_array = mysqli_query($link, $sql_cfa);
                $hosp_array = mysqli_query($link, $sql_hosp);
                $emp_array = mysqli_query($link, $sql_emp);
                $data = array($prod_array,$hq_array,$cfa_array,$hosp_array,$emp_array);
                return $data;
        }
    }


    $obj = new dropdown();

    $filter_data;
                // echo "<script>console.log('session : ".$_SESSION['user_id']."')</script>";
                // echo "<script>console.log('session : ".$_GET['emp_id']."')</script>";

                // if(isset($_GET['emp_id']) ){
                //     $emp_id = $_GET['emp_id'] ;
                    
                // }
                // else{
                //     $emp_id = $_SESSION['user_id'];
                // }


        $filter_data  = $obj->GetFILTER_DATA($link,(isset($_GET['cfa_id'])?$_GET['cfa_id'] :""),(isset($_GET['hosp_id'])?$_GET['hosp_id'] :""),
        (isset($_GET['hq_id'])?$_GET['hq_id'] :""),(isset($_GET['product_id'])?$_GET['product_id'] :""),((isset($_GET['emp_id']) && !empty($_GET['emp_id']) )?$_GET['emp_id'] :$_SESSION['user_id']));


        $prod_array = $filter_data[0];                    
        $hq_array = $filter_data[1];                    
        $cfa_array = $filter_data[2];                  
        $hosp_array = $filter_data[3];                  
        $emp_array = $filter_data[4];   

            //     while ($row = $hosp_array->fetch_array(MYSQLI_ASSOC)) {
            //          echo "<script>console.log('".$row['FULL_NAME']."')</script>";
            // } 
        

            // echo "<script>console.log('session : ".$emp_session."')</script>";
            // echo "<script>console.log('USER : ".$_SESSION['user_id']."')</script>";
            // echo "<script>console.log('ZBM : ".$_GET['ZBM']."')</script>";
            // echo "<script>console.log('RBM : ".$_GET['RBM']."')</script>";
            // echo "<script>console.log('ABM : ".$_GET['ABM']."')</script>";
            // echo "<script>console.log('KAM : ".$_GET['KAM']."')</script>";

?> 

<div class="row mt-4">
     <div class="btn-group col-lg-2 col-md-6 col-sm-6 mb-1">
        <select id="AllZBM" onchange="AllCFA(this.value)"  class="form-select" aria-label="Default select example">
        <option value="">All CFA</option>
            <?php
                while ($row = $cfa_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="cfa_id" value="<?php echo $row['cfa_id'] ?>" <?php echo  (isset($_GET['cfa_id']) && $row['cfa_id'] == $_GET['cfa_id'] )  ?  "selected": ""; ?>> <?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>

        </select>
    </div>

    <div class="btn-group col-lg-2 col-md-6 col-sm-6 mb-1">
        <select id="AllRBM" onchange="AllHQ(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All HQ</option>
            <?php
                while ($row = $hq_array->fetch_array(MYSQLI_ASSOC)) {
                    // echo "<script>console.log('RBM : ".$row['MEMPLOYEE_ID']." EMP : ".$Employee." RBM : ".$_GET['RBM']."')</script>";

            ?>
                <!-- <option class="dropdown-item"  id="rbm" value="<?php //echo $row['MEMPLOYEE_ID'] ?>" <?php //echo $row['MEMPLOYEE_ID'] == $_GET['RBM'] || $row['MEMPLOYEE_ID'] == $emp_session || $Employee=='MEDM_12'|| $Employee=='MEDM_13' || (isset($_GET['RBM']) && $row['MEMPLOYEE_ID'] == $_GET['RBM'] )  ?  "selected": ""; ?>><?php //echo $row['FULL_NAME'] ?> </option> -->
                <option class="dropdown-item" id="hq_id" value="<?php echo $row['hq_id'] ?>" <?php echo  (isset($_GET['hq_id']) && $row['hq_id'] == $_GET['hq_id'] )  ?  "selected": ""; ?>> <?php echo $row['FULL_NAME'] ?> </option>

           <?php
            } ?>

        </select>
    </div>

    <div class="btn-group col-lg-2 col-md-6 col-sm-6 mb-1">
        <select id="AllKBM" onchange="AllEMP(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All EMP</option>

            <?php

                while ($row = $emp_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="emp_id" value="<?php echo $row['emp_id'] ?>" <?php echo  (isset($_GET['emp_id']) && $row['emp_id'] == $_GET['emp_id'] )  ?  "selected": ""; ?>> <?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>
        </select>
    </div>
    <div class="btn-group col-lg-2 col-md-6 col-sm-6 mb-1">
        <select id="AllKBM" onchange="AllHOSP(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All HOSP</option>

            <?php

                while ($row = $hosp_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="hosp_id" value="<?php echo $row['hosp_id'] ?>" <?php echo  (isset($_GET['hosp_id']) && $row['hosp_id'] == $_GET['hosp_id'] )  ?  "selected": ""; ?>> <?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>
        </select>
    </div>
    <div class="btn-group col-lg-2 col-md-6 col-sm-6 mb-1">
        <select id="AllABM" onchange="AllPRODUCT(this.value)"  class="form-select" aria-label="Default select example">
            <option value="">All PRODUCT</option>

            <?php
                while ($row = $prod_array->fetch_array(MYSQLI_ASSOC)) {
                    // echo "<script>console.log('ABM : ".$row['MEMPLOYEE_ID']." EMP : ".$Employee." ABM : ".$_GET['ABM']."')</script>";

            ?>
                <option class="dropdown-item" id="product_id" value="<?php echo $row['product_id'] ?>" <?php echo  (isset($_GET['product_id']) && $row['product_id'] == $_GET['product_id'] )  ?  "selected": ""; ?>> <?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>
        </select>
    </div>
                                    
</div>


<script>

function AllCFA(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('cfa_id',value);
    window.location.href=url;
    window.location.replace(url);
};

function AllHQ(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('hq_id',value);
    // url.searchParams.set('CFA','');
    // url.searchParams.set('CFA','');
    window.location.href=url;
    window.location.replace(url);     
};

 function AllPRODUCT(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('product_id',value);
    //url.searchParams.set('KAM','');
    window.location.href=url;
    window.location.replace(url);

};



function AllEMP(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('emp_id',value);
    window.location.href=url;
    window.location.replace(url);

};
function AllHOSP(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('hosp_id',value);
    window.location.href=url;
    window.location.replace(url);

};
</script>