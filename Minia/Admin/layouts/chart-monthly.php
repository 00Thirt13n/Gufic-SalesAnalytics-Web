
<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<!-- <div class="row">
  <div class="col-md-6">
    <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
  </div>
  <div class="col-md-6">
    <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
  </div>


</div> -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card border">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line with Data Labels</h4>
                            </div>
                            <div class="card-body">
                              <canvas id="myChart1" style="width:100%;max-width:600px;"></canvas>
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
                              <canvas id="myChart2" style="width:100%;max-width:600px;"></canvas>
                            </div>
                        </div>
                        <!--end card-->
                    </div>
                </div>


<script>
var xValues = ["Jan", "Feb", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var yValues = [55, 49, 44, 24, 15, 41, 52, 56, 52, 13, 34, 42];
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
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
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
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>

</body>
</html>



