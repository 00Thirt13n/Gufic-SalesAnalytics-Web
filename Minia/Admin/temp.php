<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- <form method="POST" action="">
        <input type="submit" name="data" value="Get Top Data"/>
    </form> --> 
    <?php  
    // include 'layouts/session.php';
    // require_once "layouts/config.php";

    // if(isset($_POST['data'])){
    //     $sql = "CALL GET_GUFIC_DASHBOARD_DATA_TOP_BOTTOM('MEMP_G_1','TOP','20230601','20230616', 'PRODUCT')";
    //     $result = mysqli_query($link, $sql);
    //     foreach ($result as $key => $value) {

    //         foreach ($value as $val) {
    //             $response[$val['TABLE_NAME']][] = $val;
    //             foreach ($response[$val['TOP']] as $var)
    //                 echo $var;
    //         }
    //     }
    // }
    ?> 

    <form action="" method="post"><button id="retrieveBtn">Retrieve Data</button></form>
    <div id="result"></div>

    <script>
        $(document).ready(function() {
        $('#retrieveBtn').click(function() {
            $.ajax({
            url: 'https://gufic.globalspace.in/mediapp/AdminWeb/Minia/Admin/temp.php',
            type: 'POST',
            dataType: 'html',
            success: function(response) {
                $('#result').html(response); // Display the retrieved data in the 'result' div
            }
            });
        });
        });

    </script>


    <?php
    // Establish database connection

    include 'layouts/session.php';
    require_once "layouts/config.php";
    // Write your database query
    $query = "CALL GET_GUFIC_DASHBOARD_DATA_TOP_BOTTOM('MEMP_G_1','TOP','20230601','20230616', 'PRODUCT')";

    // Execute the query
    $result = mysqli_query($link, $query);

    // Process and generate the HTML response
    $response = '';

        foreach ($result as $key => $value) {
             foreach ($value as $val) {
                 $response .= $val . '<br>';
             }
         }
    
    return $response; // Return the response to the AJAX request
    ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
</body>
</html>

<head>


</head>






