<?php 
require('../conexion.php');

$mysqli->set_charset("utf8");
$mysqli->query("SET NAMES 'utf8'");
$mysqli->query("SET CHARACTER SET utf8");

$cons = $mysqli->query("SELECT DISTINCT ct.cr_id_tareas as cenco, u.cr_nombre as resp, DATE_FORMAT(ct.cr_f_ini, '%Y,%m,%d') AS inicio, DATE_FORMAT(ct.cr_f_fin, '%Y,%m,%d') AS fin, cp.cr_num_p as proy, TIMESTAMPDIFF(DAY, ct.cr_f_ini, ct.cr_f_fin) AS duracion FROM cr_tareas ct INNER JOIN cr_proyecto cp, cr_usuario u WHERE ct.cr_id_proy = cp.cr_id_proy AND ct.cr_id_usuario = u.cr_id_usuario AND u.cr_nombre <> 'SIN ASIGNAR' ");


$rows = array();
$table = array();
$table['cols'] = array(
// Labels for your chart, these represent the column titles.
array('label' => 'Task ID', 'type' => 'string'), //id tareas
array('label' => 'Task Name', 'type' => 'string'), //resp
array('label' => 'Resource', 'type' => 'string'), //proyecto
array('label' => 'Inicio', 'type' => 'date'), // inicio
array('label' => 'Fin', 'type' => 'date'), // fin
array('label' => 'Duration', 'type' => 'number'), // contar dias
array('label' => 'Percent Complete', 'type' => 'number'), // null
array('label' => 'Dependencies', 'type' => 'string') // null

);
/* Extract the information from $result */
foreach($cons as $r) {
  $temp = array();
  $days = (int) $r['duracion'];
  $day = "daysToMilliseconds(".$days.")"; 
   
  
  // Values of the each slice
  $temp[] = array('v' =>  $r['cenco']); 
  $temp[] = array('v' =>  $r['resp']); 
  $temp[] = array('v' =>  $r['proy']); 
  $temp[] = array('v' =>  'Date('.$r['inicio'].')'); 
  $temp[] = array('v' =>  'Date('.$r['fin'].')'); 
  $temp[] = array('v' => $day); 
  $temp[] = array('v' => 100); 
  $temp[] = array('v' => NULL);
  $rows[] = array('c' => $temp);
}
$table['rows'] = $rows;
// convert data into JSON format
$jsonTable_act = json_encode($table);
//echo $jsonTable_act;
         
?>


<html lang="es">
  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }
   

    function drawChart() {

  
  var data = new google.visualization.DataTable(<?php echo $jsonTable_act; ?>);
  

    var options = {
        height: 1024,
        gantt: {
          trackHeight: 30
        }
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
  </script>
  </head>

  <body>
    <!--this is the div that will hold the chart-->
    <div id="chart_div"></div>
  </body>
</html>