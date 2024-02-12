<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<br/>

<form action="" method="post">

    <div class="row d-flex">
        
        <div class="col-lg-2 col-md-3 col-sm-2">
          <input  type="text" class="form-control" name="datepicker1" id="datepicker1" placeholder="Select date" />
        </div>
        <div class="col-lg-2 col-md-3 col-sm-2">
          <input  type="text" class="form-control" name="datepicker2" id="datepicker2" placeholder="Select date" />
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
          <input type="submit" class="form-control" name="submit" value="Submit"/>
        </div>
    </div>

  </form>

<script>
$("#datepicker1").datepicker( {
    format: "dd-mm-yyyy",
    startView: "days", 
    minViewMode: "days"
});

$("#datepicker2").datepicker( {
    format: "dd-mm-yyyy",
    startView: "days", 
    minViewMode: "days"
});


</script>