<?php

require_once("PHP/global.php");


session_start();

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<!-- ViewPort no scalable/zoomable -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="recursos/css/universal.css">

<link rel="stylesheet" media="(max-width: 600px)," type="text/css"  href="recursos/css/universal_compact.css">

<link rel="stylesheet" type="text/css"  href="recursos/css/inicio_voluntario.css">

<link rel="stylesheet" media="(max-width: 600px)" type="text/css"  href="recursos/css/inicio_voluntario_compact.css">
   
<!-- Javascript librerias externas -->
<script src="recursos/javascript/snap.svg-min.js"></script>   
 
<!-- Javascript interno -->
<script src="recursos/javascript/inicio_voluntario.js"></script>

<script src="recursos/javascript/polygonalGraph.js"></script>
    
<title>UNIÓN</title>
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
	  
	echoLoggedBar(1);
	
		
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

				<div id="column_notificaciones">
					
					<div id="modulo_notificaciones">
						
						
						<div id="cuerpo_notificaciones">
							<div class="title_bar" >
								<div id="icono_interes_aviso_black" class="notif_icon" ></div>
								<div id="title">Avisos</div>
							</div>
							<div id="contenido">
								
						<div id="activity">
					
						<table id="header_activity">

							<tr> 						

								<td>
									<div id="titulo_activity">Reforestando Tlalpan</div> 
									
									<div id="subtitulo_activity">Greenpeace</div> 
								</td>
								<td width="43">
									<div id="fecha_activity" class="interface">
										<div id="month">SEP</div>
										<div id="day">5</div>
									</div>
								</td>
							</tr>

						</table>



					
					
					
					<div id="content_activity" >

						<div id="descripcion_activity">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidi lorem ipsum dolor sit amet, consectetur adipiscing elit</div>

				

						</div>
					
					
					
	

					</div>	
							
						<div class="separator"></div>
												
																						
													
							
								
							</div>

							
						</div>
						
					</div>
					
					
				</div>
				
				<div id="column_mensajes">
					
					<div id="modulo_notificaciones">
						
						
						<div id="cuerpo_notificaciones">
							<div class="title_bar" >
								<div id="icono_mensaje_black" class="notif_icon" ></div>
								<div id="title">Mensajes</div>
							</div>

                          	<div id="contenido">
								
						<div id="activity">
					
						<table id="header_activity">

							<tr> 						

								<td>
									<div id="titulo_activity" style="color:#4b7eca">Pruebas VIH</div> 
								
								</td>
								<td width="43">
									<div id="fecha_activity" class="interface">
										<div id="month">NOV</div>
										<div id="day">1</div>
									</div>
								</td>
							</tr>

						</table>
                            
					<div id="content_activity" >

						<div id="descripcion_activity" style="margin-top: 0px;">Hola, buenas tardes. Me comunico con ustedes porque me interesa obtener informes sobre las facilidades que se otorgan a personas con capacidades limitadas dentro del edificio. </div>
						</div>

					</div>	
							
						<div class="separator"></div>
                                
                    	<div id="activity">
					
						<table id="header_activity">

							<tr> 						

								<td>
									<div id="titulo_activity" style="color:#e0a635">Taller de Lectoescritura</div> 
								
								</td>
								<td width="43">
									<div id="fecha_activity" class="interface">
										<div id="month">OCT</div>
										<div id="day">18</div>
									</div>
								</td>
							</tr>

						</table>
                            
					<div id="content_activity" >

						<div id="descripcion_activity" style="margin-top: 0px;">Así es, los voluntarios podrán hacer uso de los recursos didácticos dentro de la insititución.</div>
						</div>

					</div>	
							
						<div class="separator"></div>
                                
                            <div id="activity">
					
						<table id="header_activity">

							<tr> 						

								<td>
									<div id="titulo_activity" style="color:#f04d4d">Familiares Contra el Bullying</div> 
								
								</td>
								<td width="43">
									<div id="fecha_activity" class="interface">
										<div id="month">SEP</div>
										<div id="day">29</div>
									</div>
								</td>
							</tr>

						</table>
                            
					<div id="content_activity" >

						<div id="descripcion_activity" style="margin-top: 0px;">Así es, los voluntarios podrán hacer uso de los recursos didácticos dentro de la insititución.</div>
						</div>

					</div>	
							
						<div class="separator"></div>
												
																						
													
							
								
							</div>
                            
						</div>
						
					</div>
					
				</div>
				
				<div id="modulo_calendario">
					
					<div id="calendario">
						<div id="calendario_cuerpo">
						
							<div id="calendario_titulo">Noviembre</div>
							<table id="estructura_calendario" border="0" cellpadding="0" cellspacing="2">
								  <tr>
									<th>D</th>
									<th>L</th>
									<th>M</th>
									<th>M</th>
									<th>J</th>
									<th>V</th>
									<th>S</th>
								  </tr>
								  <tr>
									<td id="unactive">26</td>
									<td id="unactive">27</td>
									<td id="unactive">28</td>
									<td id="unactive">29</td>
									<td id="unactive">30</td>
									<td>1</td>
									<td>2</td>
								  </tr>
								  <tr>
									<td style="background-color: #c3e0f7; border-radius:8px;">3</td>
									<td style="background-color: #c3e0f7; border-radius:8px;">4</td>
									<td style="background-color: #c3e0f7; border-radius:8px;">5</td>
									<td style="background-color: #c3e0f7; border-radius:8px;">6</td>
									<td style="background-color: #c3e0f7; border-radius:8px;">7</td>
									<td style="background-color: #c3e0f7; border-radius:8px;">8</td>
									<td>9</td>
								  </tr>
								  <tr>
									<td>10</td>
									<td>11</td>
									<td>12</td>
									<td>13</td>
									<td>14</td>
									<td>15</td>
									<td>16</td>
								  </tr>
								  <tr>
									<td style="background-color: #f4cf87; border-radius:8px;">17</td>
									<td style="background-color: #f4cf87; border-radius:8px;">18</td>
									<td style="background-color: #f4cf87; border-radius:8px;">19</td>
									<td style="background-color: #f4cf87; border-radius:8px;">20</td>
									<td>21</td>
									<td>22</td>
									<td>23</td>
								  </tr>
								  <tr>
									<td style="background-color: #f4cf87; border-radius:8px;">24</td>
									<td style="background-color: #f4cf87; border-radius:8px;">25</td>
									<td style="background-color: #f4cf87; border-radius:8px;">26</td>
									<td style="background-color: #f4cf87; border-radius:8px;">27</td>
									<td >28</td>
									<td>29</td>
									<td>30</td>
								  </tr>
								  <tr>
									<td id="unactive">1</td>
									<td id="unactive">2</td>
									<td id="unactive">3</td>
									<td id="unactive">4</td>
									<td id="unactive">5</td>
									<td id="unactive">6</td>
									<td id="unactive">7</td>
								  </tr>

							</table>
							
						</div>
						
					</div>
					<div id="next_events">
						
						<div id="list_events">
						
							<div id="evento_calendario" style="background-color: #62a9df;">
                                
                                <div id="icono_interes_salud_white" class="icono_evento_calendario"></div>
                                
								<div id="title_calendario">Pruebas VIH</div>
                                
                                <div id="fecha_activity_calendar" class="interface">
                                    <div id="month" style="color: #fff; font-size:14px">NOV</div>
								    <div id="day" style="color: #fff;font-size:19px">3</div>
                                
                                </div>
							</div>
                            
                            <div id="evento_calendario" style="background-color: #e0a635 ; margin-top: 10px">
                            
                                <div id="icono_interes_educacion_white" class="icono_evento_calendario"></div>
                                
								<div id="title_calendario">Taller de Lectoescritura</div>
                                
                                <div id="fecha_activity_calendar" class="interface">
                                    <div id="month" style="color: #fff; font-size:14px">NOV</div>
								    <div id="day" style="color: #fff;font-size:19px">17</div>
                                
                                </div>
							</div>
							
							
							
						</div>
						
					</div>
					
				</div>
				
			</div>
				
		
	</body>
</html>