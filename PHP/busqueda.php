<?php
require_once('connectvars.php');
require_once('actividad.php');
require_once('global.php');
require_once('aliado.php');

function buscar($interes, $texto) {
    $dbc = mysqli_connect(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2) 
        or die("ERROR!" . mysqli_error($dbc));
    $query = "";
    $actividades = [];
    $i=0;
    if (!is_null($interes)) {
        $query = "SELECT ID FROM Aliado WHERE sector='$interes'";
        if (!is_null($texto)) {
            $query = "SELECT ID FROM Actividad WHERE descripcion LIKE '%$texto%'" .
                " and ID_aliado IN (" . $query . ")";
        }
    } else {
        $query = "SELECT ID FROM Actividad WHERE descripcion LIKE '%$texto%'";
    }
    $data = mysqli_query($dbc, $query) or die ("Error" . mysqli_error($dbc));
    foreach($data as $d) {
        foreach($d as $id) {
            $actividades[$i] = new Actividad($id);
            $i++;
        }
    }
    return getActividadesDisponibles($actividades,true);
}


function echoActividadesBusqueda($actividades)
{


	foreach($actividades as $act)
	{
		
		$ali = new Aliado($act->getIDAliado());
		
		echo '<div id="activity"><table id="header_activity">' . 
                '<tr>
				
				<td width="60">
				<div id="icono_interes_'.$ali->getSector().'_color" class="categoria_activity"></div>
				</td>
				<td><div id="titulo_activity" style="color:'.$ali->getColor().'" >' .
                $act->getNombre() .
                '</div> <a href="perfil_aliado.php?id='.$ali->getID().'" id="subtitulo_activity">' .
                $ali->getNombre() .
                '</a></td><td width="72">' .
                '<div id="fecha_activity" class="interface">' .
                '<div id="month">' .
                mesDeFecha($act->getFechaInicioTrabajo()) .
                '</div><div id="day">' .
                diaDeFecha($act->getFechaInicioTrabajo()) .
                '</div></div></td></tr></table><div class="separator">' .
                '</div><div id="content_activity" ><div id="descripcion_activity">' .
                $act->getDescripcion() .
                '</div><a href="evento.php?id='.$act->getID().'" id="visitar_button" style="background-color:'.$ali->getColor().'" >P&aacute;gina del evento</a></div></div>';
		
	
	}
	
}


?>
