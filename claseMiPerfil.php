<?php 
include("baseDeDatos.php");

class MiPerfil {
	var $bd;
    
    function __construct($conn){
    	$this -> bd = new BaseDeDatos($conn);
    }
    function getUltimosMensajes($id){
    	$mensajes = $this -> bd->getMensajesByID($id); // recibe los ultimos 10 mensajes
    	//print_r($mensajes);
    	return $mensajes;
    }

}

?>