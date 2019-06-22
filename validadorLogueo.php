<?php
session_start();
if ($_SESSION["logueado"] == false){
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
            //echo($bd->checkPassword($pass, $_POST["username"]));
            //echo $bd; 
            $user = $_POST["username"];
            if ($bd->checkPassword($pass, $user)) {
                $_SESSION["logueado"] = true;
                $_SESSION["usuario"] = $user; // guarda el nombre de usuario en la session
                $_SESSION["id"] = $existe[0]; //guardo el id del usuario en la session
                header('Location: '."principal.php");
                die();
            }
          }
      }
    }
    // por seguridad no debo decirle que es lo que esta mal
    $_SESSION["errores"] = array("Usuario o contraseña incorrectos.");
    header('Location: '."index.php");
    die();
  }
}
else {
  $_SESSION["errores"] = array("Sesion ya iniciada.");
  header('Location: '."index.php");
  die();
}
?>