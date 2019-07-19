<?php

	session_start();
	if (!empty($_SESSION["logueado"])){

		include ("baseDeDatos.php");
		include ("BD.php");

		if($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario
			$mensaje = $_POST["mensaje"]; // me guardo el mensaje que escribio
			$idMensaje = $_GET['idMensaje'];   //me quedo con el id del msj que viene por get
			
			$bd = new BaseDeDatos($conn);
			#$bd->publicarMensaje($mensaje,$_SESSION["id"],$contents,$tipo_imagen); // la guardo en la base de datos
			$bd->publicarRespuesta($mensaje,$_SESSION["id"],$idMensaje);

    		header('Location: '."principal.php");
		} 
	}
?>