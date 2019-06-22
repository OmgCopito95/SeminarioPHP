<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <title>The Wall</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/css/layout.css" type="text/css">
    <link rel="stylesheet" href="style/css/profile.css" type="text/css">
    <link rel="stylesheet" href="style/css/tables.css" type="text/css">
    <!-- iconos -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="style/js/codigoJS.js"></script>
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
            <li>
              <form action="validadorLogueo.php" method="POST"> <!-- iniciar sesion  -->
                <fieldset>
                  <input type="text" name="username" placeholder="Nombre de usuario" required>
                  <input type="password" name="password" placeholder="Contraseña" required>
                  <input type="submit" id="b_submit" value="Iniciar sesión">
                </fieldset>
              </form>
            </li>
          </ul>
        </nav>
      </header>
    </div> <!-- fin seccion 1 -->

    <!-- seccion 2 -->

    <!-- ERRORES -->
    <div style="color: red;"> 
      <?php
        //recorro el array de errores para devolver si hay algun campo mal ingresado
        if (!empty($_SESSION["errores"])){
          $error = $_SESSION["errores"];
          for ($i=0; $i < sizeof($error) ; $i++) { 
            echo "Error: " . $error[$i]."<br>";
          }
        }    
         
      ?> 
    </div>


    <div class="section row2">
      <div id="container" align="center">
        <br>
          <form id="regform" method="POST" action="validadorRegistro.php" onsubmit="<!--return(validarForm())-->" enctype="multipart/form-data"<!-- para subir imagen -->> 
            <h2>¿Aún no tienes una cuenta? ¡Regístrate!</h2>

            <!-- required's comentados para prueba -->
            <div class="formfield">
              <label for="nombre"><b>Nombre</b></label>
              <input type="text" id="nombre" name="nombre">
            </div>

            <div class="formfield">
              <label for="apellido"><b>Apellido</b></label>
              <input type="text" id="apellido" name="apellido">
            </div>

            <div class="formfield">
              <label for="email"><b>Correo electrónico</b></label>
              <input type="text" id="email" name="email">
            </div>

            <div class="formfield">
              <label for="username"><b>Nombre de usuario</b></label>
              <input type="text" id="username" name="user">
            </div>

            <div class="formfield">
              <label for="password1"><b>Contraseña</b></label>
              <input type="password" id="password1" name="pass1">
            </div>

            <div class="formfield">
              <label for="password2"><b>Repita su contraseña</b></label>
              <input type="password" id="password2" name="pass2">
            </div>

            <div class="formfield">
              <label for="pic"><b>Imagen de perfil</b></label>
              <input type="file" id="pic" name="pic" accept="image/*">
            </div>

            <button id="regbutton" type="submit">Registrarme</button>
          </form>
        <br>

      </div>
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
