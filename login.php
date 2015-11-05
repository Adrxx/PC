<?php

$err = $_GET['e'];
session_start();
$_SESSION['voluntario'] = null;

?>



<!DOCTYPE html>
<html>
<head>

<!-- JQUERY / JQUERY MOBILE -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf16_spanish_ci"  />
 
<!-- ViewPort no scalable/zoomable -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="recursos/css/login.css">

<link rel="stylesheet" media="(max-width: 700px)," type="text/css" href="recursos/css/login_compact.css">
     
<title>UNIÓN</title>
    
</head>
	
	<body>
        
	<div id="login_bg_image"></div>
		
			<form id="login_box" name="login" action="PHP/start_session.php" method="post">
				<div id="login_logo"> </div>
                <div id="login_greet">Con&eacute;ctate y coopera. </div>
                
				<div id="login_fields" <?php
					 
					 if  ($err=="s")
					 {
						  echo ' style="border: 2px solid #f74848"';
					 }
					 
					 ?>>
				
					<input class="login_field" type="text" name="user" placeholder="Correo electr&oacute;nico">
					<div class="separator"></div>
					<input class="login_field" type="password" name="pass" placeholder="Contrase&ntilde;a">
                                       
                    <?php


if  ($err=="s")
					 {
						  echo ' <div id="error"> La contrase&ntilde;a o el usuario no es v&aacute;lido.  </div>';
					 }
					 

?>
                    
                    <button id="login_button" type="submit">Iniciar Sesi&oacute;n</button>
                    
                    <div id="register">&iquest;No est&aacute;s registrado? <a id="register_link">Hazlo ahora.</a> </div>
				</div>
                
			</form>	
		
	</body>
		
</html>