<?php
    require_once "../php/CAD.php";
    
    $id = $_GET['idUsuario'];
    $cad = new CAD();
    $datos = $cad->traeUsuarioEs($id);
    
    if ($datos) {
        $nombre = $datos['nombre'];
        $correo = $datos['correo'];
        $imagen = $datos['imagenUsuario'];
        $idRol = $datos['idRol'];
    
        // Verificar si se ha enviado el formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos enviados por el formulario
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            if(isset($_FILES['nueva_imagen']['name']) && $_FILES['nueva_imagen']['name']!='')
            {
                $imagen = $_FILES['nueva_imagen']['name']; 
                $archivo = $_FILES['nueva_imagen']['tmp_name'];
                $ruta = "../img";
                $ruta = $ruta."/".$imagen;
                move_uploaded_file($archivo, $ruta);
                $imagen = $ruta;
            }
            $idRol = $_POST['idRol'];
            // Realizar la actualización de la receta en la base de datos
            $consulta = "nombre = '$nombre', correo = '$correo', imagenUsuario= '$imagen',idRol ='$idRol'";
            $actualizado = $cad->modificaUsuario($consulta,$id);

            if ($actualizado) {
                // Redirigir a la página de visualización de la receta actualizada
                header("Location: editaUsuario.php?idUsuario=$id");
                exit();
            } else {
                echo "Error al actualizar";
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
                        <title>Editar usuario</title>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                <body>
                    <div class = "encabezado">
                        <div class = "logo">
                        <img src="../img/logo.png" style="height: 70px;">
                        </div>
                        <div class = "login">
                            <div class = "inicioSesion"><a href="../iniciarSesion/iniciarSesion.html">Iniciar sesión</a></div>
                            <div class = "registro"><a href="../registrarse/registrarse.html">Registrarse</a></div>
                        </div>
                    </div>
                    <div class="mainPageAdmin">
                        <div class = "titleRecipe"><a href="usuarios.php">Editar usuario<span>></span></a>'.$nombre.'</div>
                        <div class="form">
                        
                        <form method="POST" action="" enctype="multipart/form-data">
                        <br><br>
                            <label for="nombre">Nombre del usuario:</label><br>
                            <input type="text" name="nombre" value="'.$nombre.'"><br><br>
        
                            <label for="correo">Introducción:</label><br>
                            <textarea name="correo" rows="5" cols="50">'.$correo.'</textarea><br><br>


                            <label for="imagen">Imagen:</label><br><br>
                            <img src="'.$imagen.'" style="width: 200px;"><br><br>
                            <input type="file" name="nueva_imagen"><br><br>

                            <label for="idRol">idRol:</label>
                            <select name="idRol">';
                                for ($i = 1; $i <= 2; $i++) {
                                    if ($i == $idRol) {
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
                </body>
            </html>';
    } 
           
?>
