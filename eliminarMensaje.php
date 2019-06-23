<?php
	session_start();
    include ("BD.php");
    include ("baseDeDatos.php");

    $idUsuario = $_SESSION["id"];
    $idMensaje = $_GET['idMensaje'];  

    $bd = new BaseDeDatos($conn);
    $result = $bd ->eliminarMensaje($idUsuario,$idMensaje);

    header('Location: '."perfil.php");
?>