<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <title>The Wall - Usuario</title>
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
        <h1 class="title-pen"> Perfil del Usuario</h1>
        <div class="user-profile">
          <img class="avatar" src="style/images/hombrepie.jpg" />
          <div class="name">Persona X</div>
          <div class="username">@NombreX</div>
          <br>
          <div class="input"><a href="#">Dejar de Seguir</a></div>
        </div>
        <br>
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
                  <tr>
                    <td></td>
                    <td>Donde la justicia muestra su feo rostro yo estaré ahi!</td>
                    <td>15/10/2019 - 15:32</a></td>
                    <td>@NombreX</td>
                    <td><img src="style/images/hombrepie.jpg"/></td>
                    <td><a href=""><i class="fas fa-thumbs-up"></i> 2</a></td>
                  </tr>

                  <tr>
                    <td><img src="style/images/pie.png"/></td>
                    <td>Yo soy el Hombre Pie!</td>
                    <td>7/5/2019 - 17:42</a></td>
                    <td>@NombreX</td>
                    <td><img src="style/images/hombrepie.jpg" class="avatar" /></td>
                    <td><a href=""><i class="far fa-thumbs-up"></i> 0</a></td>
                  </tr>
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
