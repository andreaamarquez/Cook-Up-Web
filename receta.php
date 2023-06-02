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

    //$idReceta = $_GET['idReceta'];
    $idReceta = isset($_GET['idReceta']) ? $_GET['idReceta'] : 0;
    $datos = $cad->traeReceta($idReceta);
    
    if ($datos) {
        $nombre = $datos['nombreReceta'];
        $introduccion = $datos['introduccion'];
        $imagen = $datos['imagen'];
        $imagen = substr($imagen, 3);
        $porciones = $datos['porciones'];
        $ingredientes = $datos['ingredientes'];
        $procedimiento = $datos['procedimiento'];
    
        // Verificar si se ha enviado el formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario = $_POST['comment'];
            if($cad->agregaComentario($idReceta, $idUsuario, $comentario))
                header("Location: receta.php?idReceta=$idReceta");
                exit();

        }

        echo '<html>
        <head>
            <meta charset="UTF-8">
            <link rel="icon" type="image/png" href="img/icono.png">
            <link href="estilo.css" rel="stylesheet" type="text/css">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
            <title>'.$nombre.'</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div class = "encabezado">
                <div class = "logo">
                 <img src="img/logo.png" style="height: 70px;">
                </div>';
            
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
                echo 
            '</div>
             <div class = "titleRecipe"><a href="javascript:window.history.back()">Volver <span>></span></a>'.$nombre.'</div>
             <div class = "introductionRecipe">'.$introduccion.'
            </div>
            <div class="imgContenedor">
                <div class="imageRecipe" style="--i:url('.$imagen.')"></div>
                <div class="commentRecipe">
                    <div class = "foodPortions"><i class="fa-regular fa-user"></i> Rinde '.$porciones.' porciones</div>';
                    if($idRol == 1 || $idRol == 2)
                        echo '<div class = "foodPortions"><i class="fa-regular fa-save"></i><a href="php/guardar.php?idReceta='.$idReceta.'"> Guardar receta<a></div>';
                echo '</div>
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
            <div class="comments">Comentarios:</div>';
            $cad = new CAD();

            $datos = $cad->traeComentarios($idReceta);
            if($datos)
            {
                foreach($datos as $registro)
                {
                    $idU = $registro['idUsuario'];
                    $coment = $registro['comentario'];
                    $fecha = $registro['fecha'];
                    #$receta = $cad->traeGuardadoR($idR);
                    $queryImg = $cad->traeImagenUsuario($idU);
                    if ($queryImg !== null && isset($queryImg['imagenUsuario'])) {
                        $img = $queryImg['imagenUsuario'];
                        $img = substr($img, 3);
                    }
                    $nombreu = $cad->traeNombre($idU); 
                    $nom = $nombreu['nombre'];
                        echo '
                                <div class="container3">
                                    <img src="'.$img.'" alt="Imagen" class="image3">
                                    <div class="content3">
                                        <p>'.$fecha.'<p>
                                        <p class="titulo-buscar">'.$nom.'</p>
                                        <p>'.$coment.'</p>
                                    </div>
                                </div>';
                    
                }
            }
            if($idRol == 1 || $idRol == 2)
            {
                echo '
                    <div class="comments">Escribe un comentario:</div>
                    <form action="php/comentar.php?idReceta='.$idReceta.'" method="POST">
                    <div class=cajaComentarios>
                    <div class="userImage">';
                    if($idRol == 0)
                        echo '<img src="img/user.jpg">';
                    else
                        echo '<img src="'.$imagenU.'">';
              echo  '</div>
                    <textarea placeholder="Escribe un comentario" type="text" name="comentario" rows="5" cols="50"></textarea><br>
                    </div> 
                    <input type="submit" value="Comentar" class="boton">
                </form>';
            }
            
                
            echo '<div class="piePagina">
                <div class="copyright">
                    Copyright © BEL\'\'S RECIPES 2023
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
