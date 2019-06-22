<?php 
	// destruye todas las sesiones y redirecciona al index
	session_start();
	session_unset(); 
	session_destroy();
    header('Location: '."index.php");
?>