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
        <h1 class="title-pen"> Mi Perfil</h1>
        <br>
        <div class="user-profile">
          <img class="avatar" src="style/images/persona3.jpg" />
          <div class="name">Ned Flanders</div>
          <div class="username">@Flanders</div>
          <div class="input">
            <form action="" method="post">
              <textarea rows="3" cols="20" maxlength="140" placeholder="Escribe lo que piensas.." required></textarea>
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
                      <td></td>
                      <td>Homero, devuelveme lo que me debes!</td>
                      <td>15/10/2019 - 15:32</a></td>
                      <td><a href="usuario.php">@Flanders</a></td>
                      <td><img src="style/images/persona3.jpg"/></td>
                      <td><a href=""><i class="fas fa-thumbs-up"></i> 1</a></td>
                      <td><a href=""><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <tr>
                      <td><img src="style/images/lobo.png"/></td>
                      <td>Hoy tuve un mal dia.</td>
                      <td>15/10/2019 - 15:32</a></td>
                      <td><a href="usuario.php">@Flanders</a></td>
                      <td><img src="style/images/persona3.jpg"/></td>
                      <td><a href=""><i class="far fa-thumbs-up"></i> 0</a></td>
                      <td><a href=""><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <tr>
                      <td><img src="style/images/ski.jpg"/></td>
                      <td>Es como si no llevara nada puesto!</td>
                      <td>15/10/2019 - 15:32</a></td>
                      <td><a href="usuario.php">@Flanders</a></td>
                      <td><img src="style/images/persona3.jpg"/></td>
                      <td><a href=""><i class="fas fa-thumbs-up"></i> 14</a></td>
                      <td><a href=""><i class="fas fa-trash-alt"></i></a></td>
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
        </div>


        <div id="Seguidos" class="tab" style="display:none">
          <table align="center">
            <tr>
              <td>
                <table id="tablas">
                  <tr>
                    <th>Usuario</th>
                    <th>Seguido</th>
                  </tr>
                  <tr>
                    <td>hombreAbeja</td>
                    <td><a href="">Dejar de Seguir</a></td>
                  </tr>
                  <tr>
                    <td>Skinner</td>
                    <td><a href="">Dejar de Seguir</a></td>
                  </tr>
                  <tr>
                    <td>rafaaa</td>
                    <td><a href="">Dejar de Seguir</a></td>
                  </tr>
                  <tr>
                    <td>smithers</td>
                    <td><a href="">Dejar de Seguir</a></td>
                  </tr>
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