<?php
    
    include '../layouts/session.php';
    require_once "../layouts/config.php";

    
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['brand_name']) && isset($_POST['molecule']) && isset($_POST['therapy']) && isset($_POST['strength']) && isset($_POST['product_code']) && isset($_POST['mrp'])) {
            
            $finalised_brand_name = $_POST['brand_name'];
            $molecule = $_POST['molecule'];
            $therapy = $_POST['therapy'];
            $strength = $_POST['strength'];
            $product_code = $_POST['product_code'];
            $msp = $_POST['mrp'];

            $product_existance_query = "SELECT count(PROD_CODE) as count FROM MELJOHN_UPLOAD_SATISH.BULK_UPLOAD_PRODUCT WHERE PROD_CODE = '$product_code'";
            $result = mysqli_query($link, $product_existance_query);

            error_log('ID: '. $product_existance_query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if($row['count'] > 0){
                        echo 0;
                    }
                    else{
                        // USER "MELJOHN_UPLOAD_SATISH_DEMO" DB FOR TESTING

                        $sql = "INSERT INTO MELJOHN_UPLOAD_SATISH.BULK_UPLOAD_PRODUCT
                                (CREATED,PROD_NAME,CATEGORY,PROD_DESC,PROD_COMPOSITION,MANUFCTR_ID,MSP,BU_ID,PROD_STATUS,PROD_CODE,FORM,PACK,PTR,PTS,PTSP,BRAND_OWN_BY,MANUFACTURER,SKU,USAGE_UNIT,PACK_DESCRIPTION,GSTN_VALUE,PROCESS_FLAG,PROCESS_INFORMATION,SCHEME,SCHEME_DESCRIPTION,SCHEME_QUANTITY,SCHEME_EXPIRY,BRAND_CATEGORY,IMAGE)
                                VALUES(now(),'$finalised_brand_name','DRUGS','$molecule','$strength','MANF_1','$msp','BU_1','ALL','$product_code','$strength','$strength','$msp',0,0,'GUFIC','GUFIC','$strength','NA','$strength',18,0,'$therapy',null,null,null,null,'VACCINE',null)";
                        
                        // echo "<script>alert('$sql')</script>";
                        $result = mysqli_query($link, $sql);


                        $sql_call = "call MELJOHN_UPLOAD_SATISH.BULK_PRODUCT_DETAIL()";
                        $res_call = mysqli_query($link,$sql_call);

                        if($result && $res_call)
                            echo 1;
                        else 
                            echo 4;
        
                    }
                }
            }
            

        }
        
        else 
          echo 2;


    }
    else{
        echo 3;
    }
 
 ?>
