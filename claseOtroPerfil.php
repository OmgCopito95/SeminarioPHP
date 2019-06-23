<?php 
include("baseDeDatos.php");

class otroPerfil {
	var $bd;
    
    function __construct($conn){
    	$this -> bd = new BaseDeDatos($conn);
    }
    function getUltimosMensajes($id,$limitStart){
    	$mensajes = $this -> bd->getMensajesByID($id,$limitStart); // ultimos 10 mensajes
    	return $mensajes;
    }

    function getNombreAp($id){
        $usuario = $this -> bd->getUserByID($id); // lista de seguidos}
    	return $usuario[2]." ".$usuario[1];
    }

    function getNombreUsuario($id){
        $usuario = $this -> bd->getUserByID($id); // lista de seguidos
    	return $usuario[4];
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