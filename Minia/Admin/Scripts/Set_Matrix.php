<?php
    
    include '../layouts/session.php';
    require_once "../layouts/config.php";
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST['data'];

        if (isset($_POST['data'])) {
            $sql = "UPDATE approval_matrix_test SET 
                    MOLECULE = '" . $data['molecule'] . "',
                    STRENGTH = '" . $data['strength'] . "',
                    `Finalised Brand Name` = '" . $data['brand'] . "',
                    MRP = '" . $data['mrp'] . "',
                    `BASE PRICE` = '" . $data['base_price'] . "',
                    ABM_FROM = '" . $data['abm_from'] . "',
                    ABM_TO = '" . $data['abm_to'] . "',
                    RBM_FROM = '" . $data['rbm_from'] . "',
                    RBM_TO = '" . $data['rbm_to'] . "',
                    ZBM_FROM = '" . $data['zbm_from'] . "',
                    ZBM_TO = '" . $data['zbm_to'] . "',
                    BU_FROM = '" . $data['bu_from'] . "',
                    BU_TO = '" . $data['bu_to'] . "',
                    HO = '" . $data['ho'] . "'
                    WHERE `Sl No` = " . $data['siNo'];

            if ($link->query($sql) === TRUE) {
                echo 1;
            } else {
                echo 0;
            }
        }
        else echo 2;


    }
    else echo 3;
 ?>

