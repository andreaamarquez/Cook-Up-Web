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

    $idCategoria = $_GET['idCategoria'];
    $datos = $cad->traeCategoria($idCategoria);
    if($datos)
    {
        $nombreCategoria = $datos['nombreCategoria'];
        $descripcion = $datos['descripcion'];
        $introduccion = $datos['introduccion'];
        $imagen = $datos['imagen'];
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="estilo.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title><?php echo $nombreCategoria; ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/icono.png">
    </head>
    <body>
        <div class = "encabezado">
            <div class = "logo">
             <img src="img/logo.png" style="height: 70px;" onclick="window.location.href='index.php';">
            </div>
            <div class = "login">
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
                            <img src="img/profile.png">
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
        </div>
        <div class="encImg">
            <img src="<?php echo $imagen;?>" style="width: 100%;">
        </div>
        <div class = "titlePage"><a href="javascript:window.history.back()">Volver <span>></span></a><?php echo $nombreCategoria;?> <span> ></span></div>
        <div class = "introductionPage">
            <p><?php echo $descripcion;?></p>
        </div>
        <div class = "cocinar">¡A aprender!</div>
        <div class = "textoIntro"><?php echo $introduccion;?>
        </div>

        <div class = "listaOpciones">
        <?php
            $cad = new CAD();

            $datos = $cad->traeRecetasCategoria($idCategoria);
            if($datos)
            {
                foreach($datos as $registro)
                {
                    
                    $idReceta = $registro['idReceta'];
                    $nombreReceta = $registro['nombreReceta'];
                    $imagen = $registro['imagen'];
                    $imagen = substr($imagen, 3);
                    $introduccion = $registro['introduccion'];

                    echo '<div class="card">
                            <div class="card_landing" style="--i:url('.$imagen.')">
                            <h6><a href="receta.php?idReceta='.$idReceta.'">'.$nombreReceta.'</a></h6>
                            </div>
                          </div>';

                }
            }
        ?>
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