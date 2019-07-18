<?php
session_start();
if ($_SESSION["logueado"] == true){
  include ("../claseValidador.php");
  include ("../baseDeDatos.php");
  include ("../BD.php");

  $error = array(); // creo un array que me guarde los mensajes de error

  if ($_SERVER["REQUEST_METHOD"]=="POST") { // si se completo el formulario
    $validador = new Validador(); // instancio objeto validador
    $cantIngresados = 0;

    // verifico que la contraseña actual cumpla
    if (!empty($_POST["passwordActual"])) {
      $cantIngresados++;
      if (!$validador->validarContrasenias($_POST["passwordActual"],$_POST["passwordActual"])){ 
        $error[]="Contraseña invalida.";
      } else {
        $bd = new BaseDeDatos($conn);
        try{
          $bd->checkPassword($_POST["passwordActual"], $_SESSION["usuario"]);
        }
        catch (Exception $e) {
            $error[]=$e->getMessage();
        }
      }
    
      // la contraseña nueva debe estar ingresada las dos veces
      if (!empty($_POST["password1"]) && !empty($_POST["password2"])) {
        $cantIngresados++;
        if ($validador->validarNuevaContrasenia($_POST["passwordActual"], $_POST["password1"])) {
          if (!$validador->validarContrasenias($_POST["password1"],$_POST["password2"])){ 
            $error[]="Contraseñas incorrectas.";
          }
          else {
            $nuevapass["contrasenia"] = $_POST["password1"];
          }
        }
        else {
          $error[] = "La contraseña nueva igual a la anterior.";
        }
      }
      else {
        $error[] = "Debe ingresar dos veces la nueva contraseña.";
      }
    }

    if ($cantIngresados > 0) {
      $_SESSION["errores"] = $error;
      // si el array de errores esta vacio, entonces direcciono a la pagina principal
      if (sizeof($error)==0) { // si el array de los errores no tiene elementos
        //hay que crear el usuario e ir a la pagina principal
        $bd = new BaseDeDatos($conn);
        $bd->editUser($nuevapass, $_SESSION["usuario"]);

        $confirmaciones[] = "Constraseña modificada con éxito.";      
        $_SESSION["confirmaciones"] = $confirmaciones;

        header('Location: ../'."editar-perfil.php");
        die();
      }
      else {
        // for ($i=0; $i < sizeof($error); $i++) { 
        //   echo $error[0];
        // }
        header('Location: ../'."editarContrasenia.php");
        die();
      }
    }
    else {
      $_SESSION["errores"] = array("No ha ingresado ningun dato para actualizar.");
      header('Location: ../'."editarContrasenia.php");
      die();
    }
  }
  else {
    // tendria que hacer algo raro para que no sea un POST, pero por si acaso..
    $_SESSION["errores"] = array("No seas malo");
    header('Location: ../'."editarContrasenia.php");
    die();
  }
}
else {
  $_SESSION["errores"] = array("Sesion no iniciada.");
  header('Location: ../'."index.php");
  die();
}
?>