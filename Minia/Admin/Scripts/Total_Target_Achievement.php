<?php
include '../layouts/session.php'; 
include "../layouts/config.php";

$emp_id = isset($_POST['emp_id']) ?$_POST['emp_id'] : $_SESSION['user_id'];
$start_date = isset($_POST['start_date']) ?$_POST['start_date'] : date('y-m-01');
$end_date = isset($_POST['end_date']) ?$_POST['end_date'] :date('y-m-d');


// if($emp_id == 'MEMP_G_1'){
//     $sql = "SELECT sum(TARGET) TARGET, ID,MONTH,  sum(ACHIEVEMENT) ACHIEVEMENT,ROUND(((sum(ACHIEVEMENT)*100)/sum(TARGET)),2) ACHIVEMENT_PER
//             from MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA
//             WHERE  (MONTH(STR_TO_DATE(CONCAT(MONTH, '-01-2023'), '%M-%d-%Y'))) 
//             between ((SELECT MONTHNAME('$start_date'))) and ((SELECT MONTHNAME('$end_date')))";
// }
// else{
//     $sql = "SELECT sum(TARGET) TARGET, ID,MONTH,  sum(ACHIEVEMENT) ACHIEVEMENT,ROUND(((sum(ACHIEVEMENT)*100)/sum(TARGET)),2) ACHIVEMENT_PER
//             from MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA
//             WHERE  (MONTH(STR_TO_DATE(CONCAT(MONTH, '-01-2023'), '%M-%d-%Y'))) 
//             between ((SELECT MONTH('$start_date'))) and ((SELECT MONTH('$end_date')))
//             AND find_in_set(ID,'$emp_id')";
// }


if($emp_id == 'MEMP_G_1'){
    $sql = "SELECT sum(TARGET) TARGET, sum(ACHIEVEMENT) ACHIEVEMENT,ROUND(((sum(ACHIEVEMENT)*100)/sum(TARGET)),2) ACHIVEMENT_PER
            FROM MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA
            WHERE MONTH BETWEEN ((SELECT MONTHNAME('$start_date'))) AND ((SELECT MONTHNAME('$end_date')));";
}
else{
    $sql = "SELECT sum(TARGET) TARGET, sum(ACHIEVEMENT) ACHIEVEMENT,ROUND(((sum(ACHIEVEMENT)*100)/sum(TARGET)),2) ACHIVEMENT_PER
            FROM MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA
            WHERE MONTH BETWEEN ((SELECT MONTHNAME('$start_date'))) AND ((SELECT MONTHNAME('$end_date')))
            AND find_in_set(ID,'$emp_id')";
}

$total_target_achievement_result = mysqli_query($link, $sql);

// if($total_target_achievement_result) {
    
    while ($row = $total_target_achievement_result->fetch_array(MYSQLI_ASSOC)) {
        $target = $row['TARGET'];
        $achievement_val = $row['ACHIEVEMENT'];
        $ach_per = $row['ACHIVEMENT_PER'];
    }
    if(!$target) $target = 0;
    if(!$achievement_val) $achievement_val = 0;
    if(!$ach_per) $ach_per = 0;
?>

    <div class="row salesCard">
        <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Target & Achievement</span></span>
    </div>
    <div class="row salesCard">
        <div class="col-xl-4 col-md-4">
            <div class="d-flex card card-h-100">
                <div class="card-body shadow-lg border rounded bg-soft-white">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Target</span>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-soft-primary text-primary total-badge"><span>&#8377</span><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $target) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="d-flex card card-h-100">
                <!-- card body -->
                <div class="card-body shadow-lg border rounded bg-soft-white">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Achievement</span>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-soft-success text-success total-badge"><span>&#8377</span><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $achievement_val) ?></span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="d-flex card card-h-100">
                <!-- card body -->
                <div class="card-body shadow-lg border rounded bg-soft-white">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-nowrap h5">Achievement Percentage </span>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-soft-warning text-warning total-badge"><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $ach_per) ?><span>&#x00025</span></span>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
    </div>

<?php

// } else {
//     echo 'Data not found';
// }
?>
