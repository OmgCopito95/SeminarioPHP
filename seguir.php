<?php
	session_start();
    include ("BD.php");
    include ("baseDeDatos.php");

    $idMio = $_SESSION["id"];
    $idOtroUsuario = $_GET["idOtroUsuario"];  

    $bd = new BaseDeDatos($conn);

    $bd ->follow($idOtroUsuario, $idMio);

    header('Location: '."busqueda.php");
?>