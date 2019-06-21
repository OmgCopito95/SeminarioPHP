<?php
include ("claseValidador.php");
include ("baseDeDatos.php");
include ("BD.php");

$error = array(); // creo un array que me guarde los mensajes de error

if ($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario
  $validador = new Validador(); // instancio objeto validador

  // verifico que el nombre de usuario cumpla
  if ($validador->validarNombreUsuario($_POST["username"])){
    $bd = new BaseDeDatos($conn);
    $existe = $bd->getUser($_POST["username"]);

    if ($existe[0]){
        // verifico que las contrasenias cumplan FALTA MEJORAR ESTO ASI NO PASO DOS VECES EL PASS
        if ($validador->validarContrasenias($_POST["password"],$_POST["password"])){ 
            if ($bd->checkPassword($_POST["password"], $_POST["username"])) {
                header('Location: '."/principal.php");
                die();
            }
        }
    }
  }
  // no informo nada xq por seguridad no debo decirle que es lo que esta mal
  header('Location: '."index.php");
  die();
}
?>