<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<?php 
require_once "layouts/config.php";

        // $sql11 = "SELECT MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID,  concat(MILJON_EMPLOYEE.LST_NAME, ' ' , MILJON_EMPLOYEE.FST_NAME) as FULL_NAME  from MILJON_EMPLOYEE_DESIGNATION_MASTER
        //     INNER JOIN MILJON_EMPLOYEE
        //     ON MILJON_EMPLOYEE_DESIGNATION_MASTER.MEDM_ID = MILJON_EMPLOYEE.H_ID
        //     WHERE (MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'ZBM' OR MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'ZH' )
        //     GROUP BY MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID";
        // $ZBM_array = mysqli_query($link, $sql11);

        //WHERE (MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'ZBM' OR MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'ZH' ) and (find_in_set(MILJON_EMPLOYEE.MEMPLOYEE_ID, GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAIL_HIERARCHY(<script>document.getElementById('AllZBM').value</sript>)))

            $sql12 = "SELECT MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME, MILJON_EMPLOYEE.MEMPLOYEE_ID, concat(MILJON_EMPLOYEE.LST_NAME, ' ' , MILJON_EMPLOYEE.FST_NAME) as FULL_NAME  from MILJON_EMPLOYEE_DESIGNATION_MASTER
                INNER JOIN MILJON_EMPLOYEE
                ON MILJON_EMPLOYEE_DESIGNATION_MASTER.MEDM_ID = MILJON_EMPLOYEE.H_ID
                WHERE MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'RBM' 
                GROUP BY MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID";
        $RBM_array = mysqli_query($link, $sql12);

        $sql13 = "SELECT MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME, MILJON_EMPLOYEE.MEMPLOYEE_ID, concat(MILJON_EMPLOYEE.LST_NAME, ' ' , MILJON_EMPLOYEE.FST_NAME) as FULL_NAME  from MILJON_EMPLOYEE_DESIGNATION_MASTER
            INNER JOIN MILJON_EMPLOYEE
            ON MILJON_EMPLOYEE_DESIGNATION_MASTER.MEDM_ID = MILJON_EMPLOYEE.H_ID
            WHERE MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'ABM'
            GROUP BY MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID";
        $ABM_array = mysqli_query($link, $sql13);

        $sql14 = "SELECT MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID, concat(MILJON_EMPLOYEE.LST_NAME, ' ' , MILJON_EMPLOYEE.FST_NAME) as FULL_NAME  from MILJON_EMPLOYEE_DESIGNATION_MASTER
            INNER JOIN MILJON_EMPLOYEE
            ON MILJON_EMPLOYEE_DESIGNATION_MASTER.MEDM_ID = MILJON_EMPLOYEE.H_ID
            WHERE MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'KAM' OR MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'SR KAM'
            GROUP BY MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID";
        $KAM_array = mysqli_query($link, $sql14);


        
?>




<form action="" method="POST">
    <div class="row mt-4">

        <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
            <select id="AllZBM"  class="form-select" aria-label="Default select example">
                <option selected>All ZBM</option>
                <?php
                    $sql11 = "SELECT MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID,  concat(MILJON_EMPLOYEE.LST_NAME, ' ' , MILJON_EMPLOYEE.FST_NAME) as FULL_NAME  from MILJON_EMPLOYEE_DESIGNATION_MASTER
                    INNER JOIN MILJON_EMPLOYEE
                    ON MILJON_EMPLOYEE_DESIGNATION_MASTER.MEDM_ID = MILJON_EMPLOYEE.H_ID
                    WHERE (MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'ZBM' OR MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME = 'ZH' )
                    GROUP BY MILJON_EMPLOYEE_DESIGNATION_MASTER.NAME,MILJON_EMPLOYEE.MEMPLOYEE_ID";
                    $ZBM_array = mysqli_query($link, $sql11);
                    
                    while ($row = $ZBM_array->fetch_array(MYSQLI_ASSOC)) {
                ?>
                    <option class="dropdown-item" name='zbm-value' value="<?php echo $row['MEMPLOYEE_ID'] ?>"> <?php echo $row['FULL_NAME'] ?> </option>
                <?php
                } ?>
            </select>
        </div>
        <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
            <select id="AllRBM" onchange="AllRBM()" disabled class="form-select" aria-label="Default select example">
                <option selected>All RBM</option>
                <?php
                    while ($row = $RBM_array->fetch_array(MYSQLI_ASSOC)) {
                ?>
                    <option class="dropdown-item"   value="<?php echo $row['MEMPLOYEE_ID'] ?>"><?php echo $row['FULL_NAME'] ?> </option>
                <?php
                } ?>
            </select>
        </div>
        <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
            <select id="AllABM" onchange="AllABM()" disabled class="form-select" aria-label="Default select example">
                <option selected>All ABM</option>
                <?php
                    while ($row = $ABM_array->fetch_array(MYSQLI_ASSOC)) {
                ?>
                    <option class="dropdown-item"  value="<?php echo $row['MEMPLOYEE_ID'] ?>"><?php echo $row['FULL_NAME'] ?> </option>
                <?php
                } ?>
            </select>
        </div>
        <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
            <select id="AllKAM" onchange="AllKAM()" disabled class="form-select" aria-label="Default select example">
                <option selected>All KAM</option>
                <?php
                    while ($row = $KAM_array->fetch_array(MYSQLI_ASSOC)) {
                ?>
                    <option class="dropdown-item"  value="<?php echo $row['MEMPLOYEE_ID'] ?>"><?php echo $row['FULL_NAME'] ?> </option>
                <?php
                } ?>
            </select>
        </div>
                                    
    </div>
</form>


<script>

    $(document).ready(function(){
        $("#AllZBM").on("change", function() {
            if(document.getElementById('AllZBM').value != 'All ZBM'){
                document.getElementById('AllRBM').removeAttribute('disabled');
                var ZBM = document.getElementById('AllZBM').value;
                // console.log( document.getElementById('AllZBM').value);


                // $.ajax({
                //     type: "POST",
                //     url: "https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/layouts/dropdown_sql.php",
                //     data: {'ZBM_VALUE' : ZBM},
                //     success: function(data ) {
                //         console.log( data);
                //     },
                //     error: function(){console.log('ALL_ZBM ERROR');}
                // });


               
            }
            else{
                document.getElementById('AllRBM').setAttribute('disabled', '');
                document.getElementById('AllABM').setAttribute('disabled', '');
                document.getElementById('AllKBM').setAttribute('disabled', '');
            }
            
        });

        function AllRBM() {
            if(document.getElementById('AllRBM').value != 'All RBM'){
                document.getElementById('AllABM').removeAttribute('disabled');
                console.log( document.getElementById('AllRBM').value);
            }
            else{
                document.getElementById('AllABM').setAttribute('disabled', '');
                document.getElementById('AllKBM').setAttribute('disabled', '');
            }
                
        };

        function AllABM() {
            if(document.getElementById('AllABM').value != 'All ABM'){
                document.getElementById('AllKAM').removeAttribute('disabled');
                console.log( document.getElementById('AllABM').value);
                
            }
            else
                document.getElementById('AllKAM').setAttribute('disabled', '');
        };


        function AllKAM(){
            console.log( document.getElementById('AllKAM').value);
        }





    });        
</script>


