<?php
    
    include '../layouts/session.php';
    require_once "../layouts/config.php";
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['data'])) {

            $data = $_POST['data'];
            

            parse_str($data, $formData);

            // Retrieve values from the array
            $therapy = $formData['therapy'];
            $product_code = $formData['product_code'];
            $molecule = $formData['molecule'];
            $strength = $formData['strength'];
            $finalised_brand_name = $formData['finalised_brand_name'];
            $mrp = $formData['mrp'];
            $base_price = $formData['base_price'];
            $abm_from = $formData['abm_from'];
            $abm_to = $formData['abm_to'];
            $rbm_from = $formData['rbm_from'];
            $rbm_to = $formData['rbm_to'];
            $zbm_from = $formData['zbm_from'];
            $zbm_to = $formData['zbm_to'];
            $bu_from = $formData['bu_from'];
            $bu_to = $formData['bu_to'];
            $ho = $formData['ho'];

            

            // USE "approval_matrix_test" FOR TESTING
            $product_existance_query = "SELECT count(`Product code`) as product_count FROM `MELJOHN_UPLOAD_SATISH`.`approval_matrix_final` where `Product code` = '$product_code'";
            $result = mysqli_query($link, $product_existance_query);
            $row_count = mysqli_fetch_assoc($result); 

                if($row_count > 0){
                    echo 0;
                }
                else{
            
                        $sql = "INSERT 
                                    INTO approval_matrix_final
                                        (THERAPY, MOLECULE, STRENGTH, `Finalised Brand Name`, MRP, `BASE PRICE`, ABM_FROM, ABM_TO, RBM_FROM, RBM_TO, ZBM_FROM, ZBM_TO, BU_FROM, BU_TO, HO, `Product Code`) 
                                    VALUES 
                                        ('$therapy', '$molecule', '$strength', '$finalised_brand_name', '$mrp', '$base_price', '$abm_from', '$abm_to', '$rbm_from', '$rbm_to', '$zbm_from', '$zbm_to', '$bu_from', '$bu_to', '$ho', '$product_code')
                                ";

                        if (mysqli_query($link, $sql)) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                }
            
        }
        else echo 3;
    }
    else echo 4;
 ?>

