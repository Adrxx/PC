<?php 

	require_once('PHP/global.php'); 
	require_once('PHP/voluntario.php'); 

	$vol = new Voluntario($_GET['id']);
		
	session_start();

	if (!is_null($_SESSION['voluntario']))
	{
		$vol = new Voluntario($_SESSION['voluntario']);
	} else {
		header ("location: http://www.ment.com.mx/pc/login.php");
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

<link rel="stylesheet" type="text/css"  href="recursos/css/perfil_voluntario.css">

<link rel="stylesheet" media="(max-width: 600px)," type="text/css"  href="recursos/css/perfil_voluntario_compact.css">
   
<!-- Javascript librerias externas -->
<script src="recursos/javascript/snap.svg-min.js"></script>   
 
<!-- Javascript interno -->
<script src="recursos/javascript/perfil_voluntario.js"></script>

<script src="recursos/javascript/polygonalGraph.js"></script>
<script src="recursos/javascript/smartPhotosPane.js"></script>
    
<title><?php echo 'UNI&Oacute;N - '. $vol->getNombre(); ?></title>
</head>
	
	<body>
		
		
			
<!-- MENUS -->
		<div id="menu_bar">
		
			
			
				<table id="menu_bar_container" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td id="logo_container"><div id="logo"></div></td>
							<td>	
							
							<?php 

if(!is_null($_SESSION['voluntario']))
{
	  
	echoLoggedBar(3);
	
		
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
				
					
					<div class="foto_perfil_container">
						<img id="foto_perfil" src=<?php
echo '"data/voluntarios/'.$vol->getID(). '/perfil.png"' ?>/>
								
								
												
						<?php 
									
									
								$puntaje = $vol->getCalificacion();
								
								if ($puntaje >= 800)
								{
echo '<div id="badge_diamante" class="badge"></div>';
								}	
elseif ($puntaje < 800 && $puntaje >= 400)
{
	echo '<div id="badge_oro" class="badge"></div>';

}
elseif ($puntaje < 400 && $puntaje >= 200 )
{
	echo '<div id="badge_plata" class="badge"></div>';

}

								
									
						?>

									

						
					</div>
										
					<div id="nombre_perfil"><?php echo $vol->getNombre() ." ". $vol->getApellidoPaterno() . " ". $vol->getApellidoMaterno(); ?></div>
					<div id="direccion_perfil"><?php echo $vol->getUbicacion(); ?></div>
					
					<div id="info_extra_perfil">
						
						
						<div id="edad_perfil">G&eacute;nero: <span id="light"> <?php echo $vol->getGenero(); ?> </span> </div>
						<div id="edad_perfil">Fecha de nacimiento: <span id="light"> <?php echo $vol->getFechaNacimiento(); ?></span> </div>
						<div id="edad_perfil">Ocupaci&oacute;n: <span id="light"><?php echo $vol->getOcupacion(); ?></span> </div>
						
						<div id="edad_perfil">Habilidades t&eacute;cnicas: <span id="light"> <?php echo $vol->getHabilidadesTecnicas(); ?></span> </div>
						
						
						<table id="botones_perfil" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<a href="PHP/destroy_session.php" class="boton">Salir</a>
								</td>
								<td>
									<div class="boton">Ajustes</div>
								</td>
							</tr>
						</table>
						
					
						
					</div>
					<div id="mas_info" onclick="expandirPerfil()" class="interface">...</div>
				

				</div>
				
				<div id="perfil_mobile">
				
					<table id="profile_mobile_table">
						<tr>
							<td id="controlled_td" width="110">
								<div class="foto_perfil_container_mobile">
									<img id="foto_perfil" src=<?php
echo '"data/voluntarios/'.$vol->getID(). '/perfil.png"' ?>/>
									
								</div>
								
								
								
								
							
							</td>
							<td>
								<div id="nombre_perfil"><?php echo $vol->getNombre() ." ". $vol->getApellidoPaterno() . " ". $vol->getApellidoMaterno(); ?></div>
					
							<div id="direccion_perfil"><?php echo $vol->getUbicacion(); ?></div>
							<div id="mas_info" onclick="expandirPerfilMobile()" class="interface">...</div>
								
							</td>
						</tr>
					</table>
					
					<div id="info_extra_perfil_mobile">
						
						<div id="edad_perfil">G&eacute;nero: <span id="light"> <?php echo $vol->getGenero(); ?> </span> </div>
						<div id="edad_perfil">Fecha de nacimiento: <span id="light"> <?php echo $vol->getFechaNacimiento(); ?></span> </div>
						<div id="edad_perfil">Ocupaci&oacute;n: <span id="light"><?php echo $vol->getOcupacion(); ?></span> </div>
						
						<div id="edad_perfil">Habilidades t&eacute;cnicas: <span id="light"> <?php echo $vol->getHabilidadesTecnicas(); ?></span> </div>
						
						
						
						<table id="botones_perfil" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<a href="PHP/destroy_session.php" class="boton">Salir</a>
								</td>
								<td>
									<div class="boton">Ajustes</div>
								</td>
							</tr>
						</table>


						
					</div>
					
				</div>
				
				
				<script>
			
					<?php echo 'setProfileColor("#007940")' ?>

				</script>
				
				<table class="titled_separator2">
					<tr>
						<td ><div id="separator_habilidades" class="separator"></div></td>
						<td><div id="texto_separador">Habilidades</div></td>
						<td><div id="separator_habilidades" class="separator"></div></td>
					</tr>
				</table>
				
				<div id="mobile_habilidades_separator" class="titled_separator">Habilidades</div>
				
				<div id="habilidades">
				
					<div id="polygraph_container">
					
				

						
				
					<svg id="polygraph_surface"></svg>
								
								<script>
									
									initPolygonalGraph(<?php $vol->echoCompetencias(); ?>);
	
								</script>
								
					</div>

					
				</div>
			

			</div>
			
<!-- TIMELINE (ACTIVIDADES) -->
	
			<div id="timeline">
									

          <div class="titled_separator">Asociaciones</div>
          <div id="activity"><table id="header_activity"><tbody><tr>
        
        <td width="60">
        <div id="icono_interes_paramedico_color" class="categoria_activity"></div>
        </td>
        <td><div id="titulo_activity" style="font-size:20px">Rediseando el Parque Independencia</div> <a href="perfil_aliado.php?id=2" id="subtitulo_activity">Cruz Roja Mexicana</a></td><td width="72">
        </td></tr>

        </tbody></table>

        </div>

                  <div id="activity"><table id="header_activity"><tbody><tr>
        
        <td width="60">
        <div id="icono_interes_paramedico_color" class="categoria_activity"></div>
        </td>
        <td><div id="titulo_activity" style="font-size:20px">Rediseando el Parque Independencia</div> <a href="perfil_aliado.php?id=2" id="subtitulo_activity">Cruz Roja Mexicana</a></td><td width="72">
        </td></tr>

        </tbody></table>

        </div>

                  <div id="activity"><table id="header_activity"><tbody><tr>
        
        <td width="60">
        <div id="icono_interes_paramedico_color" class="categoria_activity"></div>
        </td>
        <td><div id="titulo_activity" style="font-size:20px">Rediseando el Parque Independencia</div> <a href="perfil_aliado.php?id=2" id="subtitulo_activity">Cruz Roja Mexicana</a></td><td width="72">
        </td></tr>

        </tbody></table>

        </div>


          <div class="titled_separator">Certificaciones</div>

                    <div id="activity"><table id="header_activity"><tbody><tr>
        
        <td><div id="titulo_activity" style="font-size:20px">Rediseando el Parque Independencia</div> <a href="perfil_aliado.php?id=2" id="subtitulo_activity">Cruz Roja Mexicana</a></td><td width="72">
        </td></tr>

        </tbody></table>


        </div>

          <div class="titled_separator">Insignias</div>

                     <div id="activity"><table id="header_activity"><tbody><tr>
        
        <td width="60">
        <div id="icono_interes_paramedico_color" class="categoria_activity"></div>
        </td>
        <td><div id="titulo_activity" style="font-size:20px">Rediseando el Parque Independencia</div> <a href="perfil_aliado.php?id=2" id="subtitulo_activity">Cruz Roja Mexicana</a></td><td width="72">
        </td></tr>

        </tbody></table>

        </div>

                  <div id="activity"><table id="header_activity"><tbody><tr>
        
        <td width="60">
        <div id="icono_interes_paramedico_color" class="categoria_activity"></div>
        </td>
        <td><div id="titulo_activity" style="font-size:20px">Rediseando el Parque Independencia</div> <a href="perfil_aliado.php?id=2" id="subtitulo_activity">Cruz Roja Mexicana</a></td><td width="72">
        </td></tr>

        </tbody></table>

        </div>

                  <div id="activity"><table id="header_activity"><tbody><tr>
        
        <td width="60">
        <div id="icono_interes_paramedico_color" class="categoria_activity"></div>
        </td>
        <td><div id="titulo_activity" style="font-size:20px">Rediseando el Parque Independencia</div> <a href="perfil_aliado.php?id=2" id="subtitulo_activity">Cruz Roja Mexicana</a></td><td width="72">
        </td></tr>

        </tbody></table>

        </div>

					
				<?php 
	
		$vol->echoActividadesActivas();


		$vol->echoActividadesInactivas();


				?>	
						
				
				</div>
			
		</div>
		
		
	</body>
</html>