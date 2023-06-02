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
    
    $idReceta = 0;
    if (isset($_GET['idReceta'])) {
        $idReceta = $_GET['idReceta'];
    }
    $cad = new CAD();
    $datos = $cad->traeReceta($idReceta);
    
    if ($datos) {
        $nombre = $datos['nombreReceta'];
        $introduccion = $datos['introduccion'];
        $imagen = $datos['imagen'];
        $porciones = $datos['porciones'];
        $ingredientes = $datos['ingredientes'];
        $procedimiento = $datos['procedimiento'];
    
        // Verificar si se ha enviado el formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos enviados por el formulario
            
            $comentario = $_POST['comment'];
            // Realizar la actualización de la receta en la base de datos
            $actualizado = $cad->agregaComentario($idReceta,$idUsuario,$comentario);

            if ($actualizado) {
                // Redirigir a la página de visualización de la receta actualizada
                header("Location: receta.php?idReceta=$idReceta");
                exit();
            } else {
                echo "Error al añadir comentario.";
            }
        }
    
        // Mostrar el formulario de edición de la receta
        echo '<html>
        <head>
            <meta charset="UTF-8">
            <link rel="icon" type="image/png" href="img/icono.png">
            <link href="../estilo.css" rel="stylesheet" type="text/css">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
            <title>'.$nombre.'></title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div class = "encabezado">
                <div class = "logo">
                 <img src="img/logo.png" style="height: 70px;"  onclick="window.location.href=\'../index.php\';">
                </div>';
            
                if($idRol == 1)
                {
                    echo '<div class="login">
                        <img src="'.$imagenU.'" class="user-pic" onclick="toggleMenu()">
                    </div>
    
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
    
                            <a href="#" class="sub-menu-link">
                                <img src="../img/profile.png">
                                <p>Perfil</p>
                                <span>></span>
                            </a>
                            <a href="iniciarSesion/editarPerfil.php" class="sub-menu-link">
                                <img src="../img/setting.png">
                                <p>Editar perfil</p>
                                <span>></span>
                            </a>
                            <a href="php/cerrarsesion.php" class="sub-menu-link">
                                <img src="../img/logout.png">
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
    
                        <a href=".php" class="sub-menu-link">
                            <img src="../img/profile.png">
                            <p>Perfil</p>
                            <span>></span>
                        </a>
                        <a href="../iniciarSesion/editarPerfil.php" class="sub-menu-link">
                            <img src="img/profile.png">
                            <p>Editar perfil</p>
                            <span>></span>
                        </a>
                        <a href="../admin/menuConfig.php" class="sub-menu-link">
                            <img src="img/setting.png">
                            <p>Configuración de Página</p>
                            <span>></span>
                        </a>
                        <a href="../php/cerrarsesion.php" class="sub-menu-link">
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
                    <div class = "inicioSesion"><a href="../php/login.php">Iniciar sesión</a></div>
                    <div class = "registro"><a href="php/registro.php">Registrar</a></div>
                    </div>';
                }
                echo 
            '</div>
             <div class = "titleRecipe"><a href="../index.php">Inicio <span>></span></a>'.$nombre.'</div>
             <div class = "introductionRecipe">'.$introduccion.'
            </div>
            <div class="imgContenedor">
                <div class="imageRecipe" style="--i:url('.$imagen.')"></div>
                <div class="commentRecipe">
                    <div class = "foodPortions"><i class="fa-regular fa-user"></i> Rinde '.$porciones.'porciones</div>
                    <div class = "foodPortions"><i class="fa-regular fa-save"></i> Guardar receta</div>
                </div>
            </div>
            <div class="ingredientsTitle">Ingredientes</div>
            <div class="ingredientsList">
                <ul>
                    '.$ingredientes.'                   
                </ul>
            </div>
            <div class="procedureTitle">Procedimiento</div>
            <div class="procedureList">
                <ul>
                   '.$procedimiento.'
                </ul>
            </div>
                    
                    <form action="receta.php" method="POST">
                        <div class="comments">Comentarios:</div>
                        <div class="userImage">';
                        if($idRol == 0)
                            echo '<img src="img/user.jpg">';
                        else
                            echo '<img src="'.$imagenU.'">';
                        echo '</div>
                        <textarea placeholder="Escribe un comentario" type="text" name="comment" rows="5" cols="50"></textarea><br>
                        <input type="submit" value="Comentar" class="boton">
                    </form>
                    
            <div class="piePagina">
                <div class="copyright">
                    Copyright © BEL\'\S RECIPES 2023
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
        </body>
        <script type="text/javascript" src="script.js"></script>
        <script>
                let subMenu = document.getElementById("subMenu");
    
                function toggleMenu(){
                    subMenu.classList.toggle("open-menu");
                }
            </script>
    </html>';
            }
           
?>
