<?php
    require_once "php/CAD.php";

    session_start();
    $idRol = 0;
    $idUsuario = 0;
    if (isset($_SESSION['idRol'])) {
        $idRol = $_SESSION['idRol'];
        $idUsuario = $_SESSION['idUsuario'];
    }

    $cad = new CAD();
    $imagenU = "";
    $query = $cad->traeImagenUsuario($idUsuario);
    if ($query !== null && isset($query['imagenUsuario'])) {
        $imagenU = $query['imagenUsuario'];
        $imagenU = substr($imagenU, 3);
    } 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="estilo.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <title>Bel´s Recipes</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/icono.png">
    </head>
    <body>
        <div class = "encabezado">
           <div class = "logo">
                <img src="img/logo.png" style="height: 70px;">
           </div>
        <?php
            if($idRol == 1)
            {
                echo '<div class="login">
                    <img src="'.$imagenU.'" class="user-pic" onclick="toggleMenu()">
                </div>

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">

                        <a href="guardados.php" class="sub-menu-link">
                            <img src="img/corazon.png">
                            <p>Elementos guardados</p>
                            <span>></span>
                        </a>
                        <a href="iniciarSesion/editarPerfil.php" class="sub-menu-link">
                            <img src="img/setting.png">
                            <p>Editar perfil</p>
                            <span>></span>
                        </a>
                        <a href="php/cerrarsesion.php" class="sub-menu-link">
                            <img src="img/logout.png">
                            <p>Cerrar sesión</p>
                            <span>></span>
                        </a>

                    </div>
                </div>';
            }
            else if($idRol == 2)
            {
                echo ' <div class="login">
                <img src="'.$imagenU.'" class="user-pic" onclick="toggleMenu()">
            </div>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">

                    <a href="guardados.php" class="sub-menu-link">
                        <img src="img/corazon.png">
                        <p>Elementos guardados</p>
                        <span>></span>
                    </a>
                    <a href="iniciarSesion/editarPerfil.php" class="sub-menu-link">
                        <img src="img/profile.png">
                        <p>Editar perfil</p>
                        <span>></span>
                    </a>
                    <a href="admin/menuConfig.php" class="sub-menu-link">
                        <img src="img/setting.png">
                        <p>Configuración de Página</p>
                        <span>></span>
                    </a>
                    <a href="php/cerrarsesion.php" class="sub-menu-link">
                        <img src="img/logout.png">
                        <p>Cerrar sesión</p>
                        <span>></span>
                    </a>

                </div>
            </div>';
            }
            else
            {
                echo '<div class = "login">
                <div class = "inicioSesion"><a href="php/login.php">Iniciar sesión</a></div>
                <div class = "registro"><a href="php/registro.php">Registrar</a></div>
                </div>';
            }

        ?>
           
        </div>
        
        <div class="encImg">
            <img src="img/banner.png" style="width: 100%;">
        </div>
        
        <div class="menu">
            <a href = "index.php">Inicio  <span>></span></a>
            <a href = "categoria.php?idCategoria=1">Desayunos  <span>></span></a>
            <a href = "categoria.php?idCategoria=2">Platillos  <span>></span></a>
            <a href = "categoria.php?idCategoria=3">Postres  <span>></span></a>
            <a href = "categoria.php?idCategoria=4">Bebidas  <span>></span></a>
            <a href = "categoria.php?idCategoria=5">Tips  <span>></span></a>
        </div>
        <form action="busqueda.php" method="POST">
        <div class="containerSearch">
            <input type="text" placeholder="Buscar" name = "busqueda">
            <input type="submit" value="Buscar" style="background: rgb(246, 0, 127); color: white">
        </div>
            
        </form>
        <div class="cel">Ver también...</div>
        <div class="mainPage">
            <div class="sugerencias">Platillos con <span>></span></div>
            <div class="imgSug">
                <a href="receta.php?idReceta=33">Pollo
                    <img src="img/pollo.png" style="height: 120px;">
                </a>
                <a href="receta.php?idReceta=32">Pasta
                    <img src="img/pasta.png" style="height: 120px;">
                </a>
                <a href="receta.php?idReceta=29">Atún
                    <img src="img/atun.png" style="height: 120px;">
                </a>
                <a href="receta.php?idReceta=34">Queso
                    <img src="img/quesadillas.png" style="height: 120px;">
                </a>
                <a href="receta.php?idReceta=30">Carne
                    <img src="img/albondigas.png" style="height: 120px;">
                </a>
                <a href="receta.php?idReceta=31">Pan
                    <img src="img/hamburguesa.png" style="height: 120px;">
                </a>
                
            </div>
            <div class="slider-frame">
                <ul>
                    <li><img src="img/bannerDes1.png"></li>
                    <li><img src="img/bannerDes3.png"></li>
                    <li><img src="img/bannerDes2.png"></li>
                    <li><img src="img/bannerDes4.png"></li>
                </ul>
            </div>
            <div class="lectura">Leer sobre <span>></span></div>
            <div class = "listaOpciones">
                <div class="card">
                    <div class="card_landing" style="--i:url(img/healty.jpg)">
                        <h6><a href="#">Saludable</a></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card_landing" style="--i:url(img/rapido.jpg)">
                        <h6><a href="#">Rápido</a></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card_landing" style="--i:url(img/facil.jpg)">
                        <h6><a href="#">Fácil</a></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card_landing" style="--i:url(img/deliciosa.jpg)">
                        <h6><a href="#">Deliciosa</a></h6>
                    </div>
                </div>
            </div>
            <div class="recomendaciones">Recomendaciones <span>></span></div>
            <div class = "listaOpciones">
                <div class="card">
                    <div class="card_landing" style="--i:url(img/pastel.jpg)">
                        <h6><a href="#">Pastel</a></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card_landing" style="--i:url(img/coctel.jpg)">
                        <h6><a href="#">Coctel</a></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card_landing" style="--i:url(img/arroz.jpg)">
                        <h6><a href="#">Arroz</a></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card_landing" style="--i:url(img/ensalada.jpg)">
                        <h6><a href="#">Ensalada</a></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="piePagina">
            <div class="copyright">
                Copyright © BEL'S RECIPES 2023
            </div>
            <div class="redesSociales">
                <a class="btn btn-primary btn-social mx-2" href="https://twitter.com"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-primary btn-social mx-2" href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-primary btn-social mx-2" href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="pptu">
                <a href="#">Política de seguridad</a>
                <a href="#">Términos de uso</a>
            </div>
        </div>
        <script>
            let subMenu = document.getElementById("subMenu");

            function toggleMenu(){
                subMenu.classList.toggle("open-menu");
            }
        </script>
    </body>
</html>