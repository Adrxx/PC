<?php 

require_once("voluntario_actividad.php");

$idVol = $_GET['idVol'];
$idAct = $_GET['idAct'];


$actVol = new VoluntarioActividad(NULL, $idVol, $idAct, "aprobado", 0 );


$actVol->guardarActividad();

header("Location: http://www.ment.com.mx/pc/evento.php?id=".$idAct);



?>