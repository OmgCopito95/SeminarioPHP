<?php
session_start();
// echo sizeof($_POST);
// echo $_POST[1];
if ($_SESSION["logueado"] == true){
  include ("claseValidador.php");
  include ("baseDeDatos.php");
  include ("BD.php");
  // include ("subirImagenes.php");

  $error = array(); // creo un array que me guarde los mensajes de error
  $nuevosdatos = array(); // guardo el/los dato/s a editar para enviar array como parametro

  if ($_SERVER["REQUEST_METHOD"]=="POST") { // si se completo el formulario
    $validador = new Validador(); // instancio objeto validador

    // verifico que el nombre cumpla
    if (!empty($_POST["nombre"])) {
      if (!$validador->validarNombreApellido($_POST["nombre"])){ 
        $error[]="Nombre incorrecto."; // si no cumple: guardo el error en el array
      }
      else {
        $nuevosdatos["nombre"] = $_POST["nombre"];
      }
    } 
    // verifico que el apellido cumpla
    if (!empty($_POST["apellido"])) {
      if (!$validador->validarNombreApellido($_POST["apellido"])){ 
        $error[]="Apellido incorrecto.";
      }
      else {
        $nuevosdatos["apellido"] = $_POST["apellido"];
      }
    }

    // verifico que el email cumpla
    if (!empty($_POST["email"])) {
      if (!$validador->validarEmail($_POST["email"])){ 
        $error[]="Email incorrecto.";
      }
      else {
        $nuevosdatos["email"] = $_POST["email"];
      }
    }

    // verifico que la contraseña actual cumpla
    if (!empty($_POST["passwordActual"])) {
      if (!$validador->validarContrasenias($_POST["passwordActual"],$_POST["passwordActual"])){ 
        $error[]="Contraseña invalida.";
      } else {
        $bd = new BaseDeDatos($conn);
        if (!$bd->checkPassword($_POST["passwordActual"], $_SESSION["usuario"])) {
          $error[]="Contraseña incorrecta.";
        }
      }
    
      // la contraseña nueva debe estar ingresada las dos veces
      if (!empty($_POST["password1"]) && !empty($_POST["password2"])) {
        if (!$validador->validarContrasenias($_POST["password1"],$_POST["password2"])){ 
          $error[]="Contraseñas incorrectas.";
        }
        else {
          $nuevosdatos["password"] = $_POST["password1"];
        }
      }
      else {
        $error[] = "Debe ingresar dos veces la nueva contraseña.";
      }
    }

    if (sizeof($nuevosdatos) > 0) {
      $_SESSION["errores"] = $error;
      // si el array de errores esta vacio, entonces direcciono a la pagina principal
      if (sizeof($error)==0) { // si el array de los errores no tiene elementos
        //hay que crear el usuario e ir a la pagina principal
        $bd = new BaseDeDatos($conn);
        //falta guardar la imagen del usuario.
  
        $bd->editUser($nuevosdatos, $_SESSION["usuario"]);
  
        header('Location: '."/principal.php");
        die();
      }
      else {
        // for ($i=0; $i < sizeof($error); $i++) { 
        //   echo $error[0];
        // }
        header('Location: '."/editar-perfil.php");
        die();
      }
    }
    else {
      $_SESSION["errores"] = "No ha ingresado ningun dato para actualizar.";
      header('Location: '."/editar-perfil.php");
      die();
    }
  }
  else {
    // tendria que hacer algo raro para que no sea un POST, pero por si acaso..
    $_SESSION["errores"] = "No seas malo";
    header('Location: '."/editar-perfil.php");
    die();
  }
}
else {
  $_SESSION["errores"] = "Sesion no iniciada.";
  header('Location: '."/index.php");
  die();
}
?>