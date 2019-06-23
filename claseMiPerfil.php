<?php 
include("baseDeDatos.php");

class MiPerfil {
	var $bd;
    
    function __construct($conn){
    	$this -> bd = new BaseDeDatos($conn);
    }
    function getUltimosMensajes($id){
    	$mensajes = $this -> bd->getMensajesByID($id); // ultimos 10 mensajes
    	return $mensajes;
    }

    function getSeguidos($id){
    	$mensajes = $this -> bd->getSeguidos($id); // lista de seguidos
    	return $mensajes;
    }

}

?>