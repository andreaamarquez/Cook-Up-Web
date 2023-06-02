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
    
    $idReceta = $_GET['idReceta'];
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
            $nombre = $_POST['nombre'];
            $introduccion = $_POST['introduccion'];
            if(isset($_FILES['nueva_imagen']['name']) && $_FILES['nueva_imagen']['name']!='')
            {
                $imagen = $_FILES['nueva_imagen']['name']; 
                $archivo = $_FILES['nueva_imagen']['tmp_name'];
                $ruta = "../img";
                $ruta = $ruta."/".$imagen;
                move_uploaded_file($archivo, $ruta);
                $imagen = $ruta;
            }
            
            $porciones = $_POST['porciones'];
            $ingredientes = $_POST['ingredientes'];
            $procedimiento = $_POST['procedimiento'];
    
            // Realizar la actualización de la receta en la base de datos
            $actualizado = $cad->modificaReceta($nombre, $introduccion, $porciones, $imagen, $ingredientes, $procedimiento,$idReceta);

            if ($actualizado) {
                // Redirigir a la página de visualización de la receta actualizada
                header("Location: edicion.php?idReceta=$idReceta");
                exit();
            } else {
                echo "Error al actualizar la receta.";
            }
        }
    
        // Mostrar el formulario de edición de la receta
        echo '<html>
                    <head>
                        <meta charset="UTF-8">
                        <link rel="icon" type="image/png" href="../../img/icono.png">
                        <link href="../estilo.css" rel="stylesheet" type="text/css">
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
                        <link rel="icon" type="../img/image/png" href="../img/icono.png">
                        <title>'.$nombre.'</title>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                <body>
                    <div class = "encabezado">
                        <div class = "logo">
                <img src="../img/logo.png" style="height: 70px;" onclick="window.location.href=\'../index.php\';">
                        </div>';
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
                                <img src="../img/profile.png">
                                <p>Editar perfil</p>
                                <span>></span>
                            </a>
                            <a href="menuConfig.php" class="sub-menu-link">
                                    <img src="../img/setting.png">
                                    <p>Configuración de Página</p>
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
                    echo '</div>
                    <div class="mainPageAdmin">
                        <div class = "titleRecipe"><a href="editarReceta.php">Editar receta<span>></span></a>'.$nombre.'</div>
                        <div class="form">
                        
                        <form method="POST" action="" enctype="multipart/form-data">
                        <br><br>
                            <label for="nombre">Nombre de la receta:</label><br>
                            <input type="text" name="nombre" value="'.$nombre.'"><br><br>
        
                            <label for="introduccion">Introducción:</label><br>
                            <textarea name="introduccion" rows="5" cols="50">'.$introduccion.'</textarea><br><br>

                            <label for="ingredientes">Ingredientes:</label><br>
                            <textarea name="ingredientes" rows="10" cols="50">'.$ingredientes.'</textarea><br><br>

                            <label for="procedimiento">Procedimiento:</label><br>
                            <textarea name="procedimiento" rows="15" cols="50">'.$procedimiento.'</textarea><br><br>

                            <label for="imagen">Imagen:</label><br><br>
                            <img src="'.$imagen.'" style="width: 200px;"><br><br>
                            <input type="file" name="nueva_imagen"><br><br>

                            <label for="porciones">Porciones:</label>
                            <select name="porciones">';
                                for ($i = 1; $i <= 10; $i++) {
                                    if ($i == $porciones) {
                                        echo "<option value=\"$i\" selected>$i</option>";
                                    } else {
                                        echo "<option value=\"$i\">$i</option>";
                                    }
                                }
                            echo '</select><br><br>
                            <input type="submit" value="Guardar cambios" class="boton">
                        </form>
                        </div>
                    </div>
                    <div class="piePagina">
            <div class="copyright">
                Copyright © BELS RECIPES 2023
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
            </html>';
    } else {
        echo "No se encontró la receta especificada.";
    }
           
?>
