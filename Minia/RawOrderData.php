<?php
    echo "<script>console.log('check1')</script>";
    session_start(); // session start

    require "db.php";
    //include("global.php");
    


    echo "<script>console.log('check1')</script>";

    //$sql = "SELECT * FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA ;";
    $sql ="select round(sum(`TOTAL PRICE`),2) as ORDERS from  MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) = date(now());";
    //  "SELECT `MEMPLOYEE_ID` FROM MILJON_EMPLOYEE WHERE email = 'harshadsalunkhe1212@gmail.com' AND password = 'welcome'";
    
    $result = mysqli_query($conn, $sql);

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $records[] = $row;
         //$user_id =  $row['MEMPLOYEE_ID'];
         $pob = $row['ORDERS'];
      }
      //print_r(json_encode($user_id));
      print_r(json_encode($pob));

      
    //$_SESSION['samplename']=$user_id ; // Session Set

      echo "<script>console.log('$user_id')</script>";

    echo "<script>console.log('$sql')</script>";

    // if ($stmt = mysqli_prepare($conn, $sql)) {
    //     echo "<script>console.log('check2')</script>";
    //     // Bind variables to the prepared statement as parameters
    //     if (mysqli_stmt_execute($stmt)) {
    //         // Store result
    //         mysqli_stmt_store_result($stmt);

    //         // Check if email exists, if yes then verify password
    //         if (mysqli_stmt_num_rows($stmt) >= 1) {
    //             echo "<script>console.log(".mysqli_stmt_num_rows($stmt).")</script>";
    //         } else {
    //             // Display an error message if email doesn't exist
    //             $email_err = "No account found with that email.";
    //         }
    //     } else {
    //         echo "Oops! Something went wrong. Please try again later.";
    //     }

    //     // Close statement
    //     mysqli_stmt_close($stmt);
    // }
?>
