<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<br/>


<form action="" method="post">

  <div class="row salesCard mt-lg-3">
        <form method="post">
            <div class="row" >
                <div class="col-md-2 col-lg-2">
                    <div>
                        <div class="mb-3">
                            <label for="example-date-input" class="form-label">Select Date</label>
                            <input type="date" class="form-control" value= <?php echo date('Y-m-d')?> id="datepicker" name="start-date">
                        </div>      
                    </div>
                </div>
                <div class="col-md-1 col-lg-1">
                    <div class=" mt-lg-0">
                        <div class="mb-3" style="margin-top: 1.8rem;">
                            <button type="submit" class="btn btn-primary"  style="padding :10.9px 16.9px !important">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </form>

<script>
$("#datepicker").datepicker( {
    format: "dd-mm-yyyy",
    startView: "days", 
    minViewMode: "days"
});


</script>