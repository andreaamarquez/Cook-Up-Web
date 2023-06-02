<?php
require_once "../php/CAD.php";
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
} 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../estilo.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <title>Panel de configuración</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="../img/icono.png">
    </head>
    <body>
        <nav>
            <div class = "encabezado">
                <div class = "logo">
                     <img src="../img/logo.png" style="height: 70px;" href="../index.html"  onclick="window.location.href='../index.php';">
                </div>
                <?php
                
                if($idRol == 2)
                {
                    echo ' <div class="login">
                    <img src="'.$imagenU.'" class="user-pic" onclick="toggleMenu()">
                </div>

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">

                        <a href="../guardados.php" class="sub-menu-link">
                            <img src="../img/corazon.png">
                            <p>Elementos guardados</p>
                            <span>></span>
                        </a>
                        <a href="../iniciarSesion/editarPerfil.php" class="sub-menu-link">
                            <img src="../img/setting.png">
                            <p>Editar perfil</p>
                            <span>></span>
                        </a>
                        <a href="../php/cerrarsesion.php" class="sub-menu-link">
                            <img src="../img/logout.png">
                            <p>Cerrar sesión</p>
                            <span>></span>
                        </a>

                    </div>
                </div>';
                }
                ?>
             </div>
        </nav>
        
        <div class = "titlePageAd"><a href="javascript:window.history.back()">Volver <span>></span></a>Configuración <span> ></span></div>

        <div class="menu2">
            <div class="row1">
                <button onclick="window.location.href = 'crearReceta.php'">
                    <img src="../img/añadir.png" alt="Icono Incluir">
                    <span>Añadir</span>
                    <p>Crear nueva receta</p>
                </button>
                <button onclick="window.location.href = 'editarReceta.php'">
                    <img src="../img/editar.png" alt="Icono Editar">
                    <span>Editar</span>
                    <p>Modificar recetas en existencia</p>
                </button>
            </div>
            <div class="row2">
                <button onclick="window.location.href = 'eliminar.php'">
                    <img src="../img/borrar.png" alt="Icono Eliminar">
                    <span>Eliminar</span>
                    <p>Eliminar artículos de la página</p>
                </button>
                <button onclick="window.location.href = 'usuarios.php'">
                    <img src="../img/gestionar.png" alt="Icono Gestionar Usuarios">
                    <span>Gestionar usuarios</span>
                    <p>Administrar usuarios y permisos</p>
                </button>
            </div>
        </div>


        <footer>
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
        </footer>

        <script>
            let subMenu = document.getElementById("subMenu");

            function toggleMenu(){
                subMenu.classList.toggle("open-menu");
            }
        </script>
    </body>
</html>