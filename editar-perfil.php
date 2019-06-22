<?php
  session_start();
  if ($_SESSION["logueado"] == false) {
    header('Location: '."index.php");
    die();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <title>The Wall - Editar perfil</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/css/layout.css" type="text/css">
    <link rel="stylesheet" href="style/css/profile.css" type="text/css">
    <link rel="stylesheet" href="style/css/tables.css" type="text/css">
    <link rel="stylesheet" href="style/css/pagination.css" type="text/css">
    <!-- iconos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  </head>

  <body>
    <!-- seccion 1 -->
    <div class="section row1">
      <header id="header">
        <div id="hgroup">
          <img src="style/images/logo.png" />
          <h1><a href="principal.php">The Wall</a></h1> <!-- titulo -->
          <h2>Nueva red social - Conecta con tus amigos!</h2> <!-- subtitulo -->
        </div>
        <nav> <!-- menu con los links -->
          <ul>
            <li><a href="principal.php">Inicio</a></li>
            <li>
              <div class="dropdown">
                <a>Perfil</a>
                <div class="dropdown-content">
                <a href="perfil.php">Mi Perfil</a>
                <a href="editar-perfil.php">Editar Perfil</a>
                <a href="index.php">Cerrar Sesión</a>
                </div>
              </div>
            </li>
            <li>
              <form action="#" method="post"> <!-- buscar -->
                <fieldset>
                  <input type="text" value="">
                  <input type="submit" id="b_submit" value="Buscar">
                </fieldset>
              </form>
            </li>
          </ul>
        </nav>
      </header>
    </div> <!-- fin seccion 1 -->

    <!-- seccion 2 -->
    <div class="section row2">
      <div id="container" align="center">

        <br>
          <form id="regform" style="border: 0px;" action="validadorEditarPerfil.php" onsubmit="return(validarForm())">
            <h1 class="title-pen">Modificar perfil</h1></h2>

            <div class="formfield">
              <label for="nombre"><b>Nombre</b></label>
              <input type="text" id="nombre" placeholder="Ned">
            </div>

            <div class="formfield">
              <label for="apellido"><b>Apellido</b></label>
              <input type="text" id="apellido" placeholder="Flanders">
            </div>

            <div class="formfield">
              <label for="email"><b>Correo electrónico</b></label>
              <input type="text" id="email" placeholder="ned.flanders@mail.com">
            </div>

            <div class="formfield">
              <label for="password1"><b>Contraseña actual</b></label>
              <input type="password" id="passwordActual">
            </div>

            <div class="formfield">
              <label for="password1"><b>Nueva contraseña</b></label>
              <input type="password" id="password1">
            </div>

            <div class="formfield">
              <label for="password2"><b>Repita su contraseña nueva</b></label>
              <input type="password" id="password2">
            </div>

            <div class="formfield">
              <label for="pic"><b>Imagen de perfil</b></label>
              <input type="file" id="pic" accept="image/*">
            </div>

            <button  id="regbutton" type="submit">Guardar cambios</button>
          </form>
        <br>

      </div>
      <br>
    </div> <!-- fin seccion 2 -->

    <!-- seccion 3 - footer -->
    <div class="section row3">
      <footer id="footer">
        <p class="fo_left">Hecho por: Iglesias Matias - Lanciotti Julieta</p>
        <p class="fo_right">Seminario PHP 2019 </p>
      </footer>
    </div>




  </body>
</html>
