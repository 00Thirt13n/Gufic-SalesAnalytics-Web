<?php 
include "layouts/config.php";
// echo(print_r($_REQUEST,true));
$start_date; // Default to today's date
$end_date; // Default to today's date

      //Get the selected date value from the date picker input field
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
  

  public function GetData($link,$start_date,$end_date, $cfa, $emp_id) {

      //Daily Order Booking
      $sql = " SELECT COUNT(DISTINCT `ORDER ID`)  ORDER_COUNT, round(sum(`TOTAL PRICE`),2) as ORDERS 
      from  MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA where date(`ORDER DATE`) between '$start_date' and '$end_date'
      AND (CFA_ID like '%$cfa%') and date(`ORDER DATE`) between '$start_date' and '$end_date'
      and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
      ";

      $daily_order_booking = mysqli_query($link, $sql);
      while ($row = $daily_order_booking->fetch_array(MYSQLI_ASSOC)) {
           $order_count = $row['ORDER_COUNT'];
           $order_value = $row['ORDERS'];  
        }

        // APPROVED
        $sql31 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
        where (`ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and CFA_ID like '%$cfa%') 
        and date(`ORDER DATE`) between '$start_date' and '$end_date'
        and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))";
        
        $result = mysqli_query($link, $sql31);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $net_count = $approved_count = $row['APPROVED_COUNT'];
        $net_value = $approved_value = $row['APPROVED_TOTAL'];
        }
        

        // PENDING
        $sql32 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
        where (`ORDER APPROVER STATUS` = 'PENDING' and CFA_ID like '%$cfa%') and date(`ORDER DATE`)  between '$start_date' and '$end_date'
        and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))";
        $result = mysqli_query($link, $sql32);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $pending_count = $row['APPROVED_COUNT'];
        $pending_value = $row['APPROVED_TOTAL'];
        }
        
        //DECLINED

        $sql33 = "SELECT COUNT(DISTINCT `ORDER ID`)  APPROVED_COUNT, round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
        where (`ORDER APPROVER STATUS` = 'CANCELLED' or `CFA APPROVER STATUS` = 'CANCELLED') and CFA_ID like '%$cfa%' 
        and date(`ORDER DATE`) between '$start_date' and '$end_date'
        and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))";

        $result = mysqli_query($link, $sql33);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $declined_count = $row['APPROVED_COUNT'];
        $declined_value = $row['APPROVED_TOTAL'];
        }

      
     // TOP PERFORMERS

       
       $sql = " SELECT round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL  FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND  CFA_ID like '%$cfa%'";

       $products = mysqli_query($link, $sql);
       while ($row = $products->fetch_array(MYSQLI_ASSOC)) {
            $top_product_result = $row['APPROVED_TOTAL'];
         }

       $sql2 = "SELECT DISTINCT `PRODUCT` PRODUCT, SUM(QUANTITY) AS QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND  CFA_ID like '%$cfa%'
       and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
       group by `PRODUCT`
       order by round(sum(`TOTAL PRICE`),2) desc limit 10";
       $top_products = mysqli_query($link, $sql2);
       // for chart
                $product = mysqli_query($link, $sql2);
                $top_products_name = array(); 
                $top_products_per = array();
                
                $total_per=0; $i=5;
                if($top_products)
                while ($row = $product->fetch_array(MYSQLI_ASSOC)) {
                    if($i==0) break; else $i--;
                    array_push($top_products_name, strtoupper(strtok($row['PRODUCT'], " ") ));
                    array_push($top_products_per, $row['PERCENTAGE']);
                    $total_per +=$row['PERCENTAGE'];

                }
                array_push($top_products_name, 'OTHER');
                array_push($top_products_per, 100-$total_per);

       $sql3 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL,HQ ,round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND  CFA_ID like '%$cfa%'
       and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
       group by `HOSPITAL NAME`,`HOSPITAL ADDRESS`
       order by round(sum(`TOTAL PRICE`),2) desc limit 10";
       $top_hospitals = mysqli_query($link, $sql3);
       
          // for chart
                $hospitals = mysqli_query($link, $sql3);
                $top_hospitals_name = array(); 
                $top_hospitals_per = array();

                $total_hospital_per=0; $i=5;
                if($top_hospitals)
                while ($row = $hospitals->fetch_array(MYSQLI_ASSOC)) {
                    if($i==0) break; else $i--;
                    array_push($top_hospitals_name, strtoupper(strtok($row['HOSPITAL'], " ")));
                    array_push($top_hospitals_per, $row['PERCENTAGE']);
                    $total_hospital_per +=$row['PERCENTAGE'];
                }
                array_push($top_hospitals_name, 'OTHER');
                array_push($top_hospitals_per, 100-$total_hospital_per);

       $sql4 = "SELECT DISTINCT `HOSPITAL CITY` CITY, `ORDER BY`, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       AND  CFA_ID like '%$cfa%'
       and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
       group by `HOSPITAL CITY`
       order by round(sum(`TOTAL PRICE`),2) desc limit 10";
       $top_area = mysqli_query($link, $sql4);


     // BOTTOM PERFORMERS

      $bottom_total = $top_product_result;

      $sql11 = "SELECT DISTINCT `PRODUCT` PRODUCT, SUM(QUANTITY) AS QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $bottom_total)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       and CFA_ID like '%$cfa%'
       and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
       group by `PRODUCT`
       order by round(sum(`TOTAL PRICE`),2) asc limit 10";
       $bottom_products = mysqli_query($link, $sql11);

       $sql12 = "SELECT DISTINCT `HOSPITAL NAME` HOSPITAL, HQ, SUM(QUANTITY) AS QUANTITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $bottom_total)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       and CFA_ID like '%$cfa%'
       and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
       group by `HOSPITAL NAME`
       order by round(sum(`TOTAL PRICE`),2) asc limit 10";
       $bottom_hospitals = mysqli_query($link, $sql12);

       $sql13 = "SELECT DISTINCT `HOSPITAL CITY` CITY,  `ORDER BY`,round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $bottom_total)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
       where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`)between '$start_date' and '$end_date'
       and CFA_ID like '%$cfa%'
       and find_in_set(MEMP_ID, ifnull((select  GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id'))
       group by `HOSPITAL CITY`
       order by round(sum(`TOTAL PRICE`),2) asc limit 10";
       $bottom_area = mysqli_query($link, $sql13);
       


        $data = array($order_count, $order_value, $net_count, $net_value, $approved_count, $approved_value, $pending_count, $pending_value, $declined_count, $declined_value);
        $top = array($top_products, $top_hospitals, $top_area);
        $bottom = array($bottom_products, $bottom_hospitals, $bottom_area);
        $piechart = array($top_hospitals_name, $top_hospitals_per, $top_products_name, $top_products_per);
        return [$data, $top, $bottom, $piechart];
        
    }
}

?>