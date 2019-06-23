<?php
  session_start(); //inicio la sesion 
  if (!$_SESSION["logueado"]){ //verifico si el usuario esta logueado puede ver la vista
      header('Location: '."index.php"); // si no esta logueado lo redirecciona al index
  }
  include ("claseBusqueda.php"); // muestra los datos para la vista 
  include ("BD.php");  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <title>The Wall - Resultado de la búsqueda</title>
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
            <li><div class="dropdown">
                <a>Perfil</a>
                <div class="dropdown-content">
                <a href="perfil.php">Mi Perfil</a>
                <a href="editar-perfil.php">Editar Perfil</a>
                <a href="index.php">Cerrar Sesión</a>
                </div>
                </div>
              </li>
            <li>
              <form action="validadorBusqueda.php" method="post"> <!-- buscar -->
                <fieldset>
                  <input type="text" name="buscar" value="">
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
      <div id="container">
        <br>
        <h1 class="title-pen"> Resultado de la Búsqueda</h1>
        <br>
        <br>
        <table align="center">
          <tr>
            <td>
                <table id="tablas">
                  <tr>
                    <th>Foto de perfil</th>
                    <th>Nombre de usuario</th>
                    <th>Nombre y apellido</th>
                    <th>Seguir / Dejar de seguir</th>
                  </tr>

                  <?php

                  $search = new Busqueda($conn);
                  $usuarios = $search -> getResultadosBusqueda($_SESSION["busqueda"]);
                  for ($i=0; $i < sizeof($usuarios); $i++) { 
                    echo "<tr>";
                    echo "<td><img src='mostrarImagen.php?id=".$usuarios[$i][0]."&view=1'/></td>";
                    echo "<td><a href=''> @" .$usuarios[$i][4]. "</a> </td>";
                    echo "<td>".$usuarios[$i][1]." ".$usuarios[$i][2]."</td>";
                    if ($search -> loSigo($usuarios[$i][0], $_SESSION["id"])){
                      echo "<td><a href='dejarDeSeguir.php?idOtroUsuario=".$usuarios[$i][0]."'>Dejar de seguir</a></td>";
                    }
                    else {
                      echo "<td><a href='seguir.php?idOtroUsuario=".$usuarios[$i][0]."'>Seguir</a></td>";
                    }
                    echo "</tr>";
                  }
                  ?>

                </table>
            </td>
          </tr>
        </table>
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
