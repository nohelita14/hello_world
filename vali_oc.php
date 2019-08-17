<?php 
require"../conexion.php";
if( ! ini_get('date.timezone') ) { date_default_timezone_set('America/Santiago'); } 

$data = json_decode(stripslashes($_POST['data']));
var_dump($data);
// decodificas el JSON


?>
