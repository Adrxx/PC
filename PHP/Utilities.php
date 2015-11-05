<?php 

//Utilities
/*
function imprimirBadge($puntaje){
	
	if ($puntaje > )
	
	
	["Trabajo en equipo","Adaptabilidad","Liderazgo","Creatividad","Iniciativa","Comunicación"]);
}
*/


require_once("competencia.php");
require_once("actividad.php");

require_once("notificacion_voluntario.php");


$com = new Competencia(NULL,3,"Trabajo en equipo",8);
$com1 = new Competencia(NULL,3,"Adaptabilidad",7);
$com2 = new Competencia(NULL,3,"Liderazgo",10);
$com3 = new Competencia(NULL,3,"Creatividad",10);
$com4 = new Competencia(NULL,3,"Iniciativa",8);
$com5 = new Competencia(NULL,3,"Comunicaci&oacute;n",6);

$com->guardarCompetencia();
$com1->guardarCompetencia();
$com2->guardarCompetencia();
$com3->guardarCompetencia();
$com4->guardarCompetencia();
$com5->guardarCompetencia();
$com5->guardarCompetencia();


/*
$act = new Actividad(1);


$act->crearNotificacion("Junta importante","El día 28 de noviembre, tendremos una junta para asignar roles y explicar la logística del evento. Por favor confirmenos por mensaje directo. ¡Gracias!",date("Y-m-d"));

*/

?>
	