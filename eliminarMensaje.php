<?php
    include ("BD.php");
    include ("baseDeDatos.php");

    $idUsuario = $_GET['idUsuario'];
    $idMensaje = $_GET['idMensaje'];  

    $bd = new BaseDeDatos($conn);
    $result = $bd ->eliminarMensaje($idUsuario,$idMensaje);

    header('Location: '."perfil.php");
?>