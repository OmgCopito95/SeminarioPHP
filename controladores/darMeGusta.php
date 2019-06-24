<?php
	session_start();
    include ("../BD.php");
    include ("../baseDeDatos.php");

    $idUsuario = $_SESSION["id"];
    $idMensaje = $_GET['idMensaje'];  
    $mg = $_GET['mg'];  

    $bd = new BaseDeDatos($conn);

    if ($mg==0) {
    	$bd -> darMeGusta($idUsuario,$idMensaje);
    }else{
		$bd -> eliminarMeGusta($idUsuario,$idMensaje);
    }    

    header('Location: '."../principal.php");
?>