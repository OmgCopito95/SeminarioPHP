<?php 
include("baseDeDatos.php");

class Principal {
	
	var $bd;
    
    function __construct($conn){
    	$this -> bd = new BaseDeDatos($conn);
    }
    function getUltimosMensajes(){
    	$mensajes = $this -> bd->getMensajes();
    	//print_r($mensajes);
    	return $mensajes;
    }

    function getUser($user){
    	//echo $user;
    	$usuario = $this -> bd -> getUserByID($user);
    	//print_r($usuario);
    	return $usuario;

    }

}

?>