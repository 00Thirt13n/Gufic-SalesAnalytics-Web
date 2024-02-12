<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dropdown Example</title>
</head>
<body>
<div class="row mt-4">

  <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">

    <label for="zbm">Country:</label>
    <select id="zbm" class="my-dropdown">
      <option value="">Select a country</option>
      <option value="MEMP_G_12">JASVIDER</option>
      <option value="Canada">Canada</option>
      <option value="Mexico">Mexico</option>
    </select>
  </div>

  <div class="btn-group col-lg-3 col-md-6 col-sm-6 mb-1">
    <label for="state">State:</label>
    <select id="abm" class="my-dropdown">
       <option value="">Select a state</option>
       <option value="MEMP_G_21">Rohit Singh</option>
      <!-- <option value="New York">New York</option>  
      <option value="Texas">Texas</option> -->
    </select>
  </div>
</div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Get references to the dropdowns
    var countryDropdown = document.getElementById("zbm");
    var stateDropdown = document.getElementById("state");

    // Add event listeners to the dropdowns
    countryDropdown.addEventListener("change", callMyFunction);
    stateDropdown.addEventListener("change", callMyFunction);

    function callMyFunction(event) {
        console.log ("12");

      // Get the values of the dropdown that triggered the event
      var dropdown = event.target;
      var value = dropdown.value;
      var dropdownId = dropdown.id;
      console.log (value,dropdownId);

      // Call the PHP function with the dropdown value, dropdown ID, and any other parameters as needed
      $.ajax({
        url: "layouts/myphpfile.php",
        type: "POST",
        data: { functionName: "GetEmployeeArray", param1: value, dropdownId: dropdownId },
        success: function(data) {
          // Handle the response from the server
          var select = $('#abm');
          select.empty();
          for (var i = 0; i < data.length; i++) {
            var option = $('<option></option>').val(data[i][0]).html(data[i][1]);
            select.append(option);
          }

        },
        error: function(xhr, status, error) {
          // Handle errors
          console.error(xhr);
        }
      });
    }
  </script>
</body>
</html>
