<?php 
include("baseDeDatos.php");

class Busqueda {
	
	var $bd;
    
    function __construct($conn){
    	$this -> bd = new BaseDeDatos($conn);
    }

    function getResultadosBusqueda($buscar){
    	$resultado = $this -> bd->search($buscar);
    	return $resultado;
    }

    function loSigo($idOtroUsuario, $idMio) {
        $resultado = $this -> bd -> checkFollow($idOtroUsuario,$idMio);
        return $resultado;
    }

}

?>