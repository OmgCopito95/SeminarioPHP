<?php 
include("baseDeDatos.php");

class MiPerfil {
	var $bd;
    
    function __construct($conn){
    	$this -> bd = new BaseDeDatos($conn);
    }
    function getUltimosMensajes($id,$limitStart){
    	$mensajes = $this -> bd->getMensajesByID($id,$limitStart); // ultimos 10 mensajes
    	return $mensajes;
    }

    function getSeguidos($id){
    	$mensajes = $this -> bd->getSeguidos($id); // lista de seguidos
    	return $mensajes;
    }

    function getCantidadMG($idMensaje){
        $cant = $this -> bd -> getCantidadMGxMensaje($idMensaje);
        return $cant;
    }

    function verificarMg($idMensaje,$idUsuario){
        $verificacion = $this -> bd -> diMg($idMensaje,$idUsuario);
        return $verificacion;
    }

    function loSigo($idOtroUsuario, $idMio) {
        $resultado = $this -> bd -> checkFollow($idOtroUsuario,$idMio);
        return $resultado;
    }

    function cantidadMensajesMostrar($id){
        $cant = $this -> bd -> cantidadMensajesPropios($id);
        return $cant[0];
    }
}

?>