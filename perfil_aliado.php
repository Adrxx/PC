<?php 


	require_once('PHP/global.php'); 

	require_once('PHP/aliado.php'); 

	session_start();

	$ali = new Aliado($_GET['id']);

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

<link rel="stylesheet" type="text/css"  href="recursos/css/perfil_aliado.css">

<link rel="stylesheet" media="(max-width: 600px)," type="text/css"  href="recursos/css/perfil_aliado_compact.css">
   
<!-- Javascript librerias externas -->
<script src="recursos/javascript/snap.svg-min.js"></script>   
 
<!-- Javascript interno -->
<script src="recursos/javascript/perfil_aliado.js"></script>

<script src="recursos/javascript/polygonalGraph.js"></script>
<script src="recursos/javascript/smartPhotosPane.js"></script>
    
<title><?php echo $ali->getNombre(); ?></title>
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
				
					
					<div class="foto_perfil_container"><img id="foto_perfil" src=<?php
echo '"data/aliados/'.$ali->getID(). '/perfil.png"' ?>/></div>
										
										
																	
					<div id="estrellas_perfil">
						
						<?php $ali->echoRating(); ?>

					</div>
					
					<div id="nombre_perfil"><?php echo $ali->getNombre(); ?></div>
					<div id="direccion_perfil"><?php echo $ali->getUbicacion(); ?></div>
					
					<div id="info_extra_perfil">
						
						
						<div id="edad_perfil">Bio: <span id="light"><?php echo $ali->getBiografia(); ?></span> </div>

						<div id="edad_perfil">Proyectos en curso: <span id="light"> <?php echo count($ali->getActividades); ?> </span> </div>
						
						<div id="edad_perfil">Proyectos realizados: <span id="light">4</span> </div>
						
						<div id="edad_perfil">Ayudando desde: <span id="light">2014</span> </div>
						
						<div id="edad_perfil">Contacto: <span id="light"><?php echo $ali->getContacto(); ?></span> </div>
						
				
					
						
					</div>
					<div id="mas_info" onclick="expandirPerfil()" class="interface">...</div>
				

				</div>
				
				<div id="perfil_mobile">
				
					<table id="profile_mobile_table">
						<tr>
							<td id="controlled_td" width="110">
								<div class="foto_perfil_container_mobile">
									<img id="foto_perfil" src=<?php
echo '"data/aliados/'.$ali->getID(). '/perfil.png"' ?>/>
									
								</div>
							</td>
							<td>
						<div id="nombre_perfil"><?php echo $ali->getNombre(); ?></div>
						<div id="direccion_perfil"><?php echo $ali->getUbicacion(); ?></div>
										
				<div id="estrellas_perfil">
						
						<?php $ali->echoRating(); ?>

					</div>
						
							<div id="mas_info" onclick="expandirPerfilMobile()" class="interface">...</div>
								
							</td>
						</tr>
					</table>
					
					<div id="info_extra_perfil_mobile">
						
						
						<div id="edad_perfil">Bio: <span id="light"><?php echo $ali->getBiografia(); ?></span> </div>
						
						<div id="edad_perfil">Proyectos en curso: <span id="light"> <?php echo count($ali->getActividades); ?> </span> </div>
						
						
						<div id="edad_perfil">Proyectos realizados: <span id="light">4</span> </div>
						
						<div id="edad_perfil">Ayudando desde: <span id="light">2014</span> </div>
						
						<div id="edad_perfil">Contacto: <span id="light"><?php echo $ali->getContacto(); ?></span> </div>
						
						
						
						
						


						
					</div>
					
				</div>
				
				
				<script>
			
				setProfileColor(" <?php echo $ali->getColor(); ?> ");

				</script>
				
				<table class="titled_separator2">
					<tr>
						<td ><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">Descripci&oacute;n</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
				
				<div id="mobile_habilidades_separator" class="titled_separator">Descripci&oacute;n</div>
				
				<div id="descripcion"> <?php echo $ali->getDescripcion(); ?> </div>
				
				<table class="titled_separator2">
					<tr>
						<td><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">&Aacute;rea principal</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
				<div id="mobile_separator" class="titled_separator">&Aacute;rea principal</div>
				
				<table id="intereses" border="0" cellpadding="0" cellspacing="0">
				
						<?php $ali->echoSector(); ?>

				</table>
				
				
				<table class="titled_separator2">
					<tr>
						<td><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">&Aacute;reas relacionadas</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
				<div id="mobile_separator" class="titled_separator">&Aacute;reas relacionadas</div>
				
				
				<table id="intereses_secundarios" border="0" cellpadding="0" cellspacing="0">
				
					<tr>
						
						<?php 

$sec1 = $ali->getSubsectorUno();
$sec2 = $ali->getSubsectorDos();


if ($sec1!= "")
{
	
	$ali->echoSectorSecundario($sec1,true); 
	
}


if ($sec2 != "")
{
	
	$ali->echoSectorSecundario($sec2,true); 
	
}
					
					
					?>
						
					</tr>
					<tr >
					
					<?php 
						
if ($sec1!= "")
{
	
	$ali->echoSectorSecundario($sec1,false); 
	
}


if ($sec2 != "")
{
	
	$ali->echoSectorSecundario($sec2,false); 
	
}
					

						?>
						
					</tr>	
				</table>
				
					

			</div>
			
<!-- TIMELINE (ACTIVIDADES) -->
	
			<div id="timeline">
			
				<div id="portada">
				
					<img id="foto_portada" src=<?php
echo '"data/aliados/'.$ali->getID(). '/portada.png"' ?>/>
					
				</div>
				
				
				
				
				<div class="titled_separator">Actividades en curso</div>
			
				<?php $ali->echoActividades(); ?>
				
				
				<?php $ali->echoActividadesRealizadas(); ?>
				
	
				
			</div>
			
		</div>
		
		
	</body>
</html>