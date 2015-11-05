<?php 


	require_once('PHP/global.php'); 

	require_once('PHP/actividad.php'); 
	require_once('PHP/aliado.php'); 
	require_once('PHP/voluntario.php'); 


	session_start();


	$act = new Actividad($_GET['id']);

	$ali = new Aliado($act->getIDAliado()); 

	
	$registradoBool = false;

	if (isset($_SESSION['voluntario']))
	{
		
		
		$vol = new Voluntario($_SESSION['voluntario']);
		
		$actividades = $vol->getActividades();
		
		
		foreach($actividades as $acti)
		{
			$idActi = $acti->getID();
			
			if ($idActi == $act->getID())
			{
				$registradoBool = true;
			}
			
		}
			
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

<link rel="stylesheet" type="text/css"  href="recursos/css/evento.css">

<link rel="stylesheet" media="(max-width: 600px)," type="text/css"  href="recursos/css/evento_compact.css">
   
<!-- Javascript librerias externas -->
<script src="recursos/javascript/snap.svg-min.js"></script>   
 
<!-- Javascript interno -->
<script src="recursos/javascript/evento.js"></script>
    
<title><?php echo $act->getNombre(); ?></title>
</head>
	
	<body>
		
		
			
<!-- MENUS -->
		<div id="menu_bar">
		
			
			
				<table id="menu_bar_container" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td id="logo_container"><div id="logo"></div></td>
						<td>
						
							<?php 

if(isset($_SESSION['voluntario']))
{
	  
	echoLoggedBar(0);
	
		
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
				
				
				<div id="perfil">
				
					
					<div id="icono_interes_<?php echo $ali->getSector();  ?>_white" class="foto_perfil_container"></div>

					
					<div id="nombre_perfil"> <?php echo $act->getNombre(); ?> </div>
					<a href="<?php echo 'perfil_aliado.php?id='.$ali->getID(); ?>" id="direccion_perfil"><?php



echo $ali->getNombre();
						
						?></a>
					
				

				</div>
				
				<div id="perfil_mobile">
				
					<table id="profile_mobile_table">
						<tr>
							<td id="controlled_td" width="110">
								<div id="icono_interes_<?php echo $ali->getSector();  ?>_white" class="foto_perfil_container_mobile"></div>
								
									
								</div>
							</td>
							<td>
								<div id="nombre_perfil"><?php echo $act->getNombre(); ?></div>
								
								<a href="<?php echo 'perfil_aliado.php?id='.$ali->getID(); ?>" id="direccion_perfil"><?php



echo $ali->getNombre();
						
						?></a>
										
				
								
							</td>
						</tr>
					</table>
					
					
				</div>
				
				
					<table class="titled_separator2">
					<tr>
						<td><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">Fecha</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
					
				<div id="mobile_habilidades_separator" class="titled_separator">Fecha</div>	
				
				
				<table id="fechas2" border="0" cellpadding="0" cellspacing="0">
				
					<tr>
						<td>
							<div id="fecha_activity" class="interface">
								<div id="month"><?php echo mesDeFecha($act->getFechaInicioTrabajo()); ?></div>
								<div id="day"><?php echo diaDeFecha($act->getFechaInicioTrabajo()); ?></div>
							</div>
						</td>
						<td> <img id="flechita_img" src="recursos/imgs/flechita.png" /></td>
						<td>
							<div id="fecha_activity" class="interface">
								<div id="month"><?php echo mesDeFecha($act->getFechaFinTrabajo()); ?></div>
								<div id="day"><?php echo diaDeFecha($act->getFechaFinTrabajo()); ?></div>
							</div>
						</td>
					</tr>
					
				
					
				</table>
				
				<table class="titled_separator2">
					<tr>
						<td><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">Hora</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
				<div id="mobile_separator" class="titled_separator">Hora</div>

				
				<table id="fechas2" border="0" cellpadding="0" cellspacing="0">

					<tr>
						<td>
							<div id="fechas_title2"> 
								7:00 hrs.
							</div>
						</td>
						<td> <img id="flechita_img" src="recursos/imgs/flechita.png" /></td>
						<td>
					
							<div id="fechas_title2"> 
								12:00 hrs.
							</div>
		
						</td>
					</tr>
					
				</table>
				
					
						
				
				<table class="titled_separator2">
					<tr>
						<td ><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">Lugar</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
				
				<div id="mobile_separator" class="titled_separator">Lugar</div>
				
				<div id="descripcion"> <?php  echo $act->getUbicacion(); ?> </div>
				
				<table class="titled_separator2">
					<tr>
						<td><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">Registro</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
				<div id="mobile_separator" class="titled_separator">Registro</div>
				
				<table id="fechas" border="0" cellpadding="0" cellspacing="0">
				
					<tr>
						<td id="fechas_title">
							Desde:
						</td>
						<td></td>
						<td id="fechas_title">
							Hasta:
						</td>
					</tr>
					<tr>
						<td>
							<div id="fecha_activity" class="interface">
								<div id="month"><?php echo mesDeFecha($act->getFechaInicioInscripcion()); ?></div>
								<div id="day"><?php echo diaDeFecha($act->getFechaInicioInscripcion()); ?></div>
							</div>
						</td>
						<td> <img id="flechita_img" src="recursos/imgs/flechita.png" /></td>
						<td>
							<div id="fecha_activity" class="interface">
								<div id="month"><?php echo mesDeFecha($act->getFechaFinInscripcion()); ?></div>
								<div id="day"><?php echo diaDeFecha($act->getFechaFinInscripcion()); ?></div>
							</div>
						</td>
					</tr>
					
				
			
					
					
				</table>
				
				
				<div id="dias_title">Quedan <?php 

$datetime1 = new DateTime(date('Y-m-d'));
$datetime2 = new DateTime($act->getFechaFinInscripcion());
$interval = $datetime1->diff($datetime2);
echo $interval->format('%d%');
					
					?> d&iacute;as</div>
				<div class="progress_bar">
				
				
				
					<div id="progress" style="width:<?php

$datetime1 = new DateTime($act->getFechaInicioInscripcion());
$datetime2 = new DateTime($act->getFechaFinInscripcion());
$interval = $datetime1->diff($datetime2);
$total= $interval->format('%d%');
					


$datetime1 = new DateTime($act->getFechaInicioInscripcion());
$datetime2 = new DateTime(date('Y-m-d'));
$interval = $datetime1->diff($datetime2);
$partial= $interval->format('%d%');


$porcent = ($partial*100)/$total;
											  
											  
					echo $porcent ?>%"></div>
				</div>
				
				
				<?php 
				
					if ($registradoBool)
					{
						echo '<div id="confirmacion_inscripcion">&iexcl;Ya est&aacute;s inscrito!</div>';
					}
					else
					{
						
						if (!isset($_SESSION['voluntario']))
						{
							echo '<a href="PHP/inscribir_actividad.php?idVol='.$_SESSION['voluntario'].'&idAct='.$act->getID().'" id="inscribe_button">Reg&iacute;strate para inscribirte</a>';
						}
						else
						{
							echo '<a href="PHP/inscribir_actividad.php?idVol='.$_SESSION['voluntario'].'&idAct='.$act->getID().'" id="inscribe_button">Inscr&iacute;bete</a>';
						}
						

					}
						
						
				?>
				
				
					

			</div>
			
<!-- TIMELINE (ACTIVIDADES) -->
	
			<div id="timeline">
			
				<div id="portada">
				
					<img id="foto_portada" src=<?php
echo '"data/actividad/'.$ali->getID(). '/portada.png"' ?>/>
					
				</div>
				
				<div class="titled_separator">Acerca del proyecto</div>
				
				<div id="activity">
				
					
					<div id="titulo_activity">Descripci&oacute;n</div> 
				
					
					<div class="separator"></div>
					
					<div id="content_activity" >

						<div id="descripcion_activity"><?php echo $act->getDescripcion();?> </div>

				

					</div>
					
				</div>
					
					<div id="untitled_separator"></div>
	
				<div id="activity">
					
					<div id="titulo_activity">Objetivo</div> 

					<div class="separator"></div>
					
					<div id="content_activity" >

						<div id="descripcion_activity"><?php echo $act->getObjetivo();?></div>

				

					</div>
					
					
				</div>
					
					<div id="untitled_separator"></div>

					
				<div id="activity">
				
					<div id="titulo_activity">Recompensas</div> 

					<div class="separator"></div>
					
					<div id="content_activity" >

						<div id="descripcion_activity"><?php echo $act->getRecompensas();?></div>

				

					</div>
					
				</div>
					
				<div id="activity">
					<div id="untitled_separator"></div>

					
					<div id="titulo_activity">Detalles</div> 

					<div class="separator"></div>
					
					<div id="content_activity" >

						<div id="descripcion_activity_det"><strong>Voluntarios Requeridos:</strong> <?php echo $act->getVoluntariosRequeridos()?> </div>

						<div id="descripcion_activity_det"><strong > Provisiones Requeridas:</strong> <?php echo $act->getProvisiones()?> </div>
				

					</div>
					
				</div>
				
				
				
				<?php 
				
				if ($registradoBool)
				{
	
					$act->echoAvisos();
				}
	
				?>
				
						
				
			</div>
			
		</div>
		
		
		
		
				<script>
			
				setProfileColor(<?php echo '"'.$ali->getColor().'"'; ?>);

				</script>
	</body>
		
</html>