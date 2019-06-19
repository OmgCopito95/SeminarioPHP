

<?php

include ("BD.php");
include ("baseDeDatos.php");


class Validador {

    function __construct(){
        echo "objeto creado";
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

}

?>

<?php
$error = array(); // creo un array que me guarde los mensajes de error

if($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario
  $validador = new Validador(); // instancio objeto validador

  // verifico que el nombre cumpla
  if (!$validador->validarNombreApellido($_POST["nombre"])){ 
    $error[]="Nombre incorrecto."; // si no cumple: guardo el error en el array
  }
  
  // verifico que el apellido cumpla
  if (!$validador->validarNombreApellido($_POST["apellido"])){ 
    $error[]="Apellido incorrecto.";
  }
  
  // verifico que el email cumpla
  if (!$validador->validarEmail($_POST["email"])){ 
    $error[]="Email incorrecto.";
  }

  // verifico que el nombre de usuario cumpla
  if (!$validador->validarNombreUsuario($_POST["user"])){ 
    $error[]="Nombre de usuario incorrecto.";
  }else{
    //verifico que el usuario no exista en la bd
    $bd = new BaseDeDatos($conn);
    $existe = $bd->getUser($_POST["user"]);
    //echo $existe[0];
    if($existe[0] == '1'){ //si devuelve 1 significa que el usuario existe
      $error[]="El nombre de usuario ya esta en uso";
    }

  }

  // verifico que las contrasenias cumplan
  if (!$validador->validarContrasenias($_POST["pass1"],$_POST["pass2"])){ 
    $error[]="Contraseñas incorrectas.";
  }

  // si el array de errores esta vacio, entonces direcciono a la pagina principal
  if(sizeof($error)==0){ // si el array de los errores no tiene elementos
    //hay que crear el usuario e ir a la pagina principal

    $bd = new BaseDeDatos($conn);

    //falta guardar la imagen del usuario.

    $bd->newUser($_POST["nombre"],$_POST["apellido"],$_POST["email"],$_POST["user"],$_POST["pass1"]);

    header('Location: '."principal.php");
    die();
  }

}

?>