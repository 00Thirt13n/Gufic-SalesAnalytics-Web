<?php
include 'layouts/session.php';
//require_once "layouts/config.php";

define('DB_SERVER', '13.235.43.173');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Globalspace@100$');
define('DB_NAME', 'MELJOHN_UPLOAD_SATISH');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    // echo "DB LINK ERROR <br>";
    // die("ERROR: Could not connect. " . mysqli_connect_error());
    header("location: pages-maintenance.php");
}
else{
    // echo "DB Connected Successfully <br>";
    // $sql = "select * from GSTMED_ACCOUNT limit 1";
    // $result = mysqli_query($link, $sql);
    // echo gettype($result);
    // // print_r($result);
    // while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    //     // $records[] = $row;
    //     print_r(json_encode($row));
    // }

}
    


class Dropdown {
    public function getEmployeeData($link, $designationId, $empId) {
        $sql = "SELECT DM.NAME, MEMP.MEMPLOYEE_ID, 
                CONCAT((CASE WHEN MEMP.STATUS='ACTIVE' THEN CONCAT(MEMP.LST_NAME, ' ', MEMP.FST_NAME) ELSE 'VACANT' END), ' (', HQ.HQ, ')') as FULL_NAME 
                FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
                INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
                INNER JOIN `GUFIC_EMPLOYEE` `HQ` ON (`MEMP`.`EMPLOYEE_CODE` = `HQ`.`EMP CODE`)
                WHERE (DM.MEDM_ID = '$designationId') 
                AND (FIND_IN_SET(MEMP.MEMPLOYEE_ID, IFNULL(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$empId'), '$empId')))
                GROUP BY DM.NAME, MEMP.MEMPLOYEE_ID, HQ.HQ";
        
        $employeeArray = mysqli_query($link, $sql);

        if (mysqli_num_rows($employeeArray) > 0) {
            return $employeeArray;
        } else {
            return null;
        }
    }
    
    public function getEmployeeID($link, $designationId, $empId) {
        $employeeData = $this->getEmployeeData($link, $designationId, $empId);

        if ($employeeData) {
            $row = $employeeData->fetch_array(MYSQLI_ASSOC);
            return $row['MEMPLOYEE_ID'];
        } else {
            return null;
        }
    }
}

$obj = new Dropdown();

// Determine the employee session based on GET parameters or session variable
if (isset($_GET['KAM']) && $_GET['KAM'] != "") {
    $empSession = $_GET['KAM'];
} else if (isset($_GET['ABM']) && $_GET['ABM'] != "") {
    $empSession = $_GET['ABM'];
} else if (isset($_GET['RBM']) && $_GET['RBM'] != "") {
    $empSession = $_GET['RBM'];
} else if (isset($_GET['ZBM']) && $_GET['ZBM'] != "") {
    $empSession = $_GET['ZBM'];
} else {
    $empSession = $_SESSION['user_id'];
}
// echo ($_SESSION['user_id']); 
// echo ($empSession); 
$designationId= 'MEDM_13';
$employee = $obj->getEmployeeData($link,$designationId, $empSession);
$designation = $obj->getEmployeeID($link, $empSession, $empSession);

// Create functions to generate dropdowns
function generateDropdown($dataArray, $selectedValue = "") {
    echo '<select class="form-select" aria-label="Default select example">';
    echo '<option value="">All</option>';
    while ($row = $dataArray->fetch_array(MYSQLI_ASSOC)) {
        $value = $row['MEMPLOYEE_ID'];
        $fullName = $row['FULL_NAME'];
        $selected = ($value == $selectedValue) ? 'selected' : '';
        echo "<option value=\"$value\" $selected>$fullName</option>";
    }
    echo '</select>';
}

?>

<div class="row mt-4">
    <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
        <?php generateDropdown($obj->getEmployeeData($link, 'MEDM_2', $empSession)); ?>
    </div>
    <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
        <?php generateDropdown($obj->getEmployeeData($link, 'MEDM_8', $empSession)); ?>
    </div>
    <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
        <?php generateDropdown($obj->getEmployeeData($link, 'MEDM_12', $empSession)); ?>
    </div>
    <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
        <?php generateDropdown($obj->getEmployeeData($link, 'MEDM_13', $empSession)); ?>
    </div>
</div>

<script>
// Add your JavaScript logic here
</script>
