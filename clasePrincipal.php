<?php 
include("baseDeDatos.php");

class Principal {
	
	var $bd;
    
    function __construct($conn){
    	$this -> bd = new BaseDeDatos($conn);
    }
    function getUltimosMensajes(){
    	$mensajes = $this -> bd->getMensajes(); // recibe los ultimos 10 mensajes
    	return $mensajes;
    }

    function getUser($id){
    	$usuario = $this -> bd -> getUserByID($id); // recibe usuario con id
    	return $usuario;

    }

}

?>