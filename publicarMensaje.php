<?php

	session_start();
	if (!empty($_SESSION["logueado"])){

		include ("baseDeDatos.php");
		include ("BD.php");
		include ("subirImagenes.php");

		if($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario
			$mensaje = $_POST["mensaje"]; // me guardo el mensaje que escribio
			if (strlen($mensaje) <= 140){ // verifico que el texto ingresado no sea mayor a 140 caracteres				
				$bd = new BaseDeDatos($conn);
				$bd->publicarMensaje($mensaje,$_SESSION["id"],$contents,$tipo_imagen); // la guardo en la base de datos

			}else{
				$_SESSION["errores"]=array("Mensaje mayor a 140 caracteres.");
			}
    		header('Location: '."perfil.php");
		} 
	}
?>