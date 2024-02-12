<?php  
include 'layouts/session.php';
require_once "layouts/config.php";

echo(print_r($_REQUEST,true));
$obj = new dropdown();


if(isset($_POST["functionName"])) {
    switch($_POST["functionName"]) {
      case "GetEmployeeDesignation":
            $obj->GetEmployeeDesignation($_POST["param1"]);
            break;
      case "GetEmployeeArray":
        echo "in data file";
            $obj->GetEmployeeArray($_POST["param1"], $_POST["param2"]);
            break;
      // Add more cases for other functions you want to call
    }
  }



class dropdown{
    private $conn;
    public function GetConnection(){
        define('DB_SERVER', 'database-1.cp3x1knxpfbf.ap-south-1.rds.amazonaws.com');
        define('DB_USERNAME', 'admin');
        define('DB_PASSWORD', 'gstadmin123');
        define('DB_NAME', 'MELJOHN_UPLOAD_SATISH');

        /* Attempt to connect to MySQL database */
        $this->conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if($this->conn === false){
            echo "DB LINK ERROR <br>";
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
    }
    public function GetEmployeeDesignation($emp_id) {
        $this->GetConnection();
        $sql = 
        "SELECT DM.NAME ,DM.MEDM_ID
        FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
        INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
        WHERE MEMP.MEMPLOYEE_ID ='$emp_id'
        GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";

        $employee_array = mysqli_query($this->conn, $sql);
        while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
            return $row['MEDM_ID'];
        }

    }
    
    public function GetEmployeeArray($emp_id,$designation_id) {
        $this->GetConnection();

        if($designation_id == 'zbm'){ $designation_id = 'MEDM_8'; }
        if($designation_id == 'rbm'){ $designation_id = 'MEDM_12'; }
        if($designation_id == 'abm'){ $designation_id = 'MEDM_12'; }
        if($designation_id == 'kam'){ $designation_id = 'MEDM_13'; }

        $sql = 
        "SELECT DM.NAME, MEMP.MEMPLOYEE_ID, concat(MEMP.LST_NAME, ' ' , MEMP.FST_NAME) as FULL_NAME 
        FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
        INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
        WHERE (DM.MEDM_ID = '$designation_id') 
        and   (find_in_set(MEMP.MEMPLOYEE_ID, ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id') ))
        GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";

        $employee_array = mysqli_query($this->conn, $sql);

        if(mysqli_num_rows($employee_array) > 0) {

            return $employee_array;
        }
        else{

                $sql = 
                "SELECT DM.NAME, MEMP.MEMPLOYEE_ID, concat(MEMP.LST_NAME, ' ' , MEMP.FST_NAME) as FULL_NAME 
                FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
                INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
                WHERE (DM.MEDM_ID = '$designation_id') 
                and   (find_in_set(MEMP.MEMPLOYEE_ID, ifnull(GET_MILJON_EMPLOYEE_MANAGERS_DETAILS_HIERARCHY('$emp_id'),'$emp_id') ))
                GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";
                $employee_array = mysqli_query($this->conn, $sql);
                return $employee_array;
        }
    }
}

?>