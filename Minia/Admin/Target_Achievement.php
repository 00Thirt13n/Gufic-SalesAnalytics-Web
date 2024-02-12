<?php include 'layouts/session.php';
    require_once "layouts/config.php";

    $name_array = $target_array = $achievement_array = $value_percentage_array = [];
    $emp_id = $_SESSION['user_id'];

    $sql =  "SELECT ID,CODE,EMPLOYEE,YEAR,MONTH,AREA,HQ,TARGET,ACHIEVEMENT FROM MELJOHN_UPLOAD_SATISH.GUFIC_TARGET_VS_ACHIEVEMENT_DATA 
                where (find_in_set(ID, ifnull((select GET_MILJON_EMPLOYEE_TEAM_MEMBER_DETAILS_HIERARCHY_WEB('$emp_id')), '$emp_id')))";

    $result = mysqli_query($link, $sql);

    if ($result) {
        $sn = 1;

        foreach ($result as $data) {
        ?>
            <?php
            if ($data['MONTH'] == date('F') && $data['TARGET']!='') {
                array_push($name_array, $data['EMPLOYEE']);
                array_push($target_array, $data['TARGET']);
                array_push($achievement_array, $data['ACHIEVEMENT']);
                if($data['TARGET']==0 || $data['TARGET']==null || $data['TARGET']==' ')
                $data['TARGET']=1;
                $per = number_format(($data['ACHIEVEMENT'] * 100) / $data['TARGET'], 2);
                if ($per == 'inf')
                    $per = 'NO TARGET';
                else
                    $per .= "%";
                array_push($value_percentage_array, strval($data['ACHIEVEMENT'] . '<br>' . $per));
            }
            ?>
        <?php }
    }

?>


<div id='myDiv' style="overflow:auto"><!-- Plotly chart will be drawn inside this DIV --></div>

<script>
    var trace1 = {
        x: JSON.parse('<?= json_encode($name_array) ?>'),
        y: JSON.parse('<?= json_encode($target_array) ?>'),
        text: JSON.parse('<?= json_encode($target_array) ?>'),
        name: 'Target',
        type: 'bar',
        marker: {
            color: 'rgba(0,0,240,.6)',
        }
    };

    var trace2 = {
        x: JSON.parse('<?= json_encode($name_array) ?>'),
        y: JSON.parse('<?= json_encode($achievement_array) ?>'),
        text: JSON.parse('<?= json_encode($value_percentage_array) ?>'),
        textposition: 'top',

        name: 'Achievement',
        type: 'bar',
        marker: {
            color: 'rgba(0,240,0,.6)',
        }
    };

    var data = [trace1, trace2];

    var layout = {
        barmode: 'group'
    };

    Plotly.newPlot('myDiv', data, layout);
</script>