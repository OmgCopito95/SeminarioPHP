<?php
	session_start();
    include ("../BD.php");
    include ("../baseDeDatos.php");

    $idMio = $_SESSION["id"];
    $idOtroUsuario = $_GET["idOtroUsuario"];  

    $bd = new BaseDeDatos($conn);

    if (isset($_SERVER['HTTP_REFERER'])) {
        $bd ->unfollow($idOtroUsuario, $idMio);
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    else {
        $_SESSION["errores"] = array("Hubo un problema al dejar de seguir");
        header('Location: '."../principal.php");
    }
?>