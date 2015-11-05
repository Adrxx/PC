<?php

require_once('actividad.php');
require_once('aliado.php');
require_once('competencia.php');
require_once('connectvars.php');
require_once('mensaje.php');
require_once('notificacion_voluntario.php');
require_once('voluntario_actividad.php');

function getColorFromInteres($interes)
{
		
		$titulo = "";
		
		switch($interes)
		{
						case "medio":
							$titulo = "#27c177";						
							break;
						case "educacion":
							$titulo = "#fbaa0f";						
							break;						
						case "salud":
							$titulo = "#62a9df";
							break;
						case "emprendimiento":
							$titulo = "#af86f4";
							break;
						case "deportes":
							$titulo = "#ec4e5d";
							break;
						case "arte":
							$titulo = "#dd85e5";
							break;
						case "ciencia":
							$titulo = "#b0b0b0";
							break;
						case "derechos":
							$titulo = "#4c70c1";
							break;
						
		}
		
		return $titulo;

		
}

function diaDeFecha($fecha)
{	
	$time = strtotime($fecha);
	
	$dia = date('d', $time);
	

	$dia = ltrim ($dia, '0');
	
	return $dia;
}

function mesDeFecha($fecha)
{
	$time = strtotime($fecha);
	
	$mes = date('m', $time);
	
	$m = "";
	
	switch($mes)
	{
		case "01":
			$m="ENE";
			break;
		case "02":
			$m="FEB";
			break;
		case "03":
			$m="MAR";
			break;
		case "04":
			$m="ABR";
			break;
		case "05":
			$m="MAY";
			break;
		case "06":
			$m="JUN";
			break;
		case "07":
			$m="JUL";
			break;
		case "08":
			$m="AGO";
			break;
		case "09":
			$m="SEP";
			break;
		case "10":
			$m="OCT";
			break;
		case "11":
			$m="NOV";
			break;
		case "12":
			$m="DIC";
			break;
		
	}
	
	return $m;

	
}

function echoLoggedBar($selected)
{
	
	$one = " id=";
	$two = " id=";
	$three = " id=";
	
	
	switch($selected)
	{
		case 0:
			$one = "";
			$two = "";
			$three = "";
			break;
		case 1:
			$one .= "selected_tab ";
			$two = "";
			$three = "";
			break;
		case 2:
			$one = "";
			$two .= "selected_tab ";
			$three = "";
			break;
		case 3:
			$one = "";
			$two = "";
			$three .= "selected_tab ";
			break;
	}

	
	echo '<table id="tabs_container_voluntario" border="0" cellpadding="0" cellspacing="0">
							
								<tr id="row_desktop">
									<td '.$one.' class="menu_tab"><a id="menu_link"  href="inicio_voluntario.php">
										<img id="tab_icon" src="recursos/imgs/icono_inicio_blanco.png"/>
										<span id="tab_title">Inicio</span>
										</a>
									</td>
									<td '.$two.' class="menu_tab"> <a id="menu_link" href="buscar.php">
										<img id="tab_icon" src="recursos/imgs/icono_busqueda_blanco.png"/>
										<span id="tab_title">B&uacute;squeda</span>
										</a>
									</td>
									<td '.$three.' class="menu_tab"> <a id="menu_link" href="perfil_voluntario.php">
										<img id="tab_icon" src="recursos/imgs/icono_perfil_blanco.png"/>
										<span id="tab_title">Perfil</span>
										</a>
									</td>
									
								</tr>
								
								<tr id="row_mobile">
								
									<td '.$one.' class="menu_tab"><a id="menu_link"  href="inicio_voluntario.php">
										<img id="tab_icon" src="recursos/imgs/icono_inicio_blanco.png"/>
										</a>
									</td>
									<td '.$two.' class="menu_tab"><a id="menu_link"  href="buscar.php">
										<img id="tab_icon" src="recursos/imgs/icono_busqueda_blanco.png"/>
									</td>
									</a>
									<td '.$three.'class="menu_tab"><a id="menu_link"  href="perfil_voluntario.php">
										<img id="tab_icon" src="recursos/imgs/icono_perfil_blanco.png"/>
									</a>
									</td>
									
								</tr>
		
								
								
									
	</table>';
}

function echoUnloggedBar()
{
	echo'<table id="tabs_container_not_logged" border="0" cellpadding="0" cellspacing="0">						
	<tr>
		<td>

			<a href="login.php" id="inicia_sesion">Inicia sesi&oacute;n</a>
		</td>

	</tr>						
</table>';
		
}

function getActividadesDisponibles($actividades, $actuales) {
    $resultado = [];
    $i = 0;
    if ($actuales) {
        foreach($actividades as $act) {
            if ($act->getFechaFinTrabajo() >= date("Y-m-d")) {
                $resultado[$i] = $act;
                $i++;
            }
        }
    } else {
        foreach($actividades as $act) {
            if ($act->getFechaFinTrabajo() < date("Y-m-d")) {
                $resultado[$i] = $act;
                $i++;
            }
        }
    }
    return $resultado;
}

?>