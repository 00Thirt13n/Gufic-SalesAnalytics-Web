<?php

if(isset($_POST["functionName"])) {
  switch($_POST["functionName"]) {
    case "myFunction":
      myFunction($_POST["param1"], $_POST["dropdownId"]);
      break;
    case "GetEmployeeDesignation":
      GetEmployeeDesignation($_POST["param1"]);
      break;
    case "GetEmployeeArray":
      GetEmployeeArray($_POST["param1"], $_POST["dropdownId"]);
      break;
    // Add more cases for other functions you want to call
  }
}

function myFunction($param1, $dropdownId) {
  // Do something with the parameters and dropdown ID
echo $param1,$dropdownId;
echo "Successfull";
}

function GetConnection(){
        define('DB_SERVER', 'database-1.cp3x1knxpfbf.ap-south-1.rds.amazonaws.com');
        define('DB_USERNAME', 'admin');
        define('DB_PASSWORD', 'gstadmin123');
        define('DB_NAME', 'MELJOHN_UPLOAD_SATISH');

        /* Attempt to connect to MySQL database */
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if($conn === false){
            echo "DB LINK ERROR <br>";
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $conn;
    }
function GetEmployeeDesignation($emp_id) {
        $conn=GetConnection();
        $sql = 
        "SELECT DM.NAME ,DM.MEDM_ID
        FROM MILJON_EMPLOYEE_DESIGNATION_MASTER AS DM 
        INNER JOIN MILJON_EMPLOYEE AS MEMP ON DM.MEDM_ID = MEMP.H_ID 
        WHERE MEMP.MEMPLOYEE_ID ='$emp_id'
        GROUP BY DM.NAME,MEMP.MEMPLOYEE_ID";

        $employee_array = mysqli_query($conn, $sql);
        while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
            return $row['MEDM_ID'];
        }

    }
    
function GetEmployeeArray($emp_id,$designation_id) {

        $conn=GetConnection();

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

        $employee_array = mysqli_query($conn, $sql);

        if(mysqli_num_rows($employee_array) > 0) {
          while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
            echo print_r($row,true);
            } 
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
                $employee_array = mysqli_query($conn, $sql);
                while ($row = $employee_array->fetch_array(MYSQLI_ASSOC)) {
                  echo print_r($row,true);
                } 
                return $employee_array;
        }
    }

?>
