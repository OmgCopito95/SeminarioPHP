<?php
session_start();
include ("claseValidador.php");
include ("baseDeDatos.php");
include ("BD.php");

if ($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario
  $validador = new Validador(); // instancio objeto validador

  // verifico que el nombre de usuario cumpla
  if ($validador->validarNombreUsuario($_POST["username"])){
    $bd = new BaseDeDatos($conn);
    $existe = $bd->getUser($_POST["username"]);

    if ($existe[0]){
        // verifico que la contrasenia cumpla
        $pass = $_POST["password"];
        if ($validador->validarContrasenias($pass,$pass)){ // se lo pasa dos veces para reutilizar metodo
        echo($bd->checkPassword($_POST["password"], $_POST["username"]));
        //echo $bd; 
            if ($bd->checkPassword($_POST["password"], $_POST["username"])) {
                $_SESSION["logueado"] = true;
                header('Location: '."principal.php");
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