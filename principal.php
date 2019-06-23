<?php
  session_start(); //inicio la sesion 
  if (!$_SESSION["logueado"]){ //verifico si el usuario esta logueado puede ver la vista
      header('Location: '."index.php"); // si no esta logueado lo redirecciona al index
  }
  include ("clasePrincipal.php"); // muestra los datos para la vista 
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

    <div style="color: red;"> 
      <?php
        //recorro el array de errores para devolver si hay algun campo mal ingresado
        //print_r($_SESSION);
        if (!empty($_SESSION["errores"])){
          $error = $_SESSION["errores"];
          for ($i=0; $i < sizeof($error) ; $i++) { 
            echo "Error: " . $error[$i]."<br>";
          }
          unset($_SESSION["errores"]); //limpia los errores despues de haberlos escrito
        }    
        
      ?> 
    </div>

    <!-- seccion 2 -->
    <div class="section row2">
      <div id="container">
        <br>
        <h1 class="title-pen"> Últimas Actualizaciones</h1>
        <br>
        <div class="user-profile">
          <img class="avatar" src="mostrarImagen.php?id=<?php echo $_SESSION["id"]; ?>"/>
          <div class="name"><?php echo $_SESSION["nombre"]. " " . $_SESSION["apellido"]; ?></div>
          <div class="input">
            <form action="publicarMensaje.php" method="post" enctype="multipart/form-data">
              <textarea rows="3" cols="20" maxlength="140" placeholder="Escribe lo que piensas.." required name="mensaje"></textarea>
              <input type="file" name="pic" accept="image/*">
              <button class="button button2 " type="submit"> Publicar </button>
            </form>
          </div>

        </div>
      <br>
      <hr style="width: 82%;">
      <br>
      <table align="center">
          <tr>
            <td>
                <table id="tablas">
                  <tr>
                    <th>Imagen</th>
                    <th>Mensaje</th>
                    <th>Fecha - Hora</th>
                    <th>Nombre de usuario</th>
                    <th>Foto de perfil</th>
                  </tr>

                  <?php 
                          
                  $info = new Principal($conn);
                  $mensajes = $info -> getUltimosMensajes();
                  //print_r($mensajes);
                  for ($i=0; $i < sizeof($mensajes) ; $i++) { 
                    echo "<tr>";
                    echo "<td><img src='mostrarImagen.php?id=".$mensajes[$i][0]."'/></td>";;
                    echo "<td>" . $mensajes[$i][1] . "</td>"; // mensaje
                    echo "<td>" . $mensajes[$i][5] . "</td>"; // fecha y hora
                    $usuario = $info -> getUser($mensajes[$i][4]); // datos del usuario duenio del msj
                    echo "<td> <a href=''>" . $usuario[4] . "</a> </td>";
                    
                    echo "<td><img src='mostrarImagen.php?id=".$usuario[0]."'/></td>"; ?>

                    <!-- FALTAN LOS ME GUSTA! -->
                    <td><a href=""><i class="fas fa-thumbs-up"></i> 12</a></td>
                  </tr>
                  <?php } ?>
                </table>
            </td>
          </tr>
        </table>
        <br>
        <div style="text-align: right;">
          <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a class="active" href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&raquo;</a>
          </div>
        </div>
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
