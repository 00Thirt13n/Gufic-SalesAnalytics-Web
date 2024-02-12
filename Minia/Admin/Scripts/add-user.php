<?php

    require_once "../layouts/config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $sql = "INSERT INTO GUFIC_EMPLOYEE_UPLOAD (
                            `EMPLOYEE FIRST NAME`, `MOBILE NUMBER`, `PERSONAL EMAIL ID`, `OFFICIAL EMAIL ID`, `HQ. NAME`, 
                            `ZONE`, `STATE`, `DESIGNATION`, `EMP CODE`, `DATE OF JOINING`, `REPORTING MANAGER NAME`, 
                            `DIVISION`, `REPORTING TO EMP CODE`, `GRADE`, `CFA NAME`, `CFA Location`)
                    VALUES('".$_POST['first_name']." ".$_POST['last_name']."','".$_POST['phone']."','".$_POST['personal_email']."','".$_POST['official_email']."',
                            '".$_POST['hq_name']."','".$_POST['zone']."','".$_POST['state']."','".$_POST['designation']."','".$_POST['emp_code']."','".$_POST['joining_date']."',
                            '".$_POST['manager_name']."','".$_POST['division']."','".$_POST['manager_code']."','".$_POST['grade']."','".$_POST['cfa_name']."','".$_POST['cfa_locator']."')";

            
            if (mysqli_query($link, $sql)){
                $link->close();
                // echo $sql; die;
                echo '<script>alert("Form submitted successfully for '.$_POST['first_name'].' '.$_POST['last_name'].'"); window.location.href="../add-users.php";</script>';
                exit();
            }
             else 
                echo "Error executing the statement: " . $stmt->error;
            
    }

    $link->close();

