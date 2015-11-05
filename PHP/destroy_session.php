<?php


unset($_SESSION['voluntario']);

session_start();
session_unset();
session_destroy();


header("Location: http://www.ment.com.mx/pc/login.php");


?>