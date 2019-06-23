<?php
session_start();
if ($_SESSION["logueado"] == true){
  include ("claseValidador.php");

  if ($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario
    $validador = new Validador(); // instancio objeto validador
 
    // verifico que solo busque con caracteres alfanumericos
    if ($validador->validarBusqueda($_POST["buscar"])){
      $_SESSION["busqueda"] = $_POST["buscar"];
      header('Location: '."busqueda.php");
      die();
    }
    else {
      $_SESSION["errores"] = array("Busqueda no permitida.");
      $_SESSION["busqueda"] = " ";
      if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }
      else {
        header('Location: '."principal.php");
      }
      die();
    }
  }
}
else {
  $_SESSION["errores"] = array("Para realizar una busqueda debe iniciar sesion");
  header('Location: '."index.php");
  die();
}
?>