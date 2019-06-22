<?php
session_start();
if ($_SESSION["logueado"] == true){
  include ("claseValidador.php");
  include ("baseDeDatos.php");
  include ("BD.php");

  if ($_SERVER["REQUEST_METHOD"]=="POST"){ // si se completo el formulario
    $validador = new Validador(); // instancio objeto validador
 
    // verifico que la busqueda cumpla
    if ($validador->validarBusqueda($_POST["buscar"])){
        $bd = new BaseDeDatos($conn);
        $resultado = $bd->search($_POST["buscar"]);
        if ($resultado != NULL){
            $_SESSION["busqueda"] = $_POST["buscar"];
            $_SESSION["resultado"] = $resultado;
            header('Location: '."busqueda.php");
            die();
        }
        else {
            echo "resultado == NULL busca otra cosa man";
            header('Location: '."busquedaVacia.php");
            die();
        }
    }
    else {
        // por si pone cosas raras
        $_SESSION["errores"] = "Busqueda no permitida.";
        if (isset($_SERVER['HTTP_REFERER'])) {
            // $previous = $_SERVER['HTTP_REFERER'];
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
  $_SESSION["errores"] = "Para realizar una busqueda debe iniciar sesion";
  header('Location: '."index.php");
  die();
}
?>