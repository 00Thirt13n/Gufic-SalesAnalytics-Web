<?php 
// include "layouts/config.php";
// echo(print_r($_REQUEST,true));
$start_date; // Default to today's date
$end_date; // Default to today's date



      if (isset($_REQUEST['start-date'])) { $start_date = $_REQUEST['start-date']; } 
      if (isset($_REQUEST['end-date'])) { $end_date = $_REQUEST['end-date']; }
      

class dashboardData {

  public function __construct($type)
  {
    if($type =="daily"){
        $start_date = date('Y-m-d'); // Default to today's date
        $end_date = $start_date; // Default to today's date
    }
    else if($type =="monthly"){
        $start_date = date('Y-m-01'); // Default to month's first date
        $end_date = date('Y-m-d'); // Default to today's date
    }
    else if($type =="yearly"){
        $start_date = date('Y-01-01'); // Default to years's first date
        $end_date =date('Y-m-d'); // Default to today's date
    }
    
  }
  

  public function GetData($link,$start_date,$end_date,$emp_id) {

    if($emp_id =='MEMP_G_16') { $emp_id = 'MEMP_G_1';}
    //$emp_id ='MEMP_G_1';
    $sql= "CALL GET_GUFIC_DASHBOARD_DATA('$emp_id','$start_date','$end_date')";
    echo $sql;
    $data = array();
    $data = mysqli_query($link, $sql);
    while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
         echo $row[0][0];
      }

    /*

   $sql = " SELECT COUNT(DISTINCT `ORDER ID`)  ORDER_COUNT, round(sum(`TOTAL PRICE`),2) as ORDERS 
   from  MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) between '$start_date' and '$end_date'
   AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
   ";
    //echo "<script>console.log('$sql')</script>";

   //echo($sql); die;
   $daily_order_booking = mysqli_query($link, $sql);
   while ($row = $daily_order_booking->fetch_array(MYSQLI_ASSOC)) {
        $order_count = $row['ORDER_COUNT'];
        $order_value = $row['ORDERS'];  
     }
             
     
   //Daily Sales Achivement
   $sql = " SELECT COUNT(DISTINCT `ORDER ID`)  NET_COUNT, round(sum(`TOTAL PRICE`),2) as achivements from  MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
   where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`) between '$start_date' and '$end_date'
   AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
   ";
   $daily_sales_archivement = mysqli_query($link, $sql);
   while ($row = $daily_sales_archivement->fetch_array(MYSQLI_ASSOC)) {
        $net_count = $row['NET_COUNT'];
        $net_value = $row['achivements'];
     }

   //APPROVED
   $sql = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED') and date(`ORDER DATE`)between '$start_date' and '$end_date'
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
               ";
       $daily_approved = mysqli_query($link, $sql);
       while ($row = $daily_approved->fetch_array(MYSQLI_ASSOC)) {
           $approved_count = $row['APPROVED_COUNT'];
           $approved_value = $row['APPROVED_TOTAL'];
       }

    //PENDING
    $sql = "SELECT COUNT(DISTINCT `ORDER ID`)  PENDING_COUNT, round(sum(`TOTAL PRICE`),2) PENDING_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
        where `ORDER APPROVER STATUS` = 'PENDING' and date(`ORDER DATE`)between '$start_date' and '$end_date'
        AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
        ";
      $daily_pending = mysqli_query($link, $sql);
      while ($row = $daily_pending->fetch_array(MYSQLI_ASSOC)) {
      $pending_count = $row['PENDING_COUNT'];
      $pending_value = $row['PENDING_TOTAL'];
      }

   //DECLINED
   $sql = "SELECT COUNT(DISTINCT `ORDER ID`)  CANCELLED_COUNT, round(sum(`TOTAL PRICE`),2) CANCELLED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
               where (`ORDER APPROVER STATUS` = 'CANCELLED' or `CFA APPROVER STATUS` = 'CANCELLED') and date(`ORDER DATE`)between '$start_date' and '$end_date'
               AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
               ";
       $daily_declined = mysqli_query($link, $sql);
       while ($row = $daily_declined->fetch_array(MYSQLI_ASSOC)) {
           $declined_count = $row['CANCELLED_COUNT'];
           $declined_value= $row['CANCELLED_TOTAL'];
       }

   
       

     // TOP PERFORMERS

       $total = 0;
       $sql = " SELECT round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL  FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
       ";

       $products = mysqli_query($link, $sql);
       while ($row = $products->fetch_array(MYSQLI_ASSOC)) {
            $top_product_result = $row['APPROVED_TOTAL'];
         }

       $sql2 = "SELECT DISTINCT `PRODUCT` PRODUCT, QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
       group by `PRODUCT`
       order by round(sum(`TOTAL PRICE`),2) desc limit 10";
       $top_products = mysqli_query($link, $sql2);


       $sql3 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
       group by `HOSPITAL NAME`,`HOSPITAL ADDRESS`
       order by round(sum(`TOTAL PRICE`),2) desc limit 10";
       $top_hospitals = mysqli_query($link, $sql3);

       $sql4 = "SELECT DISTINCT `HQ` HQ, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
       group by `HQ`
       order by round(sum(`TOTAL PRICE`),2) desc limit 10";
       $top_area = mysqli_query($link, $sql4);


                 
     // BOTTOM PERFORMERS

       $sql11 = "SELECT DISTINCT `PRODUCT` PRODUCT, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
       group by `PRODUCT`
       order by round(sum(`TOTAL PRICE`),2) asc limit 10";
       $bottom10_products = mysqli_query($link, $sql11);

       $sql12 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
       group by `HOSPITAL NAME`,`HOSPITAL ADDRESS`
       order by round(sum(`TOTAL PRICE`),2) asc limit 10";
       $bottom10_hospitals = mysqli_query($link, $sql12);

       $sql13 = "SELECT DISTINCT `HOSPITAL CITY` CITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))
       group by `HOSPITAL CITY`
       order by round(sum(`TOTAL PRICE`),2) asc limit 10";
       $bottom10_area = mysqli_query($link, $sql13);



      
      //  @ACHIEVEMENT


      //$sql23 = "SELECT TARGET,ACHIEVEMENT,ROUND(((ACHIEVEMENT*100)/TARGET),2) ACHIVEMENT_PER from MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA WHERE MONTH IN ((SELECT DATE_FORMAT('$start_date', '%b')),(SELECT DATE_FORMAT('$end_date', '%b')))AND find_in_set(ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'));";

        if($emp_id == 'MEMP_G_1'){
          $sql23 = "SELECT sum(TARGET) TARGET, sum(ACHIEVEMENT) ACHIEVEMENT,ROUND(((ACHIEVEMENT*100)/TARGET),2) ACHIVEMENT_PER
                    from MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA
                    WHERE MONTH IN ((SELECT MONTHNAME('$end_date')))";
        }
        else{
        $sql23 = "SELECT sum(TARGET) TARGET, ID,MONTH,  sum(ACHIEVEMENT) ACHIEVEMENT,ROUND(((ACHIEVEMENT*100)/TARGET),2) ACHIVEMENT_PER
                  from MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA
                  WHERE MONTH IN ((SELECT MONTHNAME('$end_date')))
                  AND find_in_set(ID,'$emp_id')
                  GROUP BY ID,MONTH";
        }

                //  echo "<script>console.log('user:  $emp_id  date :  $end_date ')</script>";

                
      $achievement_1 = mysqli_query($link, $sql23);
      

      // echo "<script>console.log('sql :  print_r($achievement,true)  ')</script>";
    //   while ($row = $achievement->fetch_array(MYSQLI_ASSOC)) {
    //     echo "<script>console.log('sql :  $row  ')</script>";
    // }


      if(!empty($achievement_1))
      {

          while ($row = $achievement_1->fetch_array(MYSQLI_ASSOC)) {
            $target = $row['TARGET'];
            $achievement_val = $row['ACHIEVEMENT'];
            $ach_per = $row['ACHIVEMENT_PER'];
        }
      }
      // else
      // {
      //      $target = '0';
      //      $achievement_val = '0';
      //      $ach_per = '0';
      // }
      
      // $target = '0';
      // $achievement_val = '0';
      // $ach_per = '0';
        

        $data = array($order_count, $order_value, $net_count, $net_value, $approved_count, $approved_value, $pending_count, $pending_value, $declined_count, $declined_value
        ,$target,$achievement_val,$ach_per);

        $top = array($top_products, $top_hospitals, $top_area);
        $bottom = array($bottom10_products, $bottom10_hospitals, $bottom10_area);
        return $data;*/
        // $result = array($data,$top,$bottom);
        // return $result;
        //  echo print_r($data, true);
        // die;
        
    }
}

?>