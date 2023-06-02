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

    if (isset($_GET['idReceta'])) {
        $idReceta = $_GET['idReceta'];
        $flag = $cad->eliminaGuardado($idReceta);
    }

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="estilo.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <title>Elementos guardados</title>
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
                    if($idRol == 2)
                    {
                        echo ' <div class="login">
                        <img src="'.$imagenU.'" class="user-pic" onclick="toggleMenu()">
                    </div>

                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <a href="iniciarSesion/editarPerfil.php" class="sub-menu-link">
                                <img src="img/setting.png">
                                <p>Editar perfil</p>
                                <span>></span>
                            </a>
                            <a href="menuConfig.php" class="sub-menu-link">
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
            ?>

        </div>
        <div class="mainPageAdmin">
        
        <div class = "titlePageAd"><a href="index.php">Inicio<span>></span></a>Elementos guardados<span> ></span></div>
        <section class="todo">
        <?php
            $cad = new CAD();

            $datos = $cad->traeGuardado($idUsuario);
            if($datos)
            {
                foreach($datos as $registro)
                {
                    $idR = $registro['idReceta'];
                    $receta = $cad->traeGuardadoR($idR);
                    if($receta)
                    {
                        foreach($receta as $recetas)
                        {
                            $idReceta = $recetas['idReceta'];
                            $nombreReceta = $recetas['nombreReceta'];
                            $imagen = $recetas['imagen'];
                            $introduccion = $recetas['introduccion'];
                            $imagen = substr($imagen, 3);
                            
                            //echo "<td><a href='elimina.php?idUsuario=$idUsuario'>Eliminar</a></td>";
                            echo '
                                <div class="container3">
                                    <img src="'.$imagen.'" alt="Imagen" class="image3">
                                    <div class="content3">
                                        <p class="titulo-buscar">'.$nombreReceta.'</p>
                                        <p>'.$introduccion.'</p>
                                    </div>
                                    <img src="img/ver.png" alt="Icono ver" style="height: 30px; margin-right: 30px" onclick="window.location.href = \'receta.php?idReceta='.$idReceta.'\'">
                                    <img src="img/borrar.png" alt="Icono Editar" style="height: 30px; margin-right: 30px" onclick="window.location.href = \'guardados.php?idReceta='.$idReceta.'\'">
                                </div>';
                        }
                    }
                    
                }
            }
        ?>
        </section>
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