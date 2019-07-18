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
        <h1 class="title-pen"> Últimas Actualizaciones</h1>
        <br>
        <div class="user-profile">
          <img class="avatar" src="mostrarImagen.php?id=<?php echo $_SESSION["id"]; ?>&view=1"/>
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
                    <th></th>
                  </tr>

                  <?php 
                          
                  $info = new Principal($conn);
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
                    $usuario = $info -> getUser($mensajes[$i][4]); // datos del usuario duenio del msj
                    echo "<td> <a href='otroPerfil.php?id=".$usuario[0]."'> @" . $usuario[4] . "</a> </td>";
                    echo "<td><img src='mostrarImagen.php?id=".$usuario[0]."&view=1'/></td>";
                    $cant = $info -> getCantidadMG($mensajes[$i][0]); //le paso id del mensaje
                    if ($info -> verificarMg($mensajes[$i][0],$_SESSION["id"])[0]) { // verifico que el usuario logueado le haya dado me gusta
                      echo "<td><a href='controladores/darMeGusta.php?idMensaje=".$mensajes[$i][0]."&mg=1'><i class='fas fa-thumbs-up'></i>" . $cant[0] . "</a></td>";
                    }else{
                      echo "<td><a href='controladores/darMeGusta.php?idMensaje=".$mensajes[$i][0]."&mg=0'><i class='far fa-thumbs-up'></i>" . $cant[0] . "</a></td>";
                    }
                    
                    echo "</tr>";
                  }?>
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
              for ($i=1; $i <$cantPaginas ; $i++) { 
                if (!empty($_GET["pag"]) and ($_GET['pag']) == $i){
                  echo "<a class='active' href='principal.php?pag=".$i."'>".$i."</a>";
                }else{
                  if ($i == 1) {
                    echo "<a class='active' href='principal.php'>".$i."</a>";
                  }else{
                    echo "<a href='principal.php?pag=".$i."'>".$i."</a>";                 
                  }
                   
                }                
              }
            ?>
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
