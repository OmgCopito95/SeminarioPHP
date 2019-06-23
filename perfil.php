<?php
  session_start(); //inicio la sesion 
  if (!$_SESSION["logueado"]){ //verifico si el usuario esta logueado puede ver la vista
      header('Location: '."index.php"); // si no esta logueado lo redirecciona al index
  }
  include ("claseMiPerfil.php"); // muestra los datos para la vista 
  include ("BD.php");  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <title>The Wall - Perfil</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/css/layout.css" type="text/css">
    <link rel="stylesheet" href="style/css/profile.css" type="text/css">
    <link rel="stylesheet" href="style/css/tables.css" type="text/css">
    <link rel="stylesheet" href="style/css/pagination.css" type="text/css">
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
            <li><a href="principal.php">Inicio</a></li>
            <li><div class="dropdown">
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

    <!-- seccion 2 -->
    <div class="section row2">
      <div id="container">
        <br>
        <h1 class="title-pen"> Mi Perfil</h1>
        <br>
        <div class="user-profile">
          <img class="avatar" src="mostrarImagen.php?id=<?php echo $_SESSION["id"]; ?>&view=1" />
          <div class="name"><?php echo $_SESSION["nombre"]. " " . $_SESSION["apellido"]; ?></div>
          <div class="username">@<?php echo $_SESSION["usuario"]; ?></div>
          <div class="input">
            <form action="publicarMensaje.php" method="post" enctype="multipart/form-data">
              <textarea rows="3" cols="20" maxlength="140" placeholder="Escribe lo que piensas.." required name="mensaje"></textarea>
              <input type="file" name="pic" accept="image/*">
              <button class="button button2 " type="submit"> Publicar </button>
            </form>
          </div>
        </div>
        <br>
        <br>
        <div style="text-align: center">
          <button class="button button1" onclick="openTab('Mensajes')">Mis Mensajes</button>
          <button class="button button1" onclick="openTab('Seguidos')">Seguidos</button>
        </div>
        <br>


        <div id="Mensajes" class="tab">
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
                    <tr>

                      <?php 
                    $info = new MiPerfil($conn);
                    if (!empty($_GET["pag"])) {
                      $mensajes = $info -> getUltimosMensajes($_SESSION["id"],$_GET['pag']);
                    }else{
                      $mensajes = $info -> getUltimosMensajes($_SESSION["id"],'0');
                    }
                  for ($i=0; $i < sizeof($mensajes) ; $i++) { 
                    echo "<tr>";
                    echo "<td><img src='mostrarImagen.php?id=".$mensajes[$i][0]."&view=0'/></td>";
                    echo "<td>" . $mensajes[$i][1] . "</td>"; // mensaje
                    echo "<td>" . $mensajes[$i][5] . "</td>"; // fecha y hora
                    echo "<td> <a href=''>@" . $_SESSION["usuario"] . "</a></td>";                   
                    echo "<td><img src='mostrarImagen.php?id=".$_SESSION["id"]."&view=1'/></td>";
                    $cant = $info -> getCantidadMG($mensajes[$i][0]); //le paso id del mensaje
                    if ($info -> verificarMg($mensajes[$i][0],$_SESSION["id"])[0]) { // verifico que el usuario logueado le haya dado me gusta
                      echo "<td><a href='darMeGusta.php?idMensaje=".$mensajes[$i][0]."&mg=1'><i class='fas fa-thumbs-up'></i>" . $cant[0] . "</a></td>";
                    }else{
                      echo "<td><a href='darMeGusta.php?idMensaje=".$mensajes[$i][0]."&mg=0'><i class='far fa-thumbs-up'></i>" . $cant[0] . "</a></td>";
                    }
                    echo "<td><a href='eliminarMensaje.php?idMensaje=" .$mensajes[$i][0]."'><i class='fas fa-trash-alt'></i></a></td></tr>"; ?>
                  <?php } ?>
                  </table>
              </td>
            </tr>
          </table>
           <br>
          <div style="text-align: right;">
          <div class="pagination">
            <?php
              $cantTotal = $info ->cantidadMensajesMostrar($_SESSION["id"]);
              $cantPaginas = $cantTotal / 10;
              echo $cantTotal;
              for ($i=0; $i <$cantPaginas ; $i++) { 
                if (!empty($_GET["pag"]) and ($_GET['pag']) == $i){
                  echo "<a class='active' href='perfil.php?pag=".$i."'>".$i."</a>";
                }else{
                  if ($i == 0) {
                    echo "<a class='active' href='perfil.php'>".$i."</a>";
                  }else{
                    echo "<a href='perfil.php?pag=".$i."'>".$i."</a>";                 
                  }
                   
                }                
              }
            ?>
          </div>
        </div>
        </div>


        <div id="Seguidos" class="tab" style="display:none">
          <table align="center">
            <tr>
              <td>
                <table id="tablas">
                  <tr>
                    <th>Nombre Usuario</th>
                    <th>Seguido</th>
                  </tr>
                  <?php
                  $seguidos = $info -> getSeguidos($_SESSION["id"]);
                    for ($i=0; $i < sizeof($seguidos); $i++) { 
                      echo "<tr>";
                      echo "<td>" . $seguidos[$i][4] . "</td>";
                      if ($info -> loSigo($seguidos[$i][0], $_SESSION["id"])){
                        echo "<td><a href='dejarDeSeguir.php?idOtroUsuario=".$seguidos[$i][0]."'>Dejar de seguir</a></td>";
                      }
                      else {
                        echo "<td><a href='seguir.php?idOtroUsuario=".$seguidos[$i][0]."'>Seguir</a></td>";
                      }
                      echo "</tr>";
                    }
                  ?>
                </table>
              </td>
            </tr>
          </table>
        </div>
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
