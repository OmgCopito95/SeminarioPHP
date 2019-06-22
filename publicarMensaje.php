<?php
	
	session_start();

	if ($_SESSION["logueado"] == true){

		include ("baseDeDatos.php");
		include ("BD.php");

		if($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario

			$mensaje = $_POST["mensaje"]; // me guardo el mensaje que escribio
			if (strlen($mensaje) <= 140){ // verifico que el texto ingresado no sea mayor a 140 caracteres
				//falta la imagen
				$bd = new BaseDeDatos($conn);
				$bd->publicarMensaje($mensaje,$_SESSION["id"],'',''); // la guardo en la base de datos
			}else{
				$_SESSION["errores"]=array("Mensaje mayor a 140 caracteres.");
			}

    		header('Location: '."principal.php");

		} 
	}
?>