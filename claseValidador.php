<?php

class Validador {

    function __construct(){
    }

    function validarNombreApellido($nombre){
        if(($nombre != "") && (preg_match("/^[A-Z]+$/i", $nombre))){
            return true;
        }else{
            return false;
        }
    }

    function validarEmail($email){
        if(preg_match("/\S+@\S+\.\S+/", $email)){
            return true;
        }else{
            return false;
        }
    }

    function validarNombreUsuario($user){
        if(preg_match("/^[A-Za-z0-9]{6,12}$/", $user)){
            return true;
        }else{
            return false;
        }
    }

    function validarContrasenias($pass1, $pass2){
        if($pass1 != $pass2){ //verifico si son distintas
            return false;
        }else{
            if(preg_match("/(?=^.{6,12}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $pass1)){ //si son iguales y una cumple
                return true;
            }else{
                return false;
            }
        }
    }

    function validarBusqueda($buscar){
        if (preg_match("/[A-Za-z0-9]/", $buscar)){
            return true;
        }
        else {
            return false;
        }
    }

    function validarNuevaContrasenia($actual, $anterior){
        if ($actual != $anterior) {
            return true;
        }
        else {
            return false;
        }
    }

}

?>