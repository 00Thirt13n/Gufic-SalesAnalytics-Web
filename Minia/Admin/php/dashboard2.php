<?php 
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
    
   $sql = " SELECT COUNT(DISTINCT `ORDER ID`)  ORDER_COUNT, round(sum(`TOTAL PRICE`),2) as ORDERS 
            from  MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) between '$start_date' and '$end_date'
            AND find_in_set(MEMP_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))";
    
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

                
  $achievement_1 = mysqli_query($link, $sql23);
    
  if(!empty($achievement_1))
  { 
      while ($row = $achievement_1->fetch_array(MYSQLI_ASSOC)) {
        $target = $row['TARGET'];
        $achievement_val = $row['ACHIEVEMENT'];
        $ach_per = $row['ACHIVEMENT_PER'];
    }
  }
  
  $data = array($order_count, $order_value, $net_count, $net_value, $approved_count, $approved_value, $pending_count, $pending_value, $declined_count, $declined_value, $target,$achievement_val,$ach_per); 
  return $data;
       
    }
}

?>