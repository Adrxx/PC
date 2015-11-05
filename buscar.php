<?php


require_once("PHP/global.php");
require_once("PHP/busqueda.php");
require_once("PHP/actividad.php");
require_once("PHP/voluntario.php");



session_start();

$textoBusqueda = $_GET['texto'];
$filtro = $_GET['filtro'];


if (!isset($_SESSION['voluntario']))
{
	header("location: http://www.ment.com.mx/pc/login.php");
}




?>


<!DOCTYPE html>
<html>
<head>

<!-- JQUERY / JQUERY MOBILE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf16_spanish_ci" />
 
<!-- ViewPort no scalable/zoomable -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="recursos/css/universal.css">

<link rel="stylesheet" media="(max-width: 600px)," type="text/css"  href="recursos/css/universal_compact.css">

<link rel="stylesheet" type="text/css"  href="recursos/css/busqueda.css">

<link rel="stylesheet" media="(max-width: 600px)," type="text/css"  href="recursos/css/busqueda_compact.css">
   
<!-- Javascript librerias externas -->
<script src="recursos/javascript/snap.svg-min.js"></script>   
 
<!-- Javascript interno -->
<script src="recursos/javascript/busqueda.js"></script>
    
<title>B&uacute;squeda</title>
</head>
	
	<body ontouchstart="">
		
<!-- MENUS -->
		<div id="menu_bar">
		
						
				<table id="menu_bar_container" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td id="logo_container"><div id="logo"></div></td>
						<td>	
							<?php 

if(isset($_SESSION['voluntario']))
{
	  
	echoLoggedBar(2);
	
		
}
else
{
	echoUnloggedBar();
}
							
							?>
							
						</td>
					</tr>
				</table>
			
				
	
		</div>
		
		
		<div id="main_panel">
		
<!-- SIDEBAR (PERFIL) -->
			<div id="sidebar">
				
			<div>
			
				<div id="search_bar">

						<input placeholder="Buscar" id="search_box">


				</div>
								<div id="untitled_separator"></div>

				<div id="filtros">
				
					<div id="filtros_interes" class ="filtro_active" onclick="expandirFiltro(this)" value=""><span placeholder="Inter&eacute;s">Inter&eacute;s</span>

						<svg id="one" class="indicator"></svg>
						
					</div>
					
					<div id="dropdown_filtro">

							<div id="sin_filtro" class="filtro_interes" value="">Sin filtro
							</div>
							<div class="separator"></div>
							<div class="filtro_interes" value="medio">Medio ambiente
								<div id="icono_interes_medio_color" class="filtro_icon"></div> 						
							</div>
							<div class="separator"></div>
							
							<div class="filtro_interes" value="educacion"><span>Educaci&oacute;n</span>
								<div id="icono_interes_educacion_color" class="filtro_icon"></div>
							</div>
							<div class="separator"></div>

							<div class="filtro_interes" value="salud"><snap>Salud</snap>
								<div id="icono_interes_salud_color" class="filtro_icon"></div>
							</div>
							<div class="separator"></div>

							<div class="filtro_interes" value="emprendimiento">Emprendimiento
								<div id="icono_interes_emprendimiento_color" class="filtro_icon"></div>
							</div>
							<div class="separator"></div>

							<div class="filtro_interes" value="deporte">Deporte y recreaci&oacute;n
								<div id="icono_interes_deportes_color" class="filtro_icon"></div>
							</div>
							<div class="separator"></div>

							<div class="filtro_interes" value="arte">Arte y Cultura
								<div id="icono_interes_arte_color" class="filtro_icon"></div>
							</div>
							<div class="separator"></div>
							
							<div class="filtro_interes" value="ciencia">Ciencia y tecnolog&iacute;a
								<div id="icono_interes_ciencia_color" class="filtro_icon"></div>
							</div>
							<div class="separator"></div>

							<div class="filtro_interes" value="derechos">Derechos Humanos
								<div id="icono_interes_derechos_color" class="filtro_icon"></div>
							</div>




						</div>

					<div class="separator"></div>

					<div id="filtros_interes" onclick="expandirFiltro(this)"><span placeholder="Ubicaci&oacute;n">Ubicaci&oacute;n</span>

						<svg id="two" class="indicator"></svg>

					</div>
					
					<div id="dropdown_filtro">
						
						<div id="sin_filtro" class="filtro_interes"><span>Sin filtro</span>
						</div>
						<div class="separator"></div>

						<div id="centered" class="filtro_interes"><span>Cercanos a m&iacute;</span>
						</div>
						<div class="separator"></div>

						<div id="centered" class="filtro_interes"><span>En mi municipio</span>
						</div>
						<div class="separator"></div>

						<div  id="centered" class="filtro_interes"><span>En mi estado</span>
						</div>
						

					</div>


					<div class="separator"></div>

					<div id="filtros_interes" onclick="expandirFiltro(this)"><span placeholder="Fecha de inicio">Fecha de inicio</span>

						<svg id="three" class="indicator"></svg>


					</div>
					
					<div id="dropdown_filtro">
						
						
						<div id="sin_filtro" class="filtro_interes">Sin filtro
							</div>
						<div class="separator"></div>

						<div id="centered" class="filtro_interes">Este mes
						</div>
						<div class="separator"></div>

						<div id="centered" class="filtro_interes">El pr&oacute;ximo mes
						</div>
						<div class="separator"></div>

						<div  id="centered" class="filtro_interes">En tres meses
						</div>
						

					</div>
				
				</div>
				
												<div id="untitled_separator"></div>

				<div id="buscar_boton">Buscar</div>
		

			</div>
			
			
				

			</div>
			
<!-- TIMELINE (ACTIVIDADES) -->
	
			<div id="timeline">
			
				
				
				<?php 
				

				
				echo '<div class="titled_separator">Resultados</div>';

				$resultados = buscar($filtro,$textoBusqueda);
	
				echoActividadesBusqueda($resultados);
				


				$vol = new Voluntario($_SESSION['voluntario']);

				$intereses = $vol->getIntereses();

		

				if (!empty($intereses))
				{
					echo '<div class="titled_separator">Actividades sugeridas</div>';

						foreach ($intereses as $inter)
						{
							
						$resultados = buscar($inter,NULL);
							
						if (!empty($resultados))
						{
							echoActividadesBusqueda($resultados);

						}
						



					}
				}
				
				


				
				?>
								
				
			</div>
			
		</div>
		
		
		
		
				<script>
				setProfileColor("#007940");

				</script>
	</body>
		
</html>