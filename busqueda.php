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
                  <tr>
                    <td><img src="style/images/homero.png"/></td>
                    <td><a href="usuario.php">@homeroS</a></td>
                    <td>Homero Simpson</td>
                    <td><a href=""> Seguir</a></td>
                  </tr>
                  <tr>
                    <td><img src="style/images/lisa.png"/></td>
                    <td><a href="usuario.php">@LisaS</a></td>
                    <td>Lisa Simpson</td>
                    <td><a href="">Seguir</a></td>
                  </tr>
                  <tr>
                    <td><img src="style/images/barto.jpg"/></td>
                    <td><a href="usuario.php">@BartS</a></td>
                    <td>El Barto</td>
                    <td><a href="">Seguir</a></td>
                  </tr>
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