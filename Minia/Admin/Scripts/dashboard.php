<?php 

    $start_date; // Default to today's date
    $end_date; // Default to today's date

    if (isset($_REQUEST['start-date'])) { $start_date = $_REQUEST['start-date']; } 
    if (isset($_REQUEST['end-date'])) { $end_date = $_REQUEST['end-date']; }

  class dashboardData {

    public function __construct($type)
    {
        if($type =="daily"){
            $start_date = date('Y-m-d');
            $end_date = $start_date;
        }
        else if($type =="monthly"){
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
        }
        else if($type =="yearly"){
            $start_date = date('Y-04-01');
            $end_date =date('Y-m-d');
        }
      
    }
    

    public function GetData($link,$start_date,$end_date,$emp_id) {

      if($emp_id =='MEMP_G_16') { $emp_id = 'MEMP_G_1';}

      // TOTAL
                
      $sql = "SELECT COUNT(DISTINCT GO.ORDER_ID) ORDER_COUNT, ROUND(SUM(GOL.`PRICE`), 2) AS ORDERS
            FROM GSTMED_ORDER GO
            JOIN GSTMED_ORDER_LINEITEM GOL ON GO.ORDER_ID = GOL.ORDER_ID
            WHERE DATE(GO.CREATED) between '$start_date' and '$end_date'
            AND find_in_set(GO.BA_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))";


      $total = mysqli_query($link, $sql);
      while ($row = $total->fetch_array(MYSQLI_ASSOC)) {
              $total_count = $row['ORDER_COUNT'];
              $total_value = $row['ORDERS'];  
          }
          

    //APPROVED
        $sql = "SELECT COUNT(DISTINCT GO.`ORDER_ID`) APPROVED_COUNT, ROUND(SUM(GOL.`PRICE`), 2) APPROVED_TOTAL
                FROM GSTMED_ORDER GO
                JOIN GSTMED_ORDER_LINEITEM GOL ON GO.ORDER_ID = GOL.ORDER_ID
                WHERE (((GO.APPROVED_DATE IS NOT NULL)
                AND (GOL.SP_REJECTED_DATE IS NULL))
                OR (GOL.ORDER_STATUS = 'LOV_16')
                OR ((GOL.SP_ORDER_STATUS = 'LOV_16')
                AND (GOL.SP_ORDER_STATUS <> 'LOV_21')))
                AND ((GOL.ORDER_STATUS <> 'LOV_21')
                AND (GOL.SP_ORDER_STATUS <> 'LOV_21'))
                AND DATE(GO.CREATED) BETWEEN '$start_date' and '$end_date'
                AND find_in_set(GO.BA_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))";


        $daily_approved = mysqli_query($link, $sql);
        while ($row = $daily_approved->fetch_array(MYSQLI_ASSOC)) {
            $approved_count = $row['APPROVED_COUNT'];
            $approved_value = $row['APPROVED_TOTAL'];
        }

        

    //PENDING
        $sql = "SELECT COUNT(DISTINCT GO.ORDER_ID) PENDING_COUNT, COALESCE(ROUND(SUM(GOL.PRICE), 2), 0) PENDING_TOTAL
                FROM GSTMED_ORDER GO
                JOIN GSTMED_ORDER_LINEITEM GOL ON GO.ORDER_ID = GOL.ORDER_ID
                WHERE GOL.SP_ORDER_STATUS = 'LOV_17'
                AND GO.ORDER_STATUS = 'LOV_17'
                AND GO.SP_ORDER_STATUS = 'LOV_17'
                AND GOL.ORDER_STATUS = 'LOV_17'
                AND DATE(GO.CREATED) BETWEEN '$start_date' and '$end_date'
                AND find_in_set(GO.BA_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))";

        $daily_pending = mysqli_query($link, $sql);
        while ($row = $daily_pending->fetch_array(MYSQLI_ASSOC)) {
            $pending_count = $row['PENDING_COUNT'];
            $pending_value = $row['PENDING_TOTAL'];
        }

    //DECLINED
        $sql = "SELECT COUNT(DISTINCT GO.`ORDER_ID`) CANCELLED_COUNT, COALESCE(ROUND(SUM(GOL.`PRICE`), 2), 0) CANCELLED_TOTAL
                FROM GSTMED_ORDER GO
                JOIN GSTMED_ORDER_LINEITEM GOL ON GO.ORDER_ID = GOL.ORDER_ID
                WHERE ((GOL.ORDER_STATUS = 'LOV_21')
                OR (GOL.SP_ORDER_STATUS = 'LOV_21'))
                AND DATE(GO.CREATED) BETWEEN '$start_date' and '$end_date'
                AND find_in_set(GO.BA_ID,ifnull(GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY('$emp_id'),'$emp_id'))";

        $daily_declined = mysqli_query($link, $sql);
        while ($row = $daily_declined->fetch_array(MYSQLI_ASSOC)) {
            $declined_count = $row['CANCELLED_COUNT'];
            $declined_value= $row['CANCELLED_TOTAL'];
        }

      $data = array($total_count, $total_value, $approved_count, $approved_value, $approved_count, $approved_value, $pending_count, $pending_value, $declined_count, $declined_value);

      return $data;
          
      }
  }

?>