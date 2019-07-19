<?php
  session_start(); //inicio la sesion 
  if (!$_SESSION["logueado"]){ //verifico si el usuario esta logueado puede ver la vista
      header('Location: '."index.php"); // si no esta logueado lo redirecciona al index
  }
  include ("claseRespuestas.php"); // para poder crear objetos de tipo Principal
  include ("BD.php");  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <title>The Wall</title>
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
                <a href="logout.php">Cerrar Sesión</a>
                </div>
                </div>
            </li>
            <li> <!-- busqueda -->
              <form action="controladores/validadorBusqueda.php" method="post"> <!-- buscar -->
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

    <div style="color: red; text-align:center;"> 
      <?php
        //recorro el array de errores para devolver si hay algun campo mal ingresado
        //print_r($_SESSION);
        if (!empty($_SESSION["errores"])){
          $error = $_SESSION["errores"];
          for ($i=0; $i < sizeof($error) ; $i++) { 
            echo $error[$i]."<br>";
          }
          unset($_SESSION["errores"]); //limpia los errores despues de haberlos escrito
        }    
        
      ?> 
    </div>

    <!-- seccion 2 -->
    <div class="section row2">
      <div id="container">
        <br>
        <h1 class="title-pen"> Ver Respuestas</h1>
        <br>
      <br>
      <hr style="width: 82%;">
      <br>
      <table align="center">
          <tr>
            <td>
                <table id="tablas">
                  <tr>
                    
                    <th>Respuesta</th>
                    <th>Fecha - Hora</th>
                    <th>Nombre de usuario</th>
                    <th>Foto de perfil</th>
                  </tr>

                  <?php 
                          
                  //$info = new Principal($conn); // creo objeto principal
                  $info = new Respuesta($conn);

                  $mensajes = $info -> getRespuestas($_GET['idMensaje']);
                  /*if (!empty($_GET["pag"])) { // si aprete alguna pagina
                    $mensajes = $info -> getUltimosMensajes($_SESSION["id"],$_GET['pag']);
                    //muestro los mensajes de esa pagina
                  }else{
                    //sino muestro los mensajes de la primera pagina
                    $mensajes = $info -> getUltimosMensajes($_SESSION["id"],'0');
                  }*/

                  for ($i=0; $i < sizeof($mensajes) ; $i++) { 
                    echo "<tr>";
                    echo "<td>" . $mensajes[$i][1] . "</td>"; // mensaje
                    echo "<td>" . $mensajes[$i][3] . "</td>"; // fecha y hora
                    echo "<td> <a href='otroPerfil.php?id=".$mensajes[$i][5]."'> @" . $mensajes[$i][9] . "</a> </td>";
                    echo "<td><img src='mostrarImagen.php?id=".$mensajes[$i][5]."&view=1'/></td>";
                    
                    echo "</tr>";
                  }?>
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
