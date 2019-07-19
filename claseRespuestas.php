<?php 
include("baseDeDatos.php");

class Respuesta {
    
    var $bd;
    
    function __construct($conn){
        $this -> bd = new BaseDeDatos($conn);
    }

    function getRespuestas($id_msj){
    	$mensajes = $this -> bd->getRespuestas($id_msj); // ult 10 msj seguidos
        return $mensajes;
    }
}

?>