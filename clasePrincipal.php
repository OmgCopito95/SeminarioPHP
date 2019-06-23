<?php 
include("baseDeDatos.php");

class Principal {
    
    var $bd;
    
    function __construct($conn){
        $this -> bd = new BaseDeDatos($conn);
    }
    function getUltimosMensajes($id,$limit){ //recibe el id del usuario logueado
        $mensajes = $this -> bd->getMensajesSeguidos($id,$limit); // ult 10 msj seguidos
        return $mensajes;
    }

    function getUser($id){
        $usuario = $this -> bd -> getUserByID($id); // recibe usuario con id
        return $usuario;
    }

    function getCantidadMG($idMensaje){
        $cant = $this -> bd -> getCantidadMGxMensaje($idMensaje);
        return $cant;
    }

    function verificarMg($idMensaje,$idUsuario){
        $verificacion = $this -> bd -> diMg($idMensaje,$idUsuario);
        return $verificacion;
    }

    function cantidadMensajesMostrar($id){
        $cant = $this -> bd -> cantidadMensajesSeguidos($id);
        return $cant[0];
    }

}

?>