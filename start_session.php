<?php

require_once("voluntario.php");

$user = $_POST['user'];
$pass = $_POST['pass'];

$login = makeSession($user, $pass);

session_start();

$_SESSION['voluntario'] = $login;

if (!is_null($_SESSION['voluntario']))
{
		
	header("Location: http://www.ment.com.mx/pc/perfil_voluntario.php?id=".$_SESSION['voluntario']);
	
}
else {
	header("Location: http://www.ment.com.mx/pc/login.php?e=s");
}


?>