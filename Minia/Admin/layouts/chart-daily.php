<?php
require_once "layouts/config.php";

              $total = 0;
                $sql = " SELECT round(sum(`TOTAL PRICE`),2) APPROVED_TOTAL  FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
                where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) = '$start_date'";
    
                $products = mysqli_query($link, $sql);
                while ($row = $products->fetch_array(MYSQLI_ASSOC)) {
                     $top_product_result = $row['APPROVED_TOTAL'];
                    //  echo "<script>console.log('".print_r($row['APPROVED_TOTAL'], true)."')</script>";
                  }
    
                $sql2 = "SELECT DISTINCT `PRODUCT` PRODUCT, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
                where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) = '$start_date'
                group by `PRODUCT`
                order by round(sum(`TOTAL PRICE`),2) desc limit 10";
                $top_products = mysqli_query($link, $sql2);

                $sql4 = "SELECT DISTINCT `HOSPITAL CITY` CITY, round(sum(`TOTAL PRICE`),2) TOTAL , round(((sum(`TOTAL PRICE`)/ $top_product_result)*100),2) PERCENTAGE FROM MELJOHN_UPLOAD_SATISH.RAW_ORDER_DATA 
                where `ORDER APPROVER STATUS` = 'APPROVED' and `CFA APPROVER STATUS` != 'CANCELLED' and date(`ORDER DATE`) = '$start_date'
                group by `HOSPITAL CITY`
                order by round(sum(`TOTAL PRICE`),2) desc limit 10";
                $top_area = mysqli_query($link, $sql4);

                
              $top4_products_name = array(); 
              $top4_products_per = array();
              while ($row = $top_products->fetch_array(MYSQLI_ASSOC)) {
                array_push($top4_products_name, $row['PRODUCT']);
                // echo "<script>console.log(".$row['PRODUCT'].")</script>";
                array_push($top4_products_per, $row['PERCENTAGE']);
                // echo "<script>console.log(".$row['PERCENTAGE'].")</script>";
              }


              $top4_area_name = array(); 
              $top4_area_per = array();
              while ($row = $top_area->fetch_array(MYSQLI_ASSOC)) {
                array_push($top4_area_name, $row['CITY']);
                // echo "<script>console.log(".$row['PRODUCT'].")</script>";
                array_push($top4_area_per, $row['PERCENTAGE']);
                // echo "<script>console.log(".$row['PERCENTAGE'].")</script>";
              }


?>



<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>


  <div class="row">
      <div class="col-xl-12">
          <div class="card border">
              <div class="card-header">
                  <h4 class="card-title mb-0">Line with Data Labels</h4>
              </div>
              <div class="card-body">
                <canvas id="myChart1" style="width:100%;"></canvas>
              </div>
          </div>
          <!--end card-->
      </div>
  </div>


  <div class="row">
      <div class="col-xl-6">
          <div class="card border">
              <div class="card-header">
                  <h4 class="card-title mb-0">Dashed Line</h4>
              </div>
              <div class="card-body">
                <canvas id="myChart2" style="width:100%;max-width:600px; "></canvas>
              </div>
          </div>
          <!--end card-->
      </div>
      <div class="col-xl-6">
          <div class="card border">
              <div class="card-header">
                  <h4 class="card-title mb-0">Dashed Line</h4>
              </div>
              <div class="card-body">
                <canvas id="myChart3" style="width:100%;max-width:600px; "></canvas>
              </div>
          </div>
          <!--end card-->
      </div>
  </div>




<script>




var xValues = ["Jan", "Feb", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
// var xValues = JSON.parse('<?=php //json_encode($top4_products_name)?>');
var yValues = [55, 49, 44, 24, 15, 41, 52, 56, 52, 13, 34, 42];
// var yValues  = JSON.parse('<?=php //json_encode($top4_products_per)?>');
var barColors = [
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
  "rgb(149,163,212)",
];

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }],
    }
  }
});
</script>



<script>

// var xValues = JSON.parse('<?= //json_encode($top4_area_name)?>');
// var yValues  = JSON.parse('<?= //json_encode($top4_area_per)?>');
var xValues = ["Delhi", "Mumbai", "Kolkata", "Indore", "Bhopal "];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Description of pie chart"
    }
  }
});
</script>



<script>





var xValues = ["Delhi", "Mumbai", "Kolkata", "Indore", "Bhopal "];
var yValues = [55, 49, 44, 24, 15];




var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];


new Chart("myChart3", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Top Contributers"
    }
  }
});

</script>


</body>
</html>



