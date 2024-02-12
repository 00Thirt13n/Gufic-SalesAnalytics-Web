<?php  
    include 'layouts/session.php';
    require_once "layouts/config.php";

    //echo(print_r($_REQUEST,true));

    class dropdown{

        public function GetCFA($link,$cfa_id, $emp_id) {
            // $sql = 
            // "SELECT DISTINCT CFA.EMPLOYEE_ID AS CFA,ACC.NAME AS FULL_NAME 
            // FROM GSTMED_EMPLOYEE CFA INNER JOIN GSTMED_ACCOUNT ACC ON ACC.ACCOUNT_ID = CFA.ORG_ID
            // INNER JOIN RAW_ORDER_DATA RAW ON RAW.CFA_ID =CFA.EMPLOYEE_ID
            // WHERE CFA.EMPLOYEE_ID LIKE'%$cfa_id%'
            // and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
            // ";
            $sql = "SELECT DISTINCT ORD.STOKIEST_ID AS CFA, ACC.NAME AS FULL_NAME
                    FROM GSTMED_ORDER ORD
                    JOIN MILJON_EMPLOYEE MEMP ON MEMP.MEMPLOYEE_ID = ORD.BA_ID
                    JOIN GSTMED_ACCOUNT ACC ON ACC.ACCOUNT_ID = ORD.ORG_ID
                    WHERE ORD.BA_ID LIKE 'MEMP_G_%' AND ORD.STOKIEST_ID LIKE '%$cfa_id%'
                    AND find_in_set(MEMPLOYEE_ID, IFNULL((SELECT GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id')), '$emp_id'))";


            $employee_array = mysqli_query($link, $sql);
            return $employee_array;
        }
        
    }




    $obj = new dropdown();

    $data;
    if(isset($_GET['CFA']) && $_GET['CFA']!="")
    {
        $emp_session = $_GET['CFA'];  
    }
    else
    {
        $emp_session =  $_SESSION['CFA'];
    }

        $CFA_array = $obj->GetCFA($link,'', $emp_id);

?> 

<div class="row">
    <div class="btn-group">
        <select id="AllCFA" onchange="CFA(this.value)" class="form-select" aria-label="Default select example">
                <option value="%%">All CFA</option>
            <?php
                while ($row = $CFA_array->fetch_array(MYSQLI_ASSOC)) {
            ?>
                <option class="dropdown-item" id="cfa" value="<?php echo $row['CFA'] ?>" <?php echo (isset($_GET['CFA']) && $_GET['CFA']!=="" && $row['CFA']==$_GET['CFA']  )  ?  "selected": ""; ?>> <?php echo $row['FULL_NAME'] ?> </option>
            <?php
            } ?>

        </select>
    </div>         
</div>


<script>


function CFA(value) {
    const url= new URL(window.location.href);
    url.searchParams.set('CFA',value);
    window.location.href=url;
    window.location.replace(url);
}


</script>